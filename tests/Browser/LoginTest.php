<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test example.
     * @group LoginTest
     */
    public function test_login(): void
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'pyaephyokhant2020dc@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $this->browse(function (Browser $browser1) use ($user) {
            $browser1->visit('/loginPage')
                ->waitFor('form', 5)
                ->type('input[name="email"]', $user->email)
                ->type('input[name="password"]', 'password')
                ->press('button[type="submit"]')
                ->waitForLocation('/category/list')
                ->assertPathIs('/category/list')
                ->assertAuthenticated();

            $category = \App\Models\Category::create(['name' => 'Pizza']);

            $browser1->click('a[href="' . route('admin#page') . '"]')
                ->waitFor('form', 5)
                ->type('input[name="categoryName"]', 'New Category')
                ->press('#payment-button')
                ->waitForLocation('/category/list')
                ->assertPathIs('/category/list');
        });
    }


    /**
     * @group ui-test
     * @group product
     */
    public function test_add_product_data(): void
    {
        $user = \App\Models\User::factory()->create([
            'email' => 'pyaephyokhant2020dc@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $category = \App\Models\Category::create(['name' => 'Pizza']);

        $this->browse(function (Browser $browser1) use ($user, $category) {
            $browser1->visit('/loginPage')
                ->waitFor('form', 5)
                ->type('input[name="email"]', $user->email)
                ->type('input[name="password"]', 'password')
                ->press('button[type="submit"]')
                ->waitForLocation('/category/list')
                ->visit(route('list#page'))
                ->waitFor('a[href="' . route('create#page') . '"]', 5)
                ->click('a[href="' . route('create#page') . '"]')
                ->waitFor('form', 5)
                ->type('input[name="productName"]', 'Myanmar_Pizza ' . uniqid())
                ->select('select[name="productCategory"]', $category->id)
                ->type('textarea[name="productDescription"]', 'This is a test description for the pizza product.')
                ->attach('productImage', base_path('tests/Browser/screenshots/test_pizza.jpg'))
                ->type('input[name="productPrice"]', '10000')
                ->type('input[name="productWatingTime"]', '15')
                ->press('#payment-button')
                ->waitForLocation('/product/list')
                ->assertPathIs('/product/list');
        });
    }
}
