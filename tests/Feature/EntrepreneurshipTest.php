<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Permissions\Permission as MyPermissions;

class EntrepreneurshipTest extends TestCase{

    use RefreshDatabase;

    private User $user;
    private Role $role;
    private User $admin;
    private Role $roleAdmin;
    private $registeredUser;
    private  $token;

    public function setUp(): void
    {
        parent::setUp();
        // $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
        $this->user = User::factory()->create();
        $testPermission = 'create-entrepreneurship';
        Permission::create(['guard_name' => 'api', 'name' => $testPermission]);
        $this->admin = User::factory()->create();
        $this->role = Role::create(['name' => 'user']);
        $this->roleAdmin = Role::create(['name' => 'admin']);
        $this->user->assignRole($this->role);
        $this->admin->assignRole($this->roleAdmin);
        $this->registeredUser = $this->registerUser();
        $this->token = $this->loginUser();

    }

    private function registerUser(){
        return $this->post('/api/register', [
            'username' => 'Test User',
            'email' => 'buri@bestcolombian.com',
            'password' => '12345678',
            'phone' => '123456789'
        ])->decodeResponseJson();
    }

    private function loginUser(){
        return $this->post('/api/login', [
            'email' => $this->registeredUser['user']['email'],
            'password' => '12345678'
        ]);
    }
    /** @test*/
    public function test_user_can_not_create_entrepreneirship(){
        $this->role->revokePermissionTo('create-entrepreneurship');
        $this->actingAs($this->user)
            ->post('/api/entrepreneurship/create')
            ->assertStatus(403);
    }

     /** @test */
     public function test_admin_can_create_entrepreneurship()
     {
         $this->actingAs($this->user);
        //  dd($this->user);
        $response =  $this->post('/api/entrepreneurship/create', [
                'user_id' => $this->user->token,
                'title' => 'Juan Valdez cafe',
                'name' => 'Juan Valdez',
                'logo' => 'cafe',
                'product_img' => 'file.jpg',
                'description' => 'El mejor cafe del mundo',
                'price' => 'lo que diga jacobo',
                'category_id' => 'polvo marron',
                'avg_score' => 5,
                'cash_payment' => 0,
                'card_payment' => 0,
                'bizum_payment' =>1,
                'stock' => 100,
                'availability_state' => 2,
                'phone_number' => '12345789',
                'email' => $this->registeredUser['user']['email'],
                'location' => 'Antioquia',
                'inspection_state' => 1,
         ]);
        
         $response->assertStatus(200);

     }
}