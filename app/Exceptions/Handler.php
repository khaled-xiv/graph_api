<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {

        if ($e instanceof ModelNotFoundException) {
            $model = strtolower(class_basename($e->getModel()));
            return response()->json(['message ' => 'Does not exist any ' . $model . ' with the specified identificator'], 404);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json(['message ' => 'The specified URL cannot be found'], 404);
        }
        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json(['message ' => 'The specified method for the request is invalid'], 405);
        }

        if (config('app.debug')) {
            return parent::render($request, $e);
        }

        return response()->json(
            ['message ' => 'Unexpected exception. Try later'],
            500
        );
    }
}
