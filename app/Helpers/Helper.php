<?php


use App\Models\RechargRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

if (!function_exists('getSetting')) {
    function getSetting()
    {
        return DB::table('settings')->orderBy('id', 'DESC')->first();
    }
}

if (!function_exists('CurrencyFormat')) {
    function CurrencyFormat($number, $decimal = 1)
    {

        if (is_numeric($number)) {

            if (!$number) {

                $money = ($decimal == 2 ? '0.00' : '0.00');
            } else {

                if (floor($number) == $number) {

                    $money = number_format($number, ($decimal == 2 ? 2 : 2));
                } else {

                    $money = number_format(round($number, 2), ($decimal == 0 ? 0 : 2));
                }
            }

            return $money;
        }
        return 0;
    }
}

if (!function_exists('uploadImage')) {

    function uploadImage($file, string $path): string
    {

        $pathCreate = public_path("/uploads/$path/");
        if (!File::isDirectory($pathCreate)) {
            File::makeDirectory($pathCreate, 0777, true, true);
        }

        $updated_img = Image::make($file);
        $updated_img->resize(850, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $updated_img->save(public_path('/uploads/' . $path . '/') . $fileName);


        return "uploads/$path/" . $fileName;
    }
}


if (!function_exists('getCurrency')) {
    function getCurrency()
    {
        $currency = DB::table('currencies')->where('is_default', true)->first();
        \Illuminate\Support\Facades\Log::alert($currency->symbol);
        return $currency->symbol;
    }
}
if (!function_exists('getPrice')) {
    function getPrice($price): string
    {
        $currency_symbol = DB::table('config')->where('config_key', 'currency')->first();

        $currency = DB::table('currencies')->where('iso_code', $currency_symbol->config_value)->first();


        $convertedPrice = number_format($price, 2);

        if ($currency->symbol_first == 'true') {
            return $currency->symbol . ' ' . $convertedPrice;
        }

        return $convertedPrice . ' ' . $currency->symbol;
    }

    if (!function_exists('randomString')) {
        function randomString($length = 12)
        {
            $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
    }
}

if (!function_exists('getThumbnail')) {
    function getThumbnail($path = null): string
    {
        if ($path) {
            $pPath = public_path($path);
            if (file_exists($pPath)) {
                return asset($path);
            } else {
                return asset('assets/images/no-img.png');
            }
        } else {
            return asset('assets/images/no-img.png');
        }
    }
}

if (!function_exists('rechargePendingCount')) {

    function rechargePendingCount(): int
    {

        if (Auth::user()->can('admin.merchant.recharge.request.status')) {

            return RechargRequest::orderBy('id', 'desc')->where('status', 0)->count();
        } else {
            return 0;
        }
    }
}