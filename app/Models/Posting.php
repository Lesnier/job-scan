<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Job Posting
 *
 * @version 1.0.0
 * @since 1.0.0
 * @property integer $id Job Posting ID
 * @property \Carbon\Carbon $created_at Timestamp Posting Inserted into DB
 * @property \Carbon\Carbon $updated_at Timestamp Posting last updated in DB
 * @property \Carbon\Carbon $deleted_at Timestamp Posting Soft Deleted
 * @property string $title Name of the Posting
 * @property integer $company_id Company ID
 * @property string $description Job Description
 * @property-read \App\Models\Company $company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Skill[] $skills
 */
class Posting extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'title', 'company_id'];

    /**
     * One-to-Many relationship to App\Models\Company
     *
     * @return BelongsTo
     */
    public function company() : BelongsTo
    {
        return $this->belongsTo('App\Models\Company');
    }

    /**
     * Many-to-Many relationship to App\Models\Skill
     *
     * @return BelongsToMany
     */
    public function skills() : BelongsToMany
    {
        return $this->belongsToMany('App\Models\Skill')->withTimestamps();
    }

    /**
     * Scope to limit Posting query to posts that contain at least one skill matching the array of skill ids
     *
     * @param Builder $query
     * @param array $ids
     * @return Builder $query modified query builder
     */
    public function scopeContainsOneSkillById(Builder $query, array $ids = []) : Builder
    {
        return $query->whereHas('skills', function (Builder $q) use ($ids) {
            return $q->whereIn('id', $ids);
        })->withCount(['skills' => function (Builder $q) use ($ids) {
            return $q->whereIn('id', $ids);
        }])->with(['skills' => function ($q) use ($ids) {
            return $q->whereIn('id', $ids);
        }]);
    }

    /**
     * Scope to limit Posting query to posts that contain at least one skill matching the array of skill slugs
     *
     * @param Builder $query
     * @param array $slugs
     * @return Builder $query modified query builder
     */
    public function scopeContainsOneSkillBySlug(Builder $query, array $slugs = []) : Builder
    {
        return $query->whereHas('skills', function (Builder $q) use ($slugs) {
            return $q->whereIn('slug', $slugs);
        })->withCount(['skills' => function (Builder $q) use ($slugs) {
            return $q->whereIn('slug', $slugs);
        }])->with(['skills' => function ($q) use ($slugs) {
            return $q->whereIn('slug', $slugs);
        }]);
    }
}
