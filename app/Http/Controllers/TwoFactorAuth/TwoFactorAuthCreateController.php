<?php

namespace App\Http\Controllers\TwoFactorAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorAuth\TwoFactorAuthCreateRequest;
use App\Models\TwoFactorAuthCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TwoFactorAuthCreateController extends Controller
{
    /**
     * @var TwoFactorAuthCode
     */
    protected $twoFactorAuthCode;

    /**
     * @param TwoFactorAuthCode $twoFactorAuthCode
     */
    public function __construct(TwoFactorAuthCode $twoFactorAuthCode)
    {
        $this->middleware([
            'auth'
        ]);
        $this->twoFactorAuthCode = $twoFactorAuthCode;
    }

    /**
     * @param TwoFactorAuthCreateRequest $twoFactorAuthCreateRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(TwoFactorAuthCreateRequest $twoFactorAuthCreateRequest): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $code = $this->twoFactorAuthCode
            ->where('user_id', $user->id)
            ->where('code', $twoFactorAuthCreateRequest->get('code', null))
            ->where('updated_at', '>=', Carbon::now()->subMinutes(2))
            ->first();
        if ($code) {
            Session::put('user_2fa', $user->id);
            return redirect()->route('home');
        }
        return back()->with('error', 'Haz ingresaste un código incorrecto.');
    }
}
