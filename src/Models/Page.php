<?php

namespace ModernMcGuire\Headstart\Models;

use App\Enums\PageStatus;
use App\Traits\HasBlocks;
use App\Traits\HasSlug;
use App\Traits\HasUuid;
use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\SlugOptions;

class Page extends Model
{
    use HasUuid;
    use HasSlug;
    use SoftDeletes;
    use HasBlocks;
    use Publishable;

    public $dates = [
    	'published_at',
    ];

    public $fillable = [
        'title',
        'status',
        'meta_description',
        'author_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'status' => PageStatus::class,
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
