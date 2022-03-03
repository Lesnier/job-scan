<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class JobPostingSearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->postJson('/api/postings/search/skills', [
            'skill' => [
                'php' => 5,
                'linux' => 5,
                'jquery' => 3
            ]
        ]);

        $response->assertStatus(200);
        $response->assertJson(['skills' => ['php' => 5]]);
        $response->assertJson(['results' => []]);
        $response->assertJson(['results' => [['id' => 1036, 'score' => 8, 'skills_count' => 2, 'skill_list' => ['jQuery']]]]);
    }
}
