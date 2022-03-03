<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * Company Model
 *
 * @version 1.0.0
 * @since 1.0.0
 * @property integer $id Company ID
 * @property \Carbon\Carbon $created_at Timestamp Posting Inserted into DB
 * @property \Carbon\Carbon $updated_at Timestamp Posting last updated in DB
 * @property \Carbon\Carbon $deleted_at Timestamp Posting Soft Deleted
 * @property string $name Name of Company
 * @property string $slug Unique Slug for Company
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Posting[] $postings
 */
class Company extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'slug'];

    /**
     * One-to-Many relationship with App\Models\Posting
     * @return HasMany One to Many Relationship
     */
    public function postings() : HasMany
    {
        return $this->hasMany('App\Models\Posting');
    }

    /**
     * Mutator to set slug when setting name
     *
     * @param string $value - value for the name property
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
