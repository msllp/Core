<?php
/**
 * Created by PhpStorm.
 * User: ms
 * Date: 19-06-2019
 * Time: 04:06 AM
 */

namespace MS\Core\Helper;

use Razorpay\Api\Api;

class MSPay
{
    public $amount,$data;

    private $required=[
        'description','customerEmail','customerNumber'
    ];

    public function  __construct($amount,$data)
    {

        $this->data=$data;
        $this->amount=$amount;


    }

    public static function makePaymentLink($amount,$data):array{

        $class=new self($amount,$data);

        //dd($class->requiredDataCheck());

        $id="rzp_test_hWAPfGnN0KwMXK";
        $secret="f2CxU8JV3aWiTAjMY2X5y630";
        $razorPay=new Api($id,$secret);
//dd($data);
        $razorPayMaster=$razorPay->invoice->create(
            [
                'type' => 'link',
                'amount' =>$amount * 100,
                'description' => $data['description'],
                'customer' => [
                 //   'email' => $data['customerEmail'],
                   // "contact"=> $data['customerNumber'],
                ],

            ]
        );

        $return =[
            'link'=>$razorPayMaster->short_url,
            'expired_at'=>$razorPayMaster->expired_at,
            'invoiceid'=> $razorPayMaster->id,
            'created_at'=>$razorPayMaster->created_at
        ];

         return $return ;

    }

    public function requiredDataCheck(){
        foreach ( $this->required as $v){
            if(!array_key_exists($v,$this->data))return false;
        }
        return true;
    }

}
