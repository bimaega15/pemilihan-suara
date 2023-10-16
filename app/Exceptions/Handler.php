<?php

namespace App\Exceptions;

use BadMethodCallException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register(): void
    {
        $this->renderable(function (MethodNotAllowedHttpException $e) {
            return response()->json(['error' => 'Method Not Allowed', 'success' => false, 'message' => $e->getMessage()], SymfonyResponse::HTTP_METHOD_NOT_ALLOWED);
        });

        $this->renderable(function (NotFoundHttpException $e) {
            return response()->json(['error' => 'Http NotFound', 'success' => false, 'message' => $e->getMessage()], SymfonyResponse::HTTP_NOT_FOUND);
        });

        $this->renderable(function (UnauthorizedException $e) {
            return response()->json(['error' => 'You do not have the required authorization.', 'success' => false, 'message' => $e->getMessage()], 403);
        });

        $this->renderable(function (BadMethodCallException $e) {
            return response()->json(['error' => 'Bad Method Call Exception', 'success' => false, 'message' => $e->getMessage()], 403);
        });
    }
}
