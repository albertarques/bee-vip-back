<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Comment;
use App\Models\Entrepreneurship;
use Illuminate\Support\Facades\Artisan;


class CommentTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed --env=testing');

        $this->post('api/register', [
            'username' => 'test user',
            'email' => 'testuser@example.com',
            'password' => '12345678',
            'phone' => '000111222'
        ]);
    }
    /** @test */
    // comment/create/{entrepreneurship_id}
    // public function ok_is_returned_if_user_can_create_comment()
    // {
    //     $response = $this->post('api/login', [
    //         'email' => 'testuser@example.com',
    //         'password' => '12345678'
    //     ]);
    //     $response->assertStatus(200);

    //     $comment = Comment::factory()->create();
    //     // dd($comment->entrepreneurship_id);
    //     // $token = $response->original['authorisation']['token'];

    //     $response = $this->post('api/comment/create/63', [
    //         // 'token' => $token,
    //         'user_id' => $comment->user_id,
    //         'score' => $comment->score,
    //         'comment' => $comment->comment
    //     ]);

    //     $response->assertStatus(200);
    // }
    /** @test */
    // comment/create/{entrepreneurship_id}
    public function ok_is_returned_if_user_can_view_comment()
    {
        $response = $this->post('api/login', [
            'email' => 'testuser@example.com',
            'password' => '12345678'
        ]);
        $response->assertStatus(200);

        $token = $response->original['authorisation']['token'];

        $response = $this->post('api/comments', [
            'token' => $token
        ]);

        $response->assertStatus(200);
    }
}
