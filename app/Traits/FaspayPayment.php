<?php

namespace App\Traits;

use App\Models\AccessCode;
use App\Models\OrderPaketTrx;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\DB;
use App\Traits\Generator;

class FaspayPayment
{
    use Generator;
    private $baseUrl, $merchant_id, $merchant_name, $username, $password;

    public function __construct()
    {
        $this->baseUrl = config('faspay.merchant_url', null);
        $this->merchant_id = config('faspay.merchant_id', null);
        $this->merchant_name = config('faspay.merchant_name', null);
        $this->username = config('faspay.merchant_user', null);
        $this->password = config('faspay.merchant_password', null);
    }

    public static $PAYMENT_DETAIL = [
        '702' => ['/images/payment_channel/svg/BCAmb_.svg', 'va', 'BCA Virtual Account', 4000], // virtual account
        '800' => ['/images/payment_channel/bri.png', 'va', 'BRI Virtual Account', 4000], // virtual account
        '802' => ['/images/payment_channel/svg/Mandirimb_.svg', 'va', 'Mandiri Virtual Account', 4000], // virtual account
        '801' => ['/images/payment_channel/svg/BNImb_.svg', 'va', 'BNI Virtual Account', 4000], // virtual account
        '402' => ['/images/payment_channel/svg/Permata Bankmb_.svg', 'va', 'Permata Virtual Account / PermataNet', 4000], // virtual account
        '408' => ['/images/payment_channel/svg/Maybankmb_.svg', 'va', 'Maybank Virtual Account', 4000], // virtual account
        '818' => ['/images/payment_channel/svg/Sinarmasmb_.svg', 'va', 'Sinarmas Virtual Account', 4000], // virtual account
        '825' => ['/images/payment_channel/cimb-niaga.png', 'va', 'CIMB Virtual Account', 4000], // virtual account
        '708' => ['/images/payment_channel/svg/Danamonmb_.svg', 'va', 'Danamon Virtual Account', 4000], // virtual account
        '401' => ['/images/payment_channel/bri-epay.png', 'ibank', 'BRI ePay', 5000], // internet banking
        '405' => ['/images/payment_channel/bca-klikpay.png', 'ibank', 'BCA KlikPay', 6000], // internet banking
        '700' => ['/images/payment_channel/octo-clicks.png', 'ibank', 'Octo Clicks', 5000], // internet banking
        '701' => ['/images/payment_channel/svg/Danamonmb_.svg', 'ibank', 'Danamon Online Banking', 5000], // internet banking
        '814' => ['/images/payment_channel/svg/Maybankmb_.svg', 'ibank', 'Maybank2U', 4000], // internet banking
        '420' => ['/images/payment_channel/permata-net.png', 'ibank', 'PermataNet', 4000], // internet banking
        '810' => ['/images/payment_channel/b-secure.png', 'others', 'B-Secure', null], // online debit
        '709' => ['/images/payment_channel/kredivo.png', 'others', 'Kredivo', null], // online credit
        '807' => ['/images/payment_channel/akulaku.png', 'others', 'Akulaku', null], // online credit
        '820' => ['/images/payment_channel/indodana.png', 'others', 'Indodana', null], // online credit
        '711' => ['/images/payment_channel/svg/QRIS (Quick Response Code Indonesia Standard) Logo (SVG) - Vector69Com 1mb_.svg', 'qris', 'QRIS', "0.7"], // qris payment
        '713' => ['/images/payment_channel/svg/Shoope Paymb_.svg', 'ewallet', 'ShopeePay Jump App', "1.5"], // e money
        '812' => ['/images/payment_channel/svg/OVOmb_.svg', 'ewallet', 'OVO', "1.5"], // e money
        '819' => ['/images/payment_channel/svg/DANAmb_.svg', 'ewallet', 'DANA', "1.5"], // e money
        '716' => ['/images/payment_channel/svg/Link Ajamb_.svg', 'ewallet', 'LinkAja AppLink', 3000], // e money
        '704' => ['/images/payment_channel/sakuku.png', 'ewallet', 'Sakuku', 6000], // e money
        '302' => ['/images/payment_channel/svg/Link Ajamb_.svg', 'ewallet', 'LinkAja', 3000], // e money
        '706' => ['/images/payment_channel/indomart.png', 'store', 'Indomaret Payment point', 2000], // retail payment
        '707' => ['/images/payment_channel/alfamart.png', 'store', 'Alfagroup', 5000], // retail payment
        '400' => ['/images/payment_channel/bri.png', 'others', 'Lainnya', null], // etc
        '410' => ['/images/payment_channel/bri.jpg', 'others', 'Lainnya', null], // etc
        '718' => ['/images/payment_channel/bri.jpg', 'others', 'Lainnya', null], // etc
    ];

