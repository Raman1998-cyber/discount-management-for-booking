<?php
namespace Tests\Feature;

use App\Models\Discount;
use App\Models\User;
use App\Models\Booking;
use App\Models\UserFamily;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DiscountTest extends TestCase
{
    use RefreshDatabase;

    public function test_family_member_discount_applied()
    {
        $user = User::factory()->create();
        $familyMember = User::factory()->create();

        UserFamily::create(['user_id' => $user->id, 'family_member_id' => $familyMember->id, 'relationship' => 'sibling']);

        Booking::create(['user_id' => $familyMember->id, 'schedule_id' => 1, 'total_cost' => 100]);

        $discount = Discount::create(['name' => 'Family Discount', 'type' => 'fixed', 'value' => 10, 'family_member' => true]);

        $response = $this->postJson('/api/discount/apply', ['discount_id' => $discount->id, 'schedule_id' => 1, 'total_cost' => 100]);

        $response->assertJson(['discounted_total' => 90]);
    }

    public function test_recurring_discount_applied()
    {
        $user = User::factory()->create();

        Booking::create(['user_id' => $user->id, 'schedule_id' => 1, 'total_cost' => 100]);

        $discount = Discount::create(['name' => 'Recurring Discount', 'type' => 'percentage', 'value' => 10, 'recurring' => true]);

        $response = $this->postJson('/api/discount/apply', ['discount_id' => $discount->id, 'schedule_id' => 1, 'total_cost' => 100]);

        $response->assertJson(['discounted_total' => 90]);
    }
}
?>