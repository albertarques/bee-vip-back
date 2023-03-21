<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Comment;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;


class CommentTest extends TestCase
{

    // public function setUp(): void
    // {
    //     parent::setUp();
    //     Artisan::call('migrate:fresh --seed --env=testing');
    // }
    /** @test */
    // comment/create/{entrepreneurship_id}
    // public function ok_is_returned_if_user_can_create_comment()
    // {
    //     // Crear un usuario utilizando el Factory
    //     $user = User::factory()->create();
    //     $user->assignRole('user');

    //     $this->actingAs($user);

    //     // Crear un comentario utilizando el Factory
    //     $comment = Comment::factory()->create([
    //         'user_id' => $user->id,
    //     ]);
    //     $response = $this->post('api/comment/create/' . $comment->id, [
    //         'score' => $comment->score,
    //         'comment' => $comment->comment
    //     ]);

    //     $response->assertStatus(200);
    // }

    /** @test */
    // public function ok_is_returned_if_user_can_view_comment()
    // {
    //     // Crear un usuario utilizando el Factory
    //       $user = User::factory()->create();
    //       $user->assignRole('user');
        
    //       // Loguearse con el usuario
    //       $this->actingAs($user);

    //       // Crear un comentario utilizando el Factory
    //        Comment::factory(3)->create([
    //         'user_id' => $user->id,
    //       ]);
    
    //       // Verificar que devuelve la lista de comentarios del usuario
    //       $response = $this->get('api/comments');
    //       $response->assertStatus(200);
    //       $response = $response->json();
    //       $this->assertIsArray($response);
    //       $commentsArray = $response['comments'];
    //       $this->assertCount(3, $commentsArray);
    // }
    /** @test */
     //comment/update_my/{id}
//     public function ok_is_returned_if_user_can_update_comment(){
//         $user = User::factory()->create();
//         $user->assignRole('user');

//         // Loguearse con el usuario
//         $this->actingAs($user);
      
//         // Crear un comentario utilizando el Factory
//         $comment = Comment::factory()->create([
//           'user_id' => $user->id,
//         ]);
    
//         $response = $this->patch('api/comment/update_my/' . $comment->id, [
//             'comment'=> 'nuevo comentario',
//             'score'=> 5
//         ]);
//         $response->assertStatus(200);
//   }
    /** @test */
    //comment/delete/index_my
    // public function ok_is_returned_if_user_can_delete_comment(){
    //       $user = User::factory()->create();
    //       $user->assignRole('user');

    //       // Loguearse con el usuario
    //       $this->actingAs($user);
        
    //       // Crear un comentario utilizando el Factory
    //       $comment = Comment::factory()->create([
    //         'user_id' => $user->id,
    //       ]);
      
    //       $this->assertDatabaseHas('comments', [
    //         'id' => $comment->id,
    //       ]);
      
    //       $deletedComment = $this->delete('api/comment/delete_my/' . $comment->id);
    //       $deletedComment->assertStatus(200);
      
    //       $this->assertDatabaseMissing('comments', [
    //           'id' => $comment->id,
    //       ]);
    // }
     /** @test */
    //comment/delete/{id}
//     public function ok_is_returned_if_superAdmin_can_delete_comment(){
//         $superAdmin = User::factory()->create();
//         $superAdmin->assignRole('superadmin');
    
//         $token = $superAdmin->createToken('Test Token')->accessToken;
//         $headers = ['Authorization' => "Bearer $token"];
    
//         // Loguearse con el usuario superadmin
//         $this->actingAs($superAdmin);
//         $this->assertAuthenticatedAs($superAdmin);
    
//         // Crear un comentario utilizando el Factory
//         $comment = Comment::factory()->create([
//           'user_id' => $superAdmin->id,
//         ]);
    
//         $this->assertDatabaseHas('comments', [
//           'id' => $comment->id,
//         ]);
    
//         $deletedComment = $this->delete('api/comment/delete/' . $comment->id, $headers);
//         $deletedComment->assertStatus(200);
    
//         $this->assertDatabaseMissing('comments', [
//             'id' => $comment->id,
//         ]);
//   }

}
