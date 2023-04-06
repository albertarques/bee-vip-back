<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Entrepreneurship;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;

class CommentsTest extends TestCase
{
  public function setUp(): void {
    parent::setUp();
    Artisan::call('migrate:fresh --seed --env=testing');
  }

  /** @test */
  // comment/create/{entrepreneurship_id}
  public function ok_is_returned_if_user_can_create_coment_on_entrepreneurship() {
    // Crear un usuario user utilizando el Factory
    $user = User::factory()->create();
    $user->assignRole('user');

    // Crear un entrepreneurship utilizando el Factory
    $entrepreneurship = Entrepreneurship::factory()->create();
    $entrepreneurship_id = $entrepreneurship->id;

    // Loguearse con el usuario user
    $this->actingAs($user);

    // Crear un comentario con comentario y puntuación utilizando el Factory
    $response = $this->post('api/comment/create/' . $entrepreneurship_id, [
      "score" => 5,
      "comment" => "Me parece un gran servicio y producto."
    ]);

    $response->assertStatus(200);
  }

  /** @test */
  // comment/update_my/{id}

  /** @test */
  // comment/delete_my/{id}


  /** @test */
  // comment/index_my

}
