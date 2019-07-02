<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Idma\Robokassa\Payment;
use App\Models\PaymentHistory;
use App\Models\GameBet;
use App\Models\User;
use App\Models\Game;
use App\Models\PaymentSto;
use Carbon\Carbon;
use Auth;
use Storage;
use Jenssegers\Agent\Agent;

class PaymentsController extends Controller
{
    //
    /**
     * Show the payment page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPayments()
    {
		if(Auth::check()){
			$games = Game::all();
			$payment_history = PaymentHistory::where(['user_id' => Auth::user()->id, 'status' => PaymentHistory::PAID])->get();
			return view('lobby.payment', compact('games', 'payment_history'));
		}
		return redirect('/');
    }


    public function getBets(Request $request)
    {
        $bets = GameBet::where('game_id', $request->id)->get();

        if ($bets == null) {
            return response()->with(['error' => 'Для этой игры не определены ставки']);
        }
        $view = view('lobby.parts.bets')->with(['bets' => $bets]);
        return $view->render();
    }


    /**
     * Send payment.
     *
     * @param request
     * @return \Illuminate\Http\RedirectResponses
     */
    public function sendPayment(Request $request)
    {
		$user_id = Auth::check() ? Auth::user()->id : $request->user_id;
        if ($request->price == "" || $request->price == null) {
            return back()->with(['error' => 'Укажите сумму']);
        }
        if (!ctype_digit($request->price)) {
            return back()->with(['error' => 'Поле сумма не может содержать символы']);
        }
	
        $payment_robkass = new Payment(
            env('ROBOKASSA_SHOP_ID'),
            env('ROBOKASSA_PASS_1'),
            env('ROBOKASSA_PASS_2'),
            env('ROBOKASSA_TEST')
        );


        do {
            $code = rand(10000, 9999990);
        } while (PaymentHistory::where('operation_id', $code)->where('status', 0)->first() != null);


        $payment = new PaymentHistory();
        $payment->operation_id = $code;
        $payment->amount = $request->price;
        $payment->user_id = $user_id;
        $payment->status = 0;
        $payment->save();

        $payment_robkass
            ->setInvoiceId($code)
            ->setSum($payment->amount)
            ->setDescription('Новая оплата');

        // redirect to payment url
        return redirect($payment_robkass->getPaymentUrl());
    }


    /**
     * Send payment.
     *
     * @param request
     * @return \Illuminate\Http\RedirectResponses
     */
    public function sendPaymentYandex(Request $request)
    {

        if ($request->price == "" || $request->price == null) {
            return back()->with(['error' => 'Укажите сумму']);
        }
        if (!ctype_digit($request->price)) {
            return back()->with(['error' => 'Поле сумма не может содержать символы']);
        }


        do {
            $code = (string) Uuid::generate();
        } while (PaymentHistory::where(['token' => $code, 'email' => Auth::user()->email])->where('status', 0)->first() != null);


        $payment = new PaymentHistory();
        $payment->token = $code;
        $payment->price = $request->price;
        $payment->user_id = Auth::user()->id;
        $payment->status = 0;
        $payment->save();


        // redirect to payment url
        return redirect('/');
    }

    public function checkPayment(Request $request)
    {

        $payment = new Payment(
            env('ROBOKASSA_SHOP_ID'),
            env('ROBOKASSA_PASS_1'),
            env('ROBOKASSA_PASS_2'),
            env('ROBOKASSA_TEST')
        );


        if ($payment->validateResult($request->all())) {
            $payments_history = PaymentHistory::where('operation_id', $request->input('InvId'))->first();
            if ($payments_history->amount == $payment->getSum())
            {
                $payments_history->status = 1;
                $user = User::find($payments_history->user_id);
                $user->credits = $user->credits + $payments_history->amount;
                $user->update();
                $payments_history->update();
				
				return true;
            }
        }
		return false;
    }



    public function checkPaymentYandex(Request $request)
    {
        $secret_key = env('SECRET_KEY'); // секретное слово, которое мы получили в предыдущем шаге.

        $sha1 = sha1( $_POST['notification_type'] . '&'. $_POST['operation_id']. '&' . $_POST['amount'] . '&643&' . $_POST['datetime'] . '&'. $_POST['sender'] . '&' . $_POST['codepro'] . '&' . $secret_key. '&' . $_POST['label'] );

        // var_export -- nice, one-liner
        $debug_export = var_export($request->all(), true);
        \Storage::put('local.txt', $debug_export);

        // // var_export -- nice, one-liner
        $debug_export2 = var_export($sha1, true);
        \Storage::put('sha1_hash.txt', $debug_export2);

        if ($sha1 != $_POST['sha1_hash'] ) {
            exit();
        }
		$payments_history = PaymentHistory::where('operation_id', $request->operation_id)->first();
		if(!empty($payments_history)) return;
		
        $payment = new PaymentHistory();
        $payment->operation_id = $request->operation_id;
        $payment->user_id = $request->label;
        $payment->status = 1;
        $payment->amount = $request->amount;
        $payment->withdraw_amount = $request->withdraw_amount;
        $payment->save();

        $user = User::find($payment->user_id);
        $user->credits = $user->credits + $payment->withdraw_amount;
        $user->update();

        $data = array();
        $data['email'] = $user->email;
        $data['amount'] = $payment->withdraw_amount;
        \Mail::send('lobby.email.paymentSuccess', $data, function ($message) use ($data) {
            $message->to($data['email']);
            $message->from(env('EMAIL_SENDER'), 'Gamechainger');
            $message->subject('Баланс пополнен');
        });

        return;
    }



    public function successPayment(Request $request)
    {
        return redirect('/payments')->with(['success' => 'Отлично! Оплата прошла успешно.']);
    }

    public function failPayment(Request $request)
    {
        return redirect('/payments')->with(['error' => 'Произошла ошибка! Оплата не прошла, попробуйте еще раз или обратитесь в службу поддержки']);
    }

    public function checkBalance(Request $request)
    {
        $balance = Auth::user()->credits;
        $bet_sum = GameBet::find($request->bet)->bet;
        return response()->json(['result' => $balance, 'bet' => $bet_sum]);
    }


}