    public function getPaymentMethods()
    {

        $signature = sha1(md5(($this->username . $this->password)));

        $client = new Client();
        $response = $client->post($this->baseUrl . 'cvr/100001/10', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            RequestOptions::JSON => [
                'request' => 'Request List of Payment Gateway',
                'merchant_id' => $this->merchant_id,
                'merchant' => $this->merchant_name,
                'signature' => $signature,
            ],
            'http_errors' => false,
        ]);

        $payment = [];

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = $response->getBody();
            $stringBody = (string) $body;
            if ($stringBody != null && $stringBody != "") {
                $json = json_decode($stringBody);
                if (!isset($json->response_error)) {
                    $payment = $json->payment_channel;
                    $group = [];
                    foreach ($payment as $p) {
                        $detail = self::$PAYMENT_DETAIL[$p->pg_code];
                        $item = [
                            'title' => $detail[2],
                            'code' => $p->pg_code,
                            'type' => $detail[1],
                            'id' => implode('|', [$detail[1], $p->pg_code, $detail[2]]),
                            'fee' => [
                                'flat' => 0,
                                'percent' => 0,
                            ],
                            'icon' => asset($detail[0]),
                        ];

                        if (isset($group[$detail[1]])) {
                            array_push($group[$detail[1]], $item);
                        } else {
                            $group[$detail[1]] = [$item];
                        }
                    }
                    $payment = $group;
                }
            }
        }
        return $payment;
    }

    public function getTransactionFee($total, $fee)
    {
        $totalFee = ((float) $fee['percent'] * $total) + $fee['flat'];
        return $total + $totalFee;
    }

    public function postTransaction($trx, $user)
    {
        $signature = sha1(md5(($this->username . $this->password . $trx->bill_no)));
        $payloads = [
            "request" => "Post Data Transaction",
            "merchant_id" => $this->merchant_id,
            "merchant" => $this->merchant_name,
            "bill_no" => $trx->bill_no,
            "bill_reff" => "0",
            "bill_date" => now()->format('Y-m-d H:i:s'),
            "bill_expired" => $trx->expired_date,
            "bill_desc" => "Pembelian Paket " . $trx->paket->title . ' - Kelas ' . $trx->kelas->title,
            "bill_currency" => "IDR",
            "bill_gross" => "0",
            "bill_miscfee" => "0",
            "bill_total" => $trx->nominal . '00',
            "cust_no" => $trx->user_id,
            "cust_name" => $user[0],
            "payment_channel" => $trx->payment_method_code,
            "pay_type" => "1",
            "bank_userid" => "",
            "msisdn" => $user[2],
            "email" => $user[1],
            "terminal" => "10",
            "billing_name" => "0",
            "billing_lastname" => "0",
            "billing_address" => "",
            "billing_address_city" => "",
            "billing_address_region" => "",
            "billing_address_state" => "",
            "billing_address_poscode" => "",
            "billing_msisdn" => "",
            "billing_address_country_code" => "",
            "receiver_name_for_shipping" => "",
            "shipping_lastname" => "",
            "shipping_address" => "",
            "shipping_address_city" => "",
            "shipping_address_region" => "",
            "shipping_address_state" => "",
            "shipping_address_poscode" => "",
            "shipping_msisdn" => "",
            "shipping_address_country_code" => "",
            "item" => [
                [
                    "product" => "Invoice No. " . $trx->bill_no,
                    "qty" => "1",
                    "amount" => $trx->nominal . '00',
                    "payment_plan" => "01",
                    "merchant_id" => "99999",
                ],
            ],
            "reserve1" => "",
            "reserve2" => "",
            "signature" => $signature,
        ];

        $client = new Client();
        $response = $client->post($this->baseUrl . 'cvr/300011/10', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
            RequestOptions::JSON => $payloads,
            'http_errors' => false,
        ]);

        $status = $response->getStatusCode();
        if ($status == 200) {
            $body = $response->getBody();
            $stringBody = (string) $body;
            $json = json_decode($stringBody);
            if ($json == null) {
                $payment = false;
            } else {
                if (isset($json->response_error)) {
                    return null;
                } else {
                    $post = [];
                    if ($trx->payment_method_type == 'emoney' && $trx->payment_method_code != 812) {
                        $post['payment_url'] = $json->redirect_url;
                    } else if ($trx->payment_method_type == 'qris') {
                        if (isset($json->web_url)) {
                            $post['payment_url'] = $json->web_url;
                        } else {
                            return null;
                        }
                    } else if ($trx->payment_method_type == 'ewallet') {
                        $post['payment_url'] = $json->redirect_url;
                    }
                    // else {
                    //     $post['payment_url'] = $json->trx_id;
                    // }

                    if ($trx->payment_method_name == "QRIS") {
                        //get qris image url
                        $post['payment_url'] = $json->alt_url;
                    }

                    $post['bill_no'] = $json->bill_no;
                    $post['payment_ref'] = $json->trx_id;

                    //add to fee
                    $fee = self::$PAYMENT_DETAIL[$trx->payment_method_code][3];
                    if (is_string($fee)) {
                        $fee = (float)$fee;
                        $post['additional_fee'] = $trx->nominal * $fee / 100;
                    } else {
                        $post['additional_fee'] = $fee;
                    }
                    $post['total'] = $trx->nominal + $fee;

                    $trx->update($post);

                    if ($trx->payment_method_code == 812) {
                        $signature = sha1(md5(($this->username . $this->password . $json->trx_id)));
                        $baseUrl = $this->baseUrl . 'pws/ovo_direct';
                        return [
                            'type' => 'view',
                            'data' => view('front.donate.ovo')->with([

                                'trx_id' => $json->trx_id,
                                'ovo_number' => $user[2],
                                'signature' => $signature,
                                'url' => $baseUrl,
                            ]),
                        ];
                    }

                    return [
                        'type' => 'data',
                        'data' => $trx,
                    ];
                }
            }
        }

        return null;
    }

    public function getTransactionDetail($credential, $transaction)
    {
        $icon = asset("images/payment_channel/default.png");
        if (isset($this->PAYMENT_DETAIL[$transaction->payment_code])) {
            $icon = asset($this->PAYMENT_DETAIL[$transaction->payment_code][0]);
        }

        return [
            'pay_code' => $transaction->reference,
            'invoice' => $transaction->bill_no,
            'instruction' => [],
            'icon' => $icon,
        ];
    }

    public function paymentCallback()
    {
        $data_notif = file_get_contents('php://input');
        $data = json_decode($data_notif);
        $trx = null;

        $response_code = "00";
        $response_desc = "Payment Sukses";

        if (!$data) {
            $response_code = "01";
            $response_desc = "Payment Data Not Provided Correctly";

            $response = array(
                "response" => "Payment Notification",
                "response_code" => $response_code,
                "response_desc" => $response_desc,
            );
            echo json_encode($response);
            return;
        } else {
            try {
                $signature = sha1(md5(($this->username . $this->password . $data->bill_no . $data->payment_status_code)));
                if ($data->signature == $signature) {
                    // if (true) {

                    if ($data->payment_status_code == '2') {
                        DB::beginTransaction();
                        // process payment
                        try {
                            // Transaction
                            $trx = OrderPaketTrx::where('bill_no', $data->bill_no)
                                ->where('payment_method_code', $data->payment_channel_uid)
                                ->where('status', 'pending')
                                ->first();

                            if (!$trx) {
                                $response_code = "01";
                                $response_desc = "Payment Gagal, Transaksi Tidak Ditemukan";
                            } elseif ($trx->status != 'pending') {
                                $response_code = "01";
                                $response_desc = "Payment Gagal, Transaksi ini tidak aktif";
                            } else {
                                $trx->update([
                                    'status' => 'paid',
                                ]);

                                $access = AccessCode::create([
                                    'order_id' => $trx->order_id,
                                    'user_id' => $trx->user_id,
                                    'kelas_id' => $trx->kelas_id,
                                    'paket_id' => $trx->paket_id,
                                    'access_code' => $this->generateAccessCode()
                                ]);

                                $order = $trx->order;
                                if ($order) {

                                    $order->update([
                                        'status' => 'paid'
                                    ]);
                                    $kelas = $order->kelas;
                                    WANotif::sendNotif($order->order_phone, 1, [
                                        $kelas->title,
                                        $trx->bill_no,
                                        $access->access_code
                                    ]);
                                }


                                $response_code = "00";
                                $response_desc = "Success";
                                DB::commit();
                            }
                        } catch (\Exception $e) {
                            DB::rollback();
                            $response_code = "01";
                            $response_desc = "Payment Gagal, " . $e->getMessage();
                        }
                    } else {
                        $response_code = "01";
                        $response_desc = "Payment Gagal dengan status code " . $data->payment_status_code;
                    }
                } else {
                    $response_code = "01";
                    $response_desc = "Payment Gagal, signature tidak cocok";
                }
            } catch (\Exception $e) {
                $response_code = "01";
                $response_desc = "Payment Gagal, " . $e->getMessage();
            }
        }

        $response = array(
            "response" => "Payment Notification",
            "trx_id" => isset($data->trx_id) ? $data->trx_id : null,
            "merchant_id" => isset($data->merchant_id) ? $data->merchant_id : null,
            "merchant" => isset($data->merchant) ? $data->merchant : null,
            "bill_no" => isset($data->bill_no) ? $data->bill_no : null,
            "response_code" => $response_code,
            "response_desc" => $response_desc,
            "response_date" => date('Y-m-d H:is'),
            "trx" => $trx,
        );
        return json_encode($response);
    }
}
