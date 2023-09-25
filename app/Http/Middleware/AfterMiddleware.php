<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AfterMiddleware
{
    public function handle(Request $request, Closure $next): JsonResponse
    {
        /** @var JsonResponse $data */
        $data = $next($request);

        $data->headers->set('Content-Type', 'application/json;charset=UTF-8');
        $data->headers->set('Charset', 'utf-8');
        $data->headers->set('Locale', App::currentLocale());

        $headers = $data->headers->all();
        $responseCode = $data->getStatusCode();
        //$data = json_decode($data->getContent(), true, 512, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

        return response()->json(
            data: $data,
            status: $responseCode,
            headers: $headers,
            options: JSON_UNESCAPED_UNICODE
        );
    }
}
