<?php

namespace App\Traits;

use App\Models\AccessCode;
use App\Models\OrderPaketTrx;
use Illuminate\Support\Str;

trait Generator
{
    static function generateBillNo($prefix = 'BILL-')
    {
        $now = $prefix . date('Ymd');

        $max = OrderPaketTrx::orderBy('bill_no', 'DESC')
            ->where('bill_no', 'LIKE', $now . '%')
            ->pluck('bill_no')
            ->first();

        $new = 1;
        if ($max) {
            $new = (int)str_replace($now, "", $max) + 1;
        }
        $concated = $now . str_pad($new, 4, '0', STR_PAD_LEFT);

        $check = OrderPaketTrx::where('bill_no', $concated)
            ->count();

        if ($check > 0) {
            return self::generateBillNo();
        }
        return $concated;
    }

    static function generateAccessCode()
    {
        $code = Str::random(8);
        $check = AccessCode::where('access_code', $code)
            ->count();

        if ($check > 0) {
            return self::generateAccessCode();
        }
        return $code;
    }
}
