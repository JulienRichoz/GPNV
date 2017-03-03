<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProjectControl extends Validator
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
      if (Auth::user()->projects()->find($request->id) || Auth::user()->role_id==2){
        if(($request->isMethod('post') || $request->isMethod('delete')) && Auth::user()->projects()->find($request->id))
          return $next($request);
        elseif ($request->isMethod('get'))
          return $next($request);
        else
          return redirect('project/' . $request->id);
      }
      else
        return redirect('/');
    }
}
