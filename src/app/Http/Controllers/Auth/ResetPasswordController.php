<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\System\Setting;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';


    public function showResetForm(Request $request, $token = null)
    {
        $settingsRepository = resolve('App\Repositories\Repository\Configuration\SettingRepository');

        $logos = $settingsRepository->findByKey('ui_logos');
        $labels = $settingsRepository->findByKey('ui_project_labels');


        return view('auth.passwords.reset')->with(
            [
                'token' => $token,
                'email' => $request->email,
                'logos' => $logos->value,
                'labels' => $labels->value
            ]
        );
    }

    /**
     * Get the response for a successful password reset.
     *
     * @param Request $request
     * @param string $response
     *
     * @return Application|Redirector|RedirectResponse
     */
    protected function sendResetResponse(Request $request, $response)
    {
        session([
            'changedPassword' => true
        ]);
        return redirect($this->redirectPath())
            ->with('status', trans($response));
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'password' => 'required|confirmed|min:6',
        ];
    }
}
