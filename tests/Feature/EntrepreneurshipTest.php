<?php

namespace Tests\Feature;

use App\Models\AvailabilityState;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\InspectionState;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;


class EntrepreneurshipTest extends TestCase{

    use DatabaseTransactions;

    private User $user;
    private Role $role;
    private Role $roleAdmin;
    private  $token;
    private $category;
    private $availability;
    private $inspection;

    public function setUp(): void
    {
        parent::setUp();
        Permission::create(['guard_name' => 'api', 'name' => 'create-entrepreneurship']);
        $this->roleAdmin = Role::create(['name' => 'admin']);
        $this->user=User::factory()->create();
        $this->user->assignRole($this->roleAdmin);
        $this->token = Auth::login($this->user);
        $this->category = Category::factory()->create();
        $this->availability = AvailabilityState::factory()->create();
        $this->inspection = InspectionState::factory()->create();
        
    }
    /** @test*/
    public function test_user_can_not_create_entrepreneirship(){

       
        $this->roleAdmin->revokePermissionTo('create-entrepreneurship');
        $this->user->assignRole($this->roleAdmin);
        $this->actingAs($this->user);
        $this->withHeaders([
           'Authorization' => 'Bearer ' . $this->token,
           'Accept' => 'application/json'
       ]);
       $response =  $this->post('/api/entrepreneurship/create', [
               'user_id' => $this->user->id,
               'title' => 'Juan Valdez cafe',
               'logo' => 'cafe',
               'product_img' => 'file.jpg',
               'description' => 'El mejor cafe del mundo',
               'price' => 10,
               'category_id' => $this->category->id,
               'avg_score' => 5,
               'cash_payment' => 0,
               'card_payment' => 0,
               'bizum_payment' =>1,
               'stock' => 100,
               'availability' => $this->availability->id,
               'phone' => '123457891',
               'email' => 'buri123456@bestcolombian.com',
               'location' => 'Antioquia',
               'inspection_state' => $this->inspection->id,
        ]);

        $response->assertStatus(403);

    }
     /** @test */
     public function test_admin_can_create_entrepreneurship()
     {
        $this->roleAdmin->givePermissionTo('create-entrepreneurship');
         $this->actingAs($this->user);
         $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json'
        ]);
        $response =  $this->post('/api/entrepreneurship/create', [
                'user_id' => $this->user->id,
                'title' => 'Juan Valdez cafe',
                'logo' => 'cafe',
                'product_img' => 'file.jpg',
                'description' => 'El mejor cafe del mundo',
                'price' => 10,
                'category_id' => $this->category->id,
                'avg_score' => 5,
                'cash_payment' => 0,
                'card_payment' => 0,
                'bizum_payment' =>1,
                'stock' => 100,
                'availability' => $this->availability->id,
                'phone' => '123457891',
                'email' => 'buri123456@bestcolombian.com',
                'location' => 'Antioquia',
                'inspection_state' => $this->inspection->id,
         ]);
        
         $response->assertStatus(200);

     }
}