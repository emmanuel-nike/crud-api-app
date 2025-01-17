<?php

namespace App\Http\Middleware;

use App\Models\Activity;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class LogMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $contents = json_decode($response->getContent(), true, 512);

        $headers  = $request->header();

        $data = [
            'request_path'         => $request->getPathInfo(),
            'request_method'       => $request->getMethod(),
            'ip_address'           => $request->ip(),
            'headers'              => json_encode([
                'user-agent' => $headers['user-agent'],
                'host'     => $headers['host'],
            ]),
        ];

        // if request if authenticated
        if ($request->user()) {
            $data['user_id'] = $request->user()->id;
            $data['user_name'] = $request->user()->name;
        }

        // if you want to log all the request body
        if (count($request->all()) > 0) {
           $hiddenKeys = ['password'];
           $data['request_body'] = json_encode($request->except($hiddenKeys));
       }

       // to log the message from the response
       if (!empty($contents['message'])) {
           $data['message'] = $contents['message'];
       }

       if (!empty($contents['errors'])) {
           $data['errors'] = $contents['errors'];
       }

       $data['response_body'] = substr(json_encode($contents), 0, 250);

       Activity::create($data);

       return $response;
    }
}
