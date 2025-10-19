<?php

namespace App\Models;

use App\Traits\HasUserStamp;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use HasFactory, HasUlids, SoftDeletes;
    use HasUserStamp;
    use InteractsWithMedia;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'sort',
        'title',
        'slug',
        'short_description',
        'description',
        'client',
        'terms',
        'project_type',
        'production_year',
        'length',
        'width',
        'height',
        'area',
        'click_url',
        'click_url_target',
        'is_active',
        'options',
        'locale',
        'created_by',
        'updated_by',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'options' => 'json',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'created_by',
        'updated_by',
        'deleted_at',
    ];

    /**
     * Boot function from Laravel.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-generate slug from title
        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });

        static::updating(function ($project) {
            if ($project->isDirty('title') && ! $project->isDirty('slug')) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    /**
     * Register media conversions.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->format('webp')
            ->quality(100)
            ->fit(Fit::Contain, 960, 760)
            ->nonQueued();

        // Add responsive image sizes - always convert to WebP
        $this->addMediaConversion('thumbnail')
            ->format('webp')
            ->quality(100)
            ->fit(Fit::Contain, 150, 150)
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->format('webp')
            ->quality(100)
            ->fit(Fit::Contain, 890, 990)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->format('webp')
            ->quality(100)
            ->fit(Fit::Contain, 1200, 650)
            ->nonQueued();
    }

    /**
     * Get the URL of the first media item in the specified collection.
     */
    public function getImageUrl(string $conversion = ''): ?string
    {
        $media = $this->getFirstMedia('projects');

        if (! $media) {
            return null;
        }

        return $conversion ? $media->getUrl($conversion) : $media->getUrl();
    }

    /**
     * Check if the model has media in the specified collection.
     */
    public function hasImage(): bool
    {
        return $this->hasMedia('projects');
    }

    /**
     * Get a collection of all project images except the first one.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getRemainingImages(): Collection
    {
        // NEW: Added this helper method for the gallery.
        return $this->getMedia('projects')->slice(1);
    }

    /**
     * Get post URL using slug
     *
     * @return string
     */
    public function getUrl()
    {
        return route('portfolio.show', ['slug' => $this->slug]);
    }

    /**
     * Get previous project
     */
    public function getPreviousProject()
    {
        return self::published()
            ->where('created_at', '<', $this->created_at)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    /**
     * Get next project
     */
    public function getNextProject()
    {
        return self::published()
            ->where('created_at', '>', $this->created_at)
            ->orderBy('created_at', 'asc')
            ->first();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
