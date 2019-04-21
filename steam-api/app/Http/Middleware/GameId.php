<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Validator;

class GameId
{
    /**
     * Checks if an account id parameter is set.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request->all(), [
            'gameid' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'No Game id was found.'
            ]);
        }
        return $next($request);
    }
}
