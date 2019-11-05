<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Arr;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */

    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /*
     * Phương thức Xử lý nếu đăng nhập không thành công
     * redirect khi người dùng không xác thực
     * */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if($request->expectsJson()){
            return response()->json(['error' => 'Unauthenticated.'],401);
        }

        $guard = Arr::get($exception->guards(),0);
        /*
         * Nếu admin đăng nhập không thành công thì
         * sẽ trả về view bắt chúng ta phải đăng nhập trong admin
         * còn nếu không phải admin thì trả về bắt chúng ta đăng nhập ở login người dùng
         * */
        switch($guard){
            case 'admin' :
                $login = 'admin.login';
                break;
            default:
                $login = 'login';
                break;
        }

        return redirect()->guest(route($login));
    }
}
