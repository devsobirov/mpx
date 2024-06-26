<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
    }

    public function render($request, Throwable $exception)
    {
        if (
            !\Config::get('app.abort_if_404') &&
            ($exception instanceof ModelNotFoundException || $exception instanceof NotFoundHttpException)
        ) {
            \Log::info('404', [
                'url' => url()->current(),
                'user' => auth()->id()
            ]);
            return redirect('/', 302);
        }

        return parent::render($request, $exception);
    }
}
