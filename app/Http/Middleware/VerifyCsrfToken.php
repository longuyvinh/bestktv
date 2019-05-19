<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
//not exist this library
//use Symfony\Component\Security\Core\Util\StringUtils;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    // co the dung phuong thuc sau de add toke on view
    // view('home')->withEncryptedCsrfToken(Crypt::encrypt(csrf_token()));
    // vinh note: review this method
 	// protected function tokensMatch($request)
	// {
	// 	$token = $request->session()->token();
	// 	$header = $request->header('X-XSRF-TOKEN');
	// 	return StringUtils::equals($token, $request->input('_token')) || ($header && StringUtils::equals($token, $header));
	// }
}
