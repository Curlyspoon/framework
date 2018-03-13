<?php

namespace Curlyspoon\Framework\Exceptions;

use Exception;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        HttpException::class,
    ];

    public function report(Exception $e)
    {
        parent::report($e);
    }

    public function render($request, Exception $e)
    {
//        if($e instanceof HttpException) {
//            $status = $e->getStatusCode();
//            if(view()->exists('errors.'.$status)) {
//                return view('errors.'.$status);
//            }
//        }

        return parent::render($request, $e);
    }
}
