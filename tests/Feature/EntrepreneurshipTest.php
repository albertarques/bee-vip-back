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

    public function setUp(): void
    {
        parent::setUp();
        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
        $this->user = User::factory()->create();
        $this->admin = User::factory()->create();
        // $testPermission = 'create-entrepreneurship';
        // Permission::create(['guard_name' => 'api', 'name' => $testPermission]);
        $this->role = Role::create(['name' => 'user']);
        $this->roleAdmin = Role::create(['name' => 'admin']);
        $this->user->assignRole($this->role);
        $this->admin->assignRole($this->roleAdmin);
        // $this->role->givePermissionTo($testPermission);
    }

    /** @test*/
    public function test_user_can_not_create_entrepreneirship(){
        $this->actingAs($this->user)
            ->post('/api/entrepreneurship/create')
            ->assertStatus(403);
    }

     /** @test */
     public function test_admin_can_create_entrepreneurship()
     {
         // dd($this->user);
         $this->actingAs($this->admin)
             ->post('/api/entrepreneurship/create', [
                'user_id' => $this->admin->id,
                'title' => 'Juan Valdez',
                'logo' => 'cafe',
                'product_img' => 'file.jpg',
                'description' => 'El mejor cafe del mundo',
                'price' => 100,
                'category_id' => 1,
                'cash_payment' => '0',
                'card_payment' => '0',
                'bizum_payment' =>'1',
                'stock' => 100,
                'availability_state' => 1,
                'phone' => '12345789',
                'email' => 'holacafe@gamil.com',
                'location' => 'Antioquia',
             ])
             ->assertStatus(200);
     }
}
