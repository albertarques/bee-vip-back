<?php

namespace Tests\Feature;

use App\Models\Entrepreneurship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;



class CommentsTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Role $role;
    private $token;
    private $entrepreneurship;

    public function setUp(): void
    {
        parent::setUp();
        Permission::create(['guard_name' => 'api', 'name' => 'create-comment']);
        $this->role = Role::create(['name' => 'user']);
        $this->user = User::factory()->create();
        $this->user->assignRole($this->role);
        $this->token = Auth::login($this->user);
        $this->entrepreneurship = Entrepreneurship::factory()->create();
        
    }
    /**@test */
    public function test_user_can_create_comment()
    {
        $this->role->givePermissionTo('create-comment');
        
        $this->actingAs($this->user);
        $this->withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
            'Accept' => 'application/json'
        ]);
        $response =  $this->post("/api/entrepreneurship/{$this->entrepreneurship->id}/comment/create", [
            'entrepreneurship_id' => $this->entrepreneurship->id,
            'user_id' => $this->user->id,
            'score' => 1,
            'comment' => 'me gusta mucho',
        ]);
        $response->assertStatus(200);
    }

     /** @test*/
    public function test_user_can_not_create_comment(){
        $this->role->revokePermissionTo('create-comment');
        $this->user->assignRole($this->role);
        $this->actingAs($this->user);
        $this->withHeaders([
           'Authorization' => 'Bearer ' . $this->token,
           'Accept' => 'application/json'
       ]);
       $response =  $this->post("/api/entrepreneurship/{$this->entrepreneurship->id}/comment/create", [
        'entrepreneurship_id' => $this->entrepreneurship->id,
        'user_id' => $this->user->id,
        'score' => 1,
        'comment' => 'me gusta mucho',
       ]);

        $response->assertStatus(403);

    }
}
