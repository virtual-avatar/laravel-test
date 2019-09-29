<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class FormMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $errors = null;
        $result = self::validateOgrn($request->input('ogrn'), $errors);

        if (!$result)
            return Redirect::back()->withErrors([$errors])->withInput();

        return $next($request);
    }

    /**
     * @param $ogrn
     * @param null $error_message
     * @param null $error_code
     * @return bool
     */
    private static function validateOgrn($ogrn, &$error_message = null, &$error_code = null)
    {
        $result = false;
        $ogrn = (string)$ogrn;
        if (!$ogrn) {
            $error_code = 1;
            $error_message = 'ОГРН пуст';
        } elseif (preg_match('/[^0-9]/', $ogrn)) {
            $error_code = 2;
            $error_message = 'ОГРН может состоять только из цифр';
        } elseif (strlen($ogrn) !== 13) {
            $error_code = 3;
            $error_message = 'ОГРН может состоять только из 13 цифр';
        } else {
            $n13 = (int)substr(bcsub(substr($ogrn, 0, -1),bcmul(bcdiv(substr($ogrn, 0, -1),
                        '11',0),'11')),-1);
            if ($n13 === (int)$ogrn{12}) {
                $result = true;
            } else {
                $error_code = 4;
                $error_message = 'Неправильное контрольное число';
            }
        }
        return $result;
    }
}
