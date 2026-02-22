<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Models\RegisteredDevice;
use App\Helpers\HardwareHelper;
use Illuminate\Support\Facades\Log;

class LicenseController extends Controller
{
    public function showActivatePage() {
        return view('active');
    }
    public function activate(Request $request)
    {
        $allLicenses = License::all();
    $foundLicense = null;

    // ၂။ တစ်ခုချင်းစီကို လိုက်စစ်တယ် (Laravel က အလိုအလျောက် Decrypt လုပ်ပေးပါလိမ့်မယ်)
    foreach ($allLicenses as $license) {
        if ($license->license_key === $request->license_key) {
            $foundLicense = $license;
            break;
        }
    }

    if (!$foundLicense) {
        return back()->withErrors('License Key မှားယွင်းနေပါသည်။');
    }

    $fingerprint = HardwareHelper::getFingerprint();

    // ၃။ သက်တမ်းကုန်/မကုန် စစ်ခြင်း
    if ($foundLicense->expires_at && $foundLicense->expires_at->isPast()) {
        return back()->withErrors('ဒီလိုင်စင်က သက်တမ်းကုန်ဆုံးသွားပါပြီ။');
    }

    // ၄။ RegisteredDevice ထဲမှာ သိမ်းဆည်းခြင်း
    RegisteredDevice::firstOrCreate([
        'license_id' => $foundLicense->id,
        'fingerprint' => $fingerprint
    ]);

    return redirect('/dashboard')->with('success', 'Activated!');
    }
}
