<?php

namespace App\Models;

use App\Traits\HasUserStamp;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        'locale',
        'created_by',
        'updated_by',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
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
     * Register media conversions.
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->format('webp')
            ->quality(90)
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();

        // Add responsive image sizes - always convert to WebP
        $this->addMediaConversion('thumbnail')
            ->format('webp')
            ->quality(85)
            ->fit(Fit::Contain, 150, 150)
            ->nonQueued();

        $this->addMediaConversion('medium')
            ->format('webp')
            ->quality(85)
            ->fit(Fit::Contain, 800, 492)
            ->nonQueued();

        $this->addMediaConversion('large')
            ->format('webp')
            ->quality(85)
            ->fit(Fit::Contain, 1000, 615)
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
     * Register the media collections for the model.
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('projects')
            ->singleFile();
    }

    /**
     * Get post URL using slug
     *
     * @return string
     */
    public function getUrl()
    {
        return route('portfolio.show', ['title' => $this->title]);
    }
}
