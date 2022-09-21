<?php

namespace App\Models;

use App\Services\Twilio\TwilioSmsService;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Twilio\Rest\Client;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'role',
    ];

    /**
     * @param array $attributes
     * @return array
     */
    public function setDataCreate(array $attributes): array
    {
        $data['first_name'] = $attributes['first_name'];
        $data['last_name'] = $attributes['last_name'];
        $data['email'] = $attributes['email'];
        $data['password'] = bcrypt($attributes['password']);
        $data['phone'] = $attributes['phone'];
        $data['role_id'] = $attributes['role_id'];
        return $data;
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setDataUpdate(array $attributes): User
    {
        $this->first_name = $attributes['first_name'];
        $this->last_name = $attributes['first_name'];
        if (array_key_exists('password', $attributes) && $attributes['password']) {
            $this->password = bcrypt($attributes['password']);
        }
        $this->phone = $attributes['phone'];
        $this->role_id = $attributes['role_id'];
        return $this;
    }

    /**
     * @return $this
     */
    public function verifyEmail(): User
    {
        $this->email_verified_at = Carbon::now();
        return $this;
    }

    /**
     * @return void
     */
    public function generateTwoFactorAuthCode()
    {
        $code = rand(1000, 9999);
        $user = Auth::user();
        $lastCode = TwoFactorAuthCode::where('user_id', $user->id)->first();
        if ($lastCode) {
            $lastCode->code = $code;
            $lastCode->save();
        } else {
            TwoFactorAuthCode::updateOrCreate([
                'user_id' => $user->id,
                'code' => $code,
            ]);
        }
        $receiverNumber = "+57$user->phone";
        $this->sendSmsTwoFactorCode($receiverNumber, $code);
    }

    /**
     * @param string $phone
     * @param string $code
     * @return void
     */
    public function sendSmsTwoFactorCode(string $phone, string $code)
    {
        try {
            $twilioSmsService = new TwilioSmsService();
            $twilioSmsService->sendSmsTwoFactorCode($phone, $code);
        } catch (\Exception $exception) {
            info("Error: ". $exception->getMessage());
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sessions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Session::class);
    }
}
