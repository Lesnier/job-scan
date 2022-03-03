<?php

namespace App\Helpers;

use App\Models\Skill;
use Illuminate\Database\Eloquent\Collection;

class SkillHelper
{
    /**
     * Given a string of descriptive text, find all skills that match.
     *
     * @param string $description string of descriptive text.
     * @return Collection $foundSkills all skills that are found in the descriptive text.
     */
    public static function extractFromDescription(string $description) : Collection
    {
        $foundSkills = new Collection();
        foreach (Skill::cursor() as $skill) {
            if (preg_match("@\b({$skill->regex})\b@msi", $description)) {
                $foundSkills->add($skill);
            }
        }

        return $foundSkills->keyBy('name');
    }
}
