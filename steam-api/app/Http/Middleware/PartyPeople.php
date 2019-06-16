<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Validator;

class PartyPeople
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'party' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'No party members where found.'
            ]);
        }
        return $next($request);
    }
}
