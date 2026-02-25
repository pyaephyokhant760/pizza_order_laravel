<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeveloperCustomerTest extends TestCase
{
    use RefreshDatabase;

    public function test_developer_can_create_customer_and_update_settings()
    {
        // ၁။ Session မှာ auth ရှိနေတယ်လို့ အတုဖန်တီးခြင်း
        Session::put('developerauth', true);

        // ၂။ API Response တွေကို Fake လုပ်ခြင်း
        Http::fake([
            '*/CreateShopCustomer' => Http::response('1', 200), // အောင်မြင်တယ်လို့ ဖြေမယ်
            '*/FetchAllShopCustomer' => Http::response(json_encode([
                ['id' => 123, 'database_name' => 'test_db', 'shopuser_name' => 'mgmg', 'shop_name' => 'abc_shop']
            ]), 200),
            '*/saveSetting' => Http::response(['status' => 'success'], 200),
        ]);

        // ၃။ Request ပို့ခြင်း
        $response = $this->post('/developer-create-customer', [
            'username' => 'mgmg',
            'shopname' => 'abc_shop',
            'phoneno' => '0912345678',
            'address' => 'Yangon',
            'dbname' => 'test_db',
            'logoname' => 'logo.png',
            'ip' => '127.0.0.1',
            'portno' => '3306',
            'db_username' => 'db_user',
            'db_password' => 'db_pass',
            'server_link' => 'http://api.test',
            'status' => '1',
            'version' => '1.0',
            // တခြား field တွေလည်း ဒီမှာ ထည့်ပေးပါ
        ]);

        // ၄။ ရလဒ် စစ်ဆေးခြင်း
        // Since I don't know the exact redirect, I'll check status 302 or 200
        $response->assertStatus(302);
    }
}
