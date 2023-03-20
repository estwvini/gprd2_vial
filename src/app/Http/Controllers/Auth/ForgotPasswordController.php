<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        $settingsRepository = resolve('App\Repositories\Repository\Configuration\SettingRepository');

        $logos = $settingsRepository->findByKey('ui_logos');
        $labels = $settingsRepository->findByKey('ui_project_labels');

        return view('auth.passwords.email', [
            'logos' => $logos->value,
            'labels' => $labels->value
        ]);
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param Request  $request
     * @param  string  $response
     *
     * @return Application|Redirector|RedirectResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return redirect('login')->with('status', trans($response));
    }
}
