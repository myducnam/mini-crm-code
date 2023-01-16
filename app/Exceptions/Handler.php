<?php

namespace App\Exceptions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     *
     * @SuppressWarnings("unused")
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Throwable $e
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {
                case 404:
                case 405:
                case 500:
                    return redirect()->guest(route('login'));
                default:
                    return $this->renderHttpException($e);
            }
        }

        return parent::render($request, $e);
    }

    protected function prepareException(Throwable $e)
    {
        if ($e instanceof AuthorizationException) {
            $e = new AuthorizationException(
                '許可されていません',
                $e->getCode(),
                $e
            );
        }

        return parent::prepareException($e);
    }

    /**
     * override unauthenticated function
     *
     * @param mixed $request
     * @param AuthenticationException $exception
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->unauthenticated();
        }

        if (in_array('admin', $exception->guards())) {
            return redirect()->guest(route('admin.login'));
        }

        return redirect()->guest(route('login'));
    }
}
