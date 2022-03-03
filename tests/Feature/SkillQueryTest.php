<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SkillQueryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testSkillList()
    {
        $response = $this->getJson('/api/skills');

        $response->assertStatus(200);
        $response->assertJson([['name' => 'Angular', 'slug' => 'angular']]);
    }
}
