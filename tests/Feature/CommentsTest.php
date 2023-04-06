<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Entrepreneurship;
use App\Models\Comment;

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
  public function ok_is_returned_if_user_update_his_comment(){
    // Crear un usuario superadmin utilizando el Factory
      $user = User::factory()->create();
      $user->assignRole('superadmin');

    // Loguearse con el usuario user
      $this->actingAs($user);

    // Crear un entrepreneurship utilizando el Factory
      $entrepreneurship = Entrepreneurship::factory()->create();

    // Crear un comentario utilizando el Factory
      $comment = Comment::factory()->create([
        'entrepreneurship_id' => $entrepreneurship->id,
        'user_id' => $user->id,
        "score" => 1,
        "comment" => "Initial comment"
      ]);

    // Actualizar el comentario
      $response = $this->patch('api/comment/update_my/' . $comment->id, [
        "score" => 5,
        "comment" => "Updated Comment"
      ]);

      $response->assertStatus(200);
  }

  /** @test */
  // comment/delete_my/{id}
  public function ok_is_returned_if_superadmin_delete_his_comment(){
    // Crear un usuario user utilizando el Factory
      $superadmin = User::factory()->create();
      $superadmin->assignRole('superadmin');

    // Loguearse con el usuario user
      $this->actingAs($superadmin);

    // Crear un entrepreneurship utilizando el Factory
      $entrepreneurship = Entrepreneurship::factory()->create();

    // Crear un comentario utilizando el Factory
      $comment = Comment::factory()->create([
        'entrepreneurship_id' => $entrepreneurship->id,
        'user_id' => $superadmin->id,
        "score" => 1,
        "comment" => "Initial comment"
      ]);

    // Eliminar el comentario
      $response = $this->delete('api/comment/delete_my/' . $comment->id);

      $response->assertStatus(200);
  }


  /** @test */
  // comment/index_my
  public function ok_is_returned_if_user_view_a_list_of_his_comments() {
    // Crear un usuario user utilizando el Factory
      $user = User::factory()->create();
      $user->assignRole('user');

    // Crear un entrepreneurship utilizando el Factory
      $entrepreneurship = Entrepreneurship::factory()->create();

    // Loguearse con el usuario user
      $this->actingAs($user);

    // Crear un comentario utilizando el Factory
    $comment = Comment::factory()->create([
      'entrepreneurship_id' => $entrepreneurship->id,
      'user_id' => $user->id,
      "score" => 1,
      "comment" => "Initial comment"
    ]);

    // Verificar que el comentario fue creado exitosamente
      $this->assertDatabaseHas('comments', [
        'id' => $comment->id,
        'entrepreneurship_id' => $entrepreneurship->id,
        'user_id' => $user->id,
        "score" => $comment->score,
        "comment" => "Initial comment"
      ]);

    // Verificar que el comentario fue creado exitosamente
      $response = $this->get('api/comment/index_my');

      $response->assertStatus(200);
  }

}
