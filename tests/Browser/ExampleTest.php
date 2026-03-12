<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     */
    public function test_user_can_register_via_ui()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/registerPage')
                ->waitFor('form', 5) // form က load ဖြစ်ဖို့ ခေတ္တစောင့်ပါ
                ->type('input[name="name"]', 'Pyae')
                ->type('input[name="email"]', 'pyaephyokhant2020dc@gmail.com')
                ->type('input[name="phone"]', '0912345678')
                ->select('gender', 'male')
                ->type('input[name="address"]', '123 Main St')
                ->type('input[name="password"]', 'password')
                ->type('input[name="password_confirmation"]', 'password')
                ->check('aggree')
                ->press('button[type="submit"]') // register text အစား selector အသုံးပြုပါ
                ->pause(2000)
                ->assertPathIs('/user/home')
                ->assertAuthenticated();

            
        });
    }
}
