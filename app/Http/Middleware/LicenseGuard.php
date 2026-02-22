<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\RegisteredDevice;
use App\Helpers\HardwareHelper;

class LicenseGuard
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    if ($request->is('activate*')) {
        return $next($request);
    }

    // ၂. လက်ရှိစက်ရဲ့ ID ကို ယူမယ်
    $fingerprint = HardwareHelper::getFingerprint();

    // ၃. Database ထဲမှာ ဒီစက်ရှိသလားနဲ့ လိုင်စင်သက်တမ်း ရှိသေးသလားဆိုတာ တစ်ခါတည်းစစ်မယ်
    $isValid = RegisteredDevice::where('fingerprint', $fingerprint)
        ->whereHas('license', function ($query) {
            $query->where(function ($q) {
                $q->whereNull('expires_at') // သက်တမ်းအကန့်အသတ်မရှိ သတ်မှတ်ထားလျှင် သို့မဟုတ်
                  ->orWhere('expires_at', '>', now()); // လက်ရှိအချိန်ထက် ကျော်သေးလျှင်
            });
        })
        ->exists();

    // ၄. မမှန်ကန်ဘူးဆိုရင် Error Page ပြမယ်
    if (!$isValid) {
        return response()->view('error.license_required', [], 403);
    }

    return $next($request);
    }
}
