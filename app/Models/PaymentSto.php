<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSto extends Model
{
	private $baseUrl  = 'https://paysto.com/ru/upBalance?';
	private $data;
	private $shop_id;
	
	public function __construct($shop_id)
    {
        $this->shop_id = $shop_id;

        $this->data = [
            'PAYSTO_SHOP_ID'  	  => $this->shop_id,
            'PAYSTO_PAYER_ID' 	  => null,
            'PAYSTO_SUM'          => 0,
            'PAYSTO_PAYER_EMAIL'  => '',
            'PAYSTO_CURRENCY' 	  => null,
            'PAYSTO_PERIOD'       => '',
            'PAYSTO_DELIVERYTIME' => 1,
            //'IsTest'         => $testMode ? 1 : 0
        ];
    }
	
    public function getPaymentUrl()
    {
        $signature = vsprintf('%u:%01.2f:%u:%s', [
            // '$shop_id:$PAYSTO_SUM:$PAYSTO_PAYER_ID:$PAYSTO_PAYER_EMAIL'
            $this->shop_id,
            $this->data['PAYSTO_SUM'],
            $this->data['PAYSTO_PAYER_ID'],
            $this->data['PAYSTO_PAYER_EMAIL']
        ]);

        $data = http_build_query($this->data, null, '&');

        return $this->baseUrl . $data;
    }
}
