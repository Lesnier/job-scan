<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Job Skill
 *
 * @version 1.0.0
 * @since 1.0.0
 * @property integer $id Skill ID
 * @property \Carbon\Carbon $created_at Timestamp Posting Inserted into DB
 * @property \Carbon\Carbon $updated_at Timestamp Posting last updated in DB
 * @property \Carbon\Carbon $deleted_at Timestamp Posting Soft Deleted
 * @property string $name Name of Skill
 * @property string $slug Unique Slug for Skill
 * @property string $regex Regular Expression to search for Skill
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Posting[] $postings

 */
class Skill extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    /**
     * Many-To-Many Relationship to Posting'
     * @return BelongsToMany
     */
    public function postings() : BelongsToMany
    {
        return $this->belongsToMany('App\Models\Posting')->withTimestamps();
    }

    /**
     * Mutator to set slug when setting name
     *
     * @param string $value - value for the name property
     */
    public function setNameAttribute(string $value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }


    /**
     * Accessor to get regular expression string.
     *
     * Modifies the regex attribute to always include the slug and name. This
     * way a newly created skill with no regex has at least a cleaned version
     * of the name.
     *
     * @param string $value Value of the regex field in the DB
     * @return string Modified regex string to automatically add the slug as a field
     */
    public function getRegexAttribute(string $value = null) : string
    {
        $strings = explode("|", $value);
        $strings[] = $this->attributes['slug'];
        $strings[] = Str::lower($this->attributes['name']);
        $strings = array_filter(array_unique($strings));
        return implode("|",$strings);
    }
}
