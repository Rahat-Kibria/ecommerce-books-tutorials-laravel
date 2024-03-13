<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SmsController extends Controller
{
    public function otp_verify_account($user)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটুশপে স্বাগতম। আপনার ওটিপি হচ্ছে " . $user->otp . " ।এটি দিয়ে ভেরিফাই করুন আপনার Account/Address.";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
        $smsresult = json_decode($sms_result);
        if ($smsresult[0]->status == "SENT") {
            echo "SMS sent successfully <br>";
            echo $smsresult[0]->to . "<br>";
            echo $smsresult[0]->status . "<br>";
            echo $smsresult[0]->statusmsg . "<br>";
            return true;
        } else {
            echo "Failed to send";
            echo $smsresult[0]->to . "<br>";
            echo $smsresult[0]->status . "<br>";
            echo $smsresult[0]->statusmsg . "<br>";
            return false;
        }
    }
    public function otp_verify_user($user)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটুশপে স্বাগতম। আপনার ওটিপি হচ্ছে " . $user->otp . " ।এটি দিয়ে ভেরিফাই করুন আপনার Account/Address.";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
        $smsresult = json_decode($sms_result);
        if ($smsresult[0]->status == "SENT") {
            echo "SMS sent successfully <br>";
            echo $smsresult[0]->to . "<br>";
            echo $smsresult[0]->status . "<br>";
            echo $smsresult[0]->statusmsg . "<br>";
            return true;
        } else {
            echo "Failed to send";
            echo $smsresult[0]->to . "<br>";
            echo $smsresult[0]->status . "<br>";
            echo $smsresult[0]->statusmsg . "<br>";
            return false;
        }
    }
    public function otp_order_number($user, $order_id)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটুশপে স্বাগতম। আপনার অর্ডার ট্রেকিং নাম্বার হচ্ছে " . $order_id . " । এটা দিয়ে আপনি অর্ডার ট্র্যাক করতে পারবেন এবং স্ট্যাটাস দেখতে পারবেন।";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
    }
    public function create_auth_plus_mail($user, $username, $password)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটুশপে স্বাগতম। আমাদের দেয়া ইমেইল পাসওয়ার্ড দিয়ে লগইন করুন। তাহলে আপনি আমাদের অডিও বকু এবং ই-বকু ডাউনলোড করতে পারবেন। আপনার ইমেইল: " . $user->email . ", আপনার ইউজার নেইম: " . $username . ", আপনার পাসওয়ার্ড: " . $password . " ।";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
    }

    public function seen_by_admin_to_yes($user, $order)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটু শপে স্বাগতম। আপনার " . $order->id . " নাম্বার অর্ডারটি প্রক্রিয়াজাত হচ্ছে।";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
    }

    public function seen_by_admin_to_no($user, $order)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটু শপে স্বাগতম। আপনার " . $order->id . " নাম্বার অর্ডারটির প্রক্রিয়া বন্ধ অবস্থায় আছে। অনুগ্রহ করে কাস্টমার কেয়ারে যোগাযোগ করুন।";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
    }

    public function out_for_delivery_to_yes($user, $order)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটু শপে স্বাগতম। আপনার " . $order->id . " নাম্বার অর্ডারটি এখন ডেলিভারির জন্য বের হয়েছে। ইনশাল্লাহ আজকে পেয়ে যাবেন।";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
    }

    public function out_for_delivery_to_no($user, $order)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটু শপে স্বাগতম। আপনার " . $order->id . " নাম্বার অর্ডারটি ডেলিভারি আজ দেওয়া সম্ভব হয়নি। আপনাকে পরে জানানো হবে আবার।";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
    }

    public function completed_to_yes($user, $order)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটু শপে স্বাগতম। আপনার " . $order->id . " নাম্বার অর্ডারটি সম্পন্ন হয়ে গেছে। প্রোডাক্ট কেমন লেগেছে জানাবেন রিভিউতে।";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
    }

    public function completed_to_no($user, $order)
    {
        $to = $user->contact_number;
        $token = "945213514116835323011d77642a8244ac597d2896bdca4abcd5";
        $message = "আসসালামু আলাইকুম, আমাদের বটু শপে স্বাগতম। আপনার " . $order->id . " নাম্বার অর্ডারটি অসম্পন্ন হয়ে গেছে। অনুগ্রহ করে কাস্টমার কেয়ারে যোগাযোগ করুন।";
        $url = "http://api.greenweb.com.bd/api.php?json";
        $data = array(
            'to' => "$to",
            'message' => "$message",
            'token' => "$token"
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $sms_result = curl_exec($ch);
    }
}
