<?php

namespace App\Http\Controllers\Api\User\Auth;

use App\Mail\Mailer;
use App\Models\User;
use App\Models\Device;
use App\Traits\Response;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Api\User\Auth\Login;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\Api\User\Auth\SendOtp;
use App\Http\Requests\Api\User\Auth\VerifyPhone;
use App\Http\Requests\Api\User\Auth\UpdatePassword;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use App\Http\Resources\Api\User\User\ProfileResource;

class AuthController extends Controller
{
    use Response;

    public function send_otp(SendOtp $request)
    {
        // Get the user by phone,
        $email = $request->email;
        $user = User::where(['email' => $request->email])->first();

        if (!$user) {
            return $this->sendResponse(401, __('api.auth.provided_email_not_found'), null, 401);
        }

        if (!$user->is_active) {
            return $this->sendResponse(422, __('api.auth.your_account_deactivated'), null, 422);
        }

        if ($user->is_banned) {
            return $this->sendResponse(405, __('api.auth.your_account_have_been_banned'), null, 405);
        }

        // Generate an OTP
        $otp = "1111";
        //TODO: uncomment the following line
        // $otp = rand(1000, 9999);
        $data['subject'] = __('api.auth.otp_code');
        $data['title']   = $otp;
        $data['message'] = __('api.auth.your_verification_code');
        Mail::to($email)->send(new mailer($data));
        // Update user's OTP
        $user->update(['otp' => $otp]);
        return $this->sendResponse(200, __('api.auth.otp_sent_successfully'), null, 200);
    }

    public function login(Login $request)
    {
        $user = User::where(['email' => $request->email])->first();

        if (!$user) {
            return $this->sendResponse(422, __('api.auth.provided_email_not_found'), null, 422);
        }

        return $this->login_user($user, $request);
    }

    public function login_user($user, $request)
    {
        // Attempt user login
        $token = auth('user')->attempt(['email' => $request->email, 'password' => $request->password]);
        if (!$token) {
            return $this->sendResponse(401, __('api.auth.wrong_email_or_password'), null, 401);
        }

        $user = auth('user')->user();

        if (!$user->is_active) {
            return $this->sendResponse(422, __('api.auth.your_account_deactivated'), null, 422);
        }

        if ($user->is_banned) {
            return $this->sendResponse(405, __('api.auth.your_account_have_been_banned'), null, 405);
        }

        // create or update user device token
        // if ($request->device_token) {
        //     Device::updateOrCreate(['device_type' => $request->device_type, 'user_id' => $user->id], [
        //         'device_token' => $request->device_token,
        //         'device_type' => $request->device_type,
        //         'user_id' => $user->id
        //     ]);
        // }

        $this->setUserToken($user, $token);

        return $this->sendResponse(200, __('api.auth.login_success'), ProfileResource::make($user), 200);
    }

    public function verify_forget_password(VerifyPhone $request)
    {
        // Get the user by phone, phone code, and OTP
        $user = User::where(['email' => $request->email])->first();

        if (!$user) {
            return $this->sendResponse(401, __('api.auth.provided_email_not_found'), null, 401);
        }

        if ($user->otp == null || $user->otp !== $request->otp) {
            return $this->sendResponse(401, __('api.auth.incorrect_otp'), null, 401);
        }

        // $user->update([
            // 'is_active' => true,
            // 'phone_confirmed ' => true,
        // ]);

        return $this->sendResponse(200, __('api.auth.OTP_Correct'), null, 200);
    }

    public function update_password(UpdatePassword $request)
    {
        // Fetch the user by matching phone, and forget password code
        $user = User::where(['email' => $request->email,])->first();

        if ($user->otp !== $request->otp) {
            return $this->sendResponse(422, __('api.auth.incorrect_otp'), null, 422);
        }

        // Update user's password and clear the forget password code
        $user->update(['password' => $request->password, 'otp' => null]);

        return $this->sendResponse(200, __('api.auth.password_updated_successfully'), null, 200);
    }

    private function setUserToken($user, $token)
    {
        data_set($user, 'token', $token);
    }

    public function logout()
    {
        $user = auth('user');

        if (!$user) {
            return $this->sendResponse(422, __('api.auth.provided_email_not_found'), null, 422);
        }

        $user->logout();

        return $this->sendResponse(200, __('api.auth.log_out_success'), null, 200);
    }

    function isTokenExpired(Request $request)
{
    try {
        $token = $request->bearerToken();

        if (!$token) {
            return $this->sendResponse(422, __('api.auth.token_not_found'), null, 422);
        }

        $payload = JWTAuth::setToken($token)->getPayload();

        return $this->sendResponse(200, __('api.auth.token_is_valid'), null, 200);
    } catch (TokenExpiredException $e) {
        return $this->sendResponse(401, __('api.auth.token_has_expired'), null, 401);
    } catch (JWTException $e) {
        return $this->sendResponse(400, __('api.auth.token_is_invalid'), null, 400);
    }
}
}
