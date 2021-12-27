<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Auth;
use App\models\User;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::WELCOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function verify(Request $request)
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        } else {
            $user->markEmailAsVerified();
        }

        return redirect($this->redirectPath())->with('verified', true);
    }

    public function show(Request $request)
    {
        if (Auth::user()) {

            $user = User::find(Auth::id());

            return $user->hasVerifiedEmail()
                ? redirect($this->redirectPath())
                : view('auth.verify');
        } else {
            return redirect()->route('login');
        }
    }



    public function myVerify()
    {
        dd('test');
    }
}
