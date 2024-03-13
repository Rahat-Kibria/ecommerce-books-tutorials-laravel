<?php

namespace App\Http\Controllers\frontend;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AuthCreate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    /**
     * Password reset page
     */
    public function forgot_password_page()
    {
        return view('auth.forgot_password');
    }
    public function password_email_sent(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink(
            $request->only('email')
        );
        return $status === Password::RESET_LINK_SENT
            ? back()->with(['success' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
    public function password_reset_page(string $token)
    {
        return view('auth.reset_password', ['token' => $token]);
    }
    public function password_update(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('success', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
    public function otp_check(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        if ($request->otp === $user->otp) {
            $user->otp = null;
            $user->save();
            session()->flash('success', 'Contact Verified Successfully');
            if (isset($user->password) && !empty($user->password)) {
                Auth::login($user);
                session()->flash('success', 'Logged in successfully');
                return redirect()->back();
            } else {
                return view('auth.socialite_password', compact('user'));
            }
        } else {
            return back()->with('error', 'Sorry wrong otp. Try again?');
        }
    }
    /**
     * Socialite login
     */
    public function auth_google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function auth_google_callback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::updateOrCreate([
            'provider_id' => $googleUser->id,
        ], [
            'first_name' => $googleUser->user['given_name'],
            'last_name' => $googleUser->user['family_name'],
            'email' => $googleUser->email,
            'role' => 'auth_user'
        ]);
        if (isset($user->contact_number) && !empty($user->contact_number)) {
            if ($user->otp == null) {
                if (isset($user->password) && !empty($user->password)) {
                    Auth::login($user);
                    session()->flash('success', 'Logged in successfully');
                    return redirect()->back();
                } else {
                    return view('auth.socialite_password', compact('user'));
                }
            } else {
                $user_id = $user->id;
                session()->flash('error', 'You have to verify contact with OTP');

                $otp_verify_account = new SmsController();
                $otp_success = $otp_verify_account->otp_verify_account($user);
                if ($otp_success === true) {
                    return view('auth.otp_register', compact('user_id'));
                } else {
                    echo "<br><br>Wait... Redirecting in 3 seconds...";
                    header('refresh: 3; url=/');
                }
            }
        } else {
            session()->flash('error', 'You have to add a contact number');
            $user_id = $user->id;
            return view('auth.add_contact_no', compact('user_id'));
        }
    }
    public function auth_facebook_redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function auth_facebook_callback()
    {
        $facebookUser = Socialite::driver('facebook')->user();
        //split first name and last name from facebook name only
        $splitName = explode(' ', $facebookUser->name, 2); // Restricts it to only 2 values
        $first_name = $splitName[0];
        $last_name = !empty($splitName[1]) ? $splitName[1] : '';
        $user = User::updateOrCreate([
            'provider_id' => $facebookUser->id,
        ], [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $facebookUser->email,
            'role' => 'auth_user'
        ]);
        if (isset($user->contact_number) && !empty($user->contact_number)) {
            if ($user->otp == null) {
                if (isset($user->password) && !empty($user->password)) {
                    Auth::login($user);
                    session()->flash('success', 'Logged in successfully');
                    return redirect()->back();
                } else {
                    return view('auth.socialite_password', compact('user'));
                }
            } else {
                $user_id = $user->id;
                session()->flash('error', 'You have to verify contact with OTP');

                $otp_verify_account = new SmsController();
                $otp_success = $otp_verify_account->otp_verify_account($user);

                if ($otp_success === true) {
                    return view('auth.otp_register', compact('user_id'));
                } else {
                    echo "<br><br>Wait... Redirecting in 3 seconds...";
                    header('refresh: 3; url=/');
                }
            }
        } else {
            session()->flash('error', 'You have to add a contact number');
            $user_id = $user->id;
            return view('auth.add_contact_no', compact('user_id'));
        }
    }
    public function solialite_password_update(Request $request, $user_id)
    {
        $request->validate(['password' => 'required|confirmed|min:8']);
        $user = User::findOrFail($user_id);
        $user->update(['password' => bcrypt($request->password)]);
        Auth::login($user);
        session()->flash('success', 'Logged in successfully');
        return redirect()->route('botu');
    }
    public function solialite_contact_update(Request $request)
    {
        $request->validate(['contact_number' => 'required|digits:11']);
        $user = User::where('id', $request->user_id)->first();
        $user->update(['contact_number' => $request->contact_number]);
        $user_id = $user->id;
        session()->flash('error', 'You have to verify contact with OTP');
        $otp_number = rand(1111, 9999);
        $user->otp = $otp_number;
        $user->save();

        $otp_verify_account = new SmsController();
        $otp_success = $otp_verify_account->otp_verify_account($user);

        if ($otp_success === true) {
            return view('auth.otp_register', compact('user_id'));
        } else {
            echo "<br><br>Wait... Redirecting in 3 seconds...";
            header('refresh: 3; url=/');
        }
    }

    public function create_auth_plus_mail(Request $request)
    {
        $user = User::find($request->user_id);
        $username = uniqid();
        $password = uniqid();
        $user->update([
            'username' => $username,
            'password' => bcrypt($password),
            'role' => 'auth_user'
        ]);

        Mail::to($user->email)->send(new AuthCreate($user, $username, $password));

        $create_auth_plus_mail = new SmsController();
        $create_auth_plus_mail->create_auth_plus_mail($user, $username, $password);

        return back()->with('success', 'Successfully created auth and sent email and sms');
    }
}
