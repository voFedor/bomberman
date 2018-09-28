<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\UUID;
use Idma\Robokassa\Payment;
use App\Models\PaymentHistory;
use Auth;

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
        return view('lobby.payment');
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
            $code = new UUID;
        } while (PaymentHistory::where('token', $code)->first() != null);


        $payment = new PaymentHistory();
        $payment->token = $code;
        $payment->price = $request->price;
        $payment->user_id = Auth::user()->id;
        $payment->status = 0;
        $payment->save();



        $payment_robkass
            ->setInvoiceId($token)
            ->setSum($payment->price)
            ->addCustomParameters(['token' => $code])
            ->setDescription('Оплата');

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
            $payments_history = PaymentHistory::where('token', $request->input('token'))->first();
            $paid = number_format($payment->getSum());
            if ($payments_history->price == $paid)
            {
                $payments_history->status = 1;
            }
            $payments_history->update();
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
