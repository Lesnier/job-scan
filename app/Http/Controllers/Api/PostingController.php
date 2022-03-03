<?php

namespace App\Http\Controllers\Api;

use App\Models\Posting;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * API Controller for dealing with Job Postings
 *
 * @version 1.0.0
 * @since 1.0.0
 */
class PostingController extends Controller
{
    /**
     * API Request to get job postings that match one or more requested skills, ordered by a ranking score
     * based on how many skills matched and how proficient the user is in those skills
     *
     * @param Request $request
     * @return JsonResponse List of jobs that match those skills with metadata
     */
    public function searchSkills(Request $request) : JsonResponse
    {
        $skills = $request->input('skill');
        if (!is_array($skills)) {
            $skills = [$skills => 1];
        }
        $postings = Posting::containsOneSkillBySlug(array_keys($skills))->with('company')->get();

        $results = [];
        foreach ($postings as $posting) {
            $posting->score = 0;
            $posting->skills->keyBy('slug');
            $skillNames = [];
            foreach ($posting->skills as $skill) {
                $posting->score += $skills[$skill->slug];
                $skillNames[] = $skill->name;
            }
            $posting->skill_list = $skillNames;
            $results[] = $posting;
        }

        if ($results) {
            usort($results, function ($a, $b) {
                if ($a->score ==  $b->score) {
                    return 0;
                }
                return ($a->score > $b->score)?-1:1;
            });
        }

        return new JsonResponse([
            'skills' => $skills,
            'count' => count($results),
            'results' => $results
        ]);
    }
}
