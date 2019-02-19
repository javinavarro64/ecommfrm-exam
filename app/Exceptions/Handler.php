<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Exception;

final class Handler extends ExceptionHandler
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
        if ($this->isApiRequest($request)) {
            return $this->prepareJsonResponse($request, $exception);
        } else {
            return parent::render($request, $exception);
        }
    }
    
    /**
     * Prepare a JSON response for the given exception.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function prepareJsonResponse($request, Exception $e)
    {
        $status = $this->isHttpException($e) ? $e->getStatusCode() : 500;
        $headers = $this->isHttpException($e) ? $e->getHeaders() : [];

        $data = [
            'error' => $this->isNotFoundHttpException($e) ? 'Resource not found!' : $e->getMessage(),
            'code' => $this->isApiException($e) && $e->getPrevious() ? $e->getPrevious()->getCode() : $e->getCode()
        ];
        
        return new JsonResponse($data, $status, $headers, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
    
    /**
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    private function isApiRequest($request)
    {
        return strpos($request->fullUrl(), 'api') !== false;
    }
    
    /**
     *
     * @param \Exception $e
     * @return boolean
     */
    private function isApiException(Exception $e)
    {
        return $e instanceof ApiException;
    }
    
    /**
     *
     * @param \Exception $e
     * @return boolean
     */
    private function isNotFoundHttpException(Exception $e)
    {
        return $e instanceof NotFoundHttpException;
    }
}
