<?php

namespace App\Http\Controllers;

use App\Traits\FaspayPayment;

class PaymentController extends Controller
{
    private $faspay;
    public function __construct()
    {
        $this->faspay = new FaspayPayment();
    }

    public function paymentCallback()
    {
        return response()->json($this->faspay->paymentCallback());
    }
}
