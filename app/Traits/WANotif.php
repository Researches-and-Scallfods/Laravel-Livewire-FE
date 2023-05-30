<?php

namespace App\Traits;

use GuzzleHttp\Client;

class WANotif
{
    public static function messageTemplates($index = 0, $params = [])
    {
        if ($index == 0 && count($params) == 3) {
            // registered to paket
            // NAMA_KELAS, TRX_ID, LINK PEMBAYARAN
            $message = "Selamat, anda telah terdaftar di kelas {1} dengan ID Transaksi {2}. Selanjutnya silahkan lakukan pembayaran sesuai instruksi berikut {3}";
            return strtr($message, [
                "{1}" => $params[0],
                "{2}" => $params[1],
                "{3}" => $params[2],
            ]);
        } elseif ($index == 1 && count($params) == 3) {
            // paid paket
            // NAMA_KELAS, TRX_ID, KODE_AKSES
            $message = "Terimakasih telah melakukan pembelian kelas {1} dengan ID Transaksi {2}. Selanjutnya anda dapat mengakses kelas dengan kode akses berikut *{3}*. Atau anda dapat langsung ikuti tautan berikut {4}";
            return strtr($message, [
                "{1}" => $params[0],
                "{2}" => $params[1],
                "{3}" => $params[2],
                "{4}" => url('/kode-akses/' . $params[2])
            ]);
        }

        throw new \Exception("Oops, message template is invalid");
    }

    public static function sendNotif($phone, $template = 0, $params = [])
    {
        try {
            $client = new Client();
            $response = $client->post('https://goowa.id/api/send_message', [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'form_params' => [
                    'token' => config("wa.ruang_wa_token", ""),
                    'number' => self::generatePhone($phone),
                    'message' => self::messageTemplates($template, $params),
                    'date' => date('Y-m-d'),
                    'time' => date('H:i:s'),
                ],
                'http_errors' => false,
            ]);

            $status = $response->getStatusCode();
            if ($status == 200) {
                $body = $response->getBody();
                $stringBody = (string) $body;
                $output = json_decode($stringBody);
                return $output;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    private static function generatePhone($phone)
    {
        if ($phone[0] == '+') {
            $phone = str_replace('+', '', $phone);
        }

        if ($phone[0] == 0) {
            return '62' . substr($phone, 1, strlen($phone));
        } else {
            return $phone;
        }
    }
}
