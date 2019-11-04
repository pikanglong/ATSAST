<?php

namespace App\Http\Middleware\Course;

use App\Models\Eloquents\Course;
use Closure;
use Auth;

class Manage
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
        $course = $request->course;
        if(!$course->is_manager(Auth::user()->id)){
            if($request->isMethod('get')){
                return redirect()->route('course');
            }else{
                return ResponseModel::err(2003);
            }
        }
        return $next($request);
    }
}