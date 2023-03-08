<?php

// namespace Tests\Feature;

// use App\Models\Entrepreneurship;
// use Illuminate\Foundation\Testing\RefreshDatabase;
// use Illuminate\Foundation\Testing\WithFaker;
// use Tests\TestCase;
// use App\Models\User;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;
// use App\Permissions\Permission as MyPermissions;

// class CommentsTest extends TestCase
// {
//     use RefreshDatabase;

//     private User $user;
//     private Role $role;
//     private Entrepreneurship $entrepreneurship;
    


//     public function setUp(): void
//     {
//         parent::setUp();
//         //    $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();
//         $this->user = User::factory()->create();
//         $testPermission2 = 'create-comment';
//         $this->entrepreneurship = Entrepreneurship::factory()->create();
//         dd($this->entrepreneurship);
//         Permission::create(['guard_name' => 'api', 'name' => $testPermission2]);
//         $this->role = Role::create(['name' => 'user']);
//         $this->user->assignRole($this->role);
//         $this->role->givePermissionTo('create-comment');
       
//     }
//     /** @test */
//     public function test_ok_is_returned_if_the_user_can_create_comment()
//     {
//         dd('test');
//         $token = $this->user->createToken('my-app-token')->plainTextToken;
//        dd($token);
//     $this->withHeaders([
//             'Authorization' => 'Bearer ' . $token,
//         ])
//         ->post("/api/entrepreneurship/{$this->entrepreneurship->id}/comment/create", [
//             'entrepreneurship_id' => $this->entrepreneurship->id,
//             'user_id' => $this->user->id,
//             'score' => 6,
//             'comment' => 'pesimo servicio, no lo contraten',
//         ])
//         ->assertStatus(200);
//     }
    /** @test */
    // public function dennied_when_user_can_not_create_commets()
    // {
    //     $this->role->revokePermissionTo('create-comment');

    //     $this->actingAs($this->user)
    //         ->post("/api/entrepreneurship/{id}/comment/create")
    //         ->assertStatus(403);
    // }
// }