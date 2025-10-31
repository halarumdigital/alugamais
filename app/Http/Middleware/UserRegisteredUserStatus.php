<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRegisteredUserStatus
{
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle(Request $request, Closure $next)
  {
    if (Auth::guard('customer')->check()) {
      $userInfo = Auth::guard('customer')->user();
  
      if ($userInfo->status == 0) {
        Auth::guard('customer')->logout();
  
        $request->session()->flash('error', __('Sorry, your account has been deactivated.'));
  
        return redirect()->route('customer.login', getParam());
      } elseif(empty(Auth::guard('customer')->user()->email_verified_at)) {
          Auth::guard('customer')->logout();
          $request->session()->flash('error',__('Your email is not verified!'));
          return redirect()->route('customer.login', getParam());
      }
    }

    return $next($request);
  }
}
