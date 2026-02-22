<?php

namespace Database\Seeders;

use App\Models\License;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class LicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        // သင်နှစ်သက်ရာ Key ပုံစံကို ဤနေရာတွင် သတ်မှတ်နိုင်သည်
        $key = 'PRO-MONTHLY-' . strtoupper(Str::random(5));

        License::create([
            'license_key'  => $key,
            'device_limit' => 1,                 // စက် ၁ လုံးပဲ သုံးခွင့်ပေးမည်
            'expires_at'   => now()->addMonth(), // ယနေ့မှစ၍ ၁ လ သက်တမ်း
        ]);

        // Terminal မှာ Key ကို မြင်ရအောင် output ထုတ်ပြခြင်း
        $this->command->info("------------------------------------");
        $this->command->info("License Key: $key");
        $this->command->info("Expires at: " . now()->addMonth()->format('Y-m-d H:i:s'));
        $this->command->info("------------------------------------");
    }
}
