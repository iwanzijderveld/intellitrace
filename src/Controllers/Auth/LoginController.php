<?php namespace Insanetlabs\IntelliTrace\Controllers\Auth;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Insanetlabs\IntelliTrace\Models\Visitor;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Controller as BaseController;
use Insanetlabs\IntelliTrace\Models\IntelliTraceUser;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Insanetlabs\IntelliTrace\Middleware\RedirectIfAuthenticated;
use Insanetlabs\IntelliTrace\Middleware\RedirectIfNotRegistered;

class LoginController extends BaseController
{
    use ValidatesRequests, AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware(RedirectIfNotRegistered::class);
        $this->middleware(RedirectIfAuthenticated::class)->except('logout');
    }

    public function showLoginPage()
    {
        return view('intellitrace::auth.login');
    }

    public function loggedOut()
    {
        return redirect('/intellitrace');
    }

    protected function authenticated()
    {
        return redirect('intellitrace/dashboard');
    }

    protected function guard()
    {
        return Auth::guard('intellitrace');
    }
}
