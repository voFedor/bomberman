<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\UUID;
use Idma\Robokassa\Payment;
use App\Models\PaymentHistory;
use App\Models\GameBet;
use App\Models\User;
use Auth;
use Storage;

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
        $bets = GameBet::with(['game'])
            ->get()
            ->all();
        $payment_history = PaymentHistory::where('user_id', Auth::user()->id)->get();
        return view('lobby.payment', compact('bets', 'payment_history'));
    }


    public function getBets(Request $request)
    {
        $bets = GameBet::where('game_id', $request->id)->get();

        if ($bets == null) {
            return response()->with(['error' => 'Для этой игры не определены ставки']);
        }
        $view = view('lobby.parts.bets')->with(['bets' => $bets, 'url' => $request->url, 'info' => $request->info]);
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
            true
        );


        do {
            $code = rand(10000, 9999990);
        } while (PaymentHistory::where('token', $code)->where('status', 0)->first() != null);


        $payment = new PaymentHistory();
        $payment->token = $code;
        $payment->price = $request->price;
        $payment->user_id = Auth::user()->id;
        $payment->status = 0;
        $payment->save();



        $payment_robkass
            ->setInvoiceId($code)
            ->setSum($payment->price)
            ->setDescription('Новая оплата');

        // redirect to payment url
        return redirect($payment_robkass->getPaymentUrl());
    }

    public function checkPayment(Request $request)
    {

        $payment = new Payment(
            env('ROBOKASSA_SHOP_ID'),
            env('ROBOKASSA_PASS_1'),
            env('ROBOKASSA_PASS_2'),
            true
        );


        if ($payment->validateResult($request->all())) {
            $payments_history = PaymentHistory::where('token', $request->input('InvId'))->first();
            if ($payments_history->price == $payment->getSum())
            {
                $payments_history->status = 1;
                $user = User::find($payments_history->user_id);
                $user->credits = $user->credits + $payments_history->price;
                $user->update();
                $payments_history->update();
            }

        }
    }


    public function successPayment(Request $request)
    {
        $payment_history = PaymentHistory::where('token', $request->input('token'))->first();
        if ($payment_history == null) {
            abort(404);
        }

        return redirect('/payments')->with(['success' => 'Отлично! Оплата прошла успешно.']);
    }


    public function failPayment(Request $request)
    {
        $payment_history = PaymentHistory::where('token', $request->input('token'))->first();
        if ($payment_history == null) {
            abort(404);
        }

        return redirect('/payments')->with(['error' => 'Произошла ошибка! Оплата не прошла, попробуйте еще раз или обратитесь в службу поддержки']);
    }
}
