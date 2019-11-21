<?php

namespace App;

use App\Mail\OTPMail;
use App\Notifications\OTPNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

/**
 * @property mixed id
 * @property mixed email
 * @property mixed phone
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'isVerified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function routeNotificationForKarix()
    {
        return $this->phone;
    }

    /*
     * Unique otp key for every user in cache
     */
    public function OTPKey()
    {
        return "OTP_for_{$this->id}";
    }

    /*
     * Get the OTP from cache
     */
    public function OTP()
    {
        return Cache::get($this->OTPKey());
    }

    /*
     * Cache the OTP for specific time
     */
    public function cacheTheOTP()
    {
        $otp = rand(100000, 999999);

        Cache::put($this->OTPKey(), $otp, now()->addSeconds(50));

        return $otp;
    }

    /*
     * Send the OTP by email/sms
     */
    public function sendOTP($via)
    {
        $this->notify(new OTPNotification($via, $this->cacheTheOTP()));

        // Use notification to distinguish between 'via' instead of this condition
//        if($via == 'via_sms')
//        {
//            $this->notify(new OTPNotification);
//        }
//        else {
//            Mail::to('hsn.saad@outlook.com')->send(new OTPMail($otp));
//        }
    }
}
