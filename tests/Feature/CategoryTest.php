<?php

namespace Tests\Feature;

use App\Models\User;
use App\Http\Middleware\LicenseGuard;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    /** @test */
    public function create_test(): void
    {
        $this->withoutMiddleware(LicenseGuard::class);
        $user = User::factory()->create(['role' => 'admin']);

        // ၁။ Data ပို့တဲ့အခါ Controller က မျှော်လင့်ထားတဲ့ 'categoryName' ကို သုံးပါ
        $response = $this->actingAs($user)->post(route('re#create'), [
            'categoryName' => 'New Category Name', // အနည်းဆုံး ၅ လုံး ရှိရမယ် (min:5)

        ]);

        // ၂။ Controller က redirect ပြန်တာဖြစ်လို့ 302 ကို စစ်ပါ
        $response->assertStatus(302);

        // ၃။ သတ်မှတ်ထားတဲ့ route ဆီ တကယ် redirect ဖြစ်မဖြစ် စစ်ပါ
        $response->assertRedirect(route('category#list'));


        // ၄။ Database ထဲမှာ data တကယ် ရောက်မရောက် စစ်ပါ
        $this->assertDatabaseHas('categories', [
            'name' => 'New Category Name'
        ]);
    }
}
