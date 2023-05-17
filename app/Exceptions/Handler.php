<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
        // spatie exception
        $this->renderable(function (UnauthorizedException $e, $request){
            return response()->json([
                'message' => 'You dont have the required authorization',
                'status'  => 403
            ], Response::HTTP_FORBIDDEN);
        });

        //Laravel API 404 Error: Customize Exception Message
        //https://youtu.be/SlBJrLnyoMk
        $this->renderable(function(NotFoundHttpException $e, $request){
            //check if api request or not
            if($request->wantsJson()){
                return response()->json([
                    'message' => 'Object not found',
                    'status'  => 404
                ], Response::HTTP_NOT_FOUND);
            }
        });
    }
}
