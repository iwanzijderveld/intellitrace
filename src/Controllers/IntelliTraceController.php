<?php namespace Insanetlabs\IntelliTrace\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Insanetlabs\IntelliTrace\Models\Visitor;
use Illuminate\Routing\Controller as BaseController;
use Insanetlabs\IntelliTrace\Models\IntelliTraceUser;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Insanetlabs\IntelliTrace\Middleware\RedirectIfNotAuthenticated;

class IntelliTraceController extends BaseController
{
    use ValidatesRequests, AuthorizesRequests;


    public function __construct()
    {
        $this->middleware(RedirectIfNotAuthenticated::class);
    }

    public function dashboard()
    {
        $data = array(
            'visitors' => Visitor::where([['timestamp', '>=', date('Y-m-d')]])->orderBy('ip')->get()->unique('ip')
        );

        return view('intellitrace::maps', $data);
    }

    public function overview()
    {
        $data = array(
            'visitors' => Visitor::where([['timestamp', '>=', date('Y-m-d')]])->orderBy('timestamp', 'DESC')->get()
        );

        return view('intellitrace::overview', $data);
    }
}