<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Resource Controller for working with Skills
 *
 * @version 1.0.0
 * @since 1.0.0
 */
class SkillController extends Controller
{
    /**
     * Return a list of all skills currently in the database
     *
     * @return JsonResponse List of Skills ordered by slug
     */
    public function index() : JsonResponse
    {
        return new JsonResponse(Skill::orderBy('slug', 'asc')->get());
    }
}
