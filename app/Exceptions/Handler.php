<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        $this->renderable(function (ThrottleRequestsException $exception, $request) {
            $retryAfter = $exception->getHeaders()['Retry-After'] ?? 60;

            // Check if the request is an API request
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Too many requests! Please slow down and try again later.',
                    'retry_after' => $retryAfter
                ], 429);
            }

            return response()->view('errors.429', ['retryAfter' => $retryAfter], 429);
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ThrottleRequestsException) {
            return response()->json([
                'message' => 'Too many requests! Please slow down and try again later.',
                'retry_after' => $exception->getHeaders()['Retry-After'] ?? 60 // Retry time in seconds
            ], 429);
        }

        return parent::render($request, $exception);
    }
}
