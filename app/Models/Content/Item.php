<?php

namespace App\Models\Content;

use App\Models\User;
use App\Traits\HasUserStamp;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Item extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory, HasUlids, SoftDeletes;
    use HasUserStamp;

    protected $table = 'content_items';

    protected $fillable = [
        'content_category_id', 'sort', 'title', 'description', 'click_url',
        'click_url_target', 'is_active', 'start_date', 'end_date', 'published_at',
        'locale', 'options', 'created_by', 'updated_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'published_at' => 'datetime',
        'options' => 'json',
    ];

    protected $hidden = ['created_by', 'updated_by', 'deleted_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'content_category_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')->format('webp')->quality(85)->fit(Fit::Contain, 150, 150)->nonQueued();
        $this->addMediaConversion('medium')->format('webp')->quality(85)->fit(Fit::Contain, 600, 600)->nonQueued();
        $this->addMediaConversion('large')->format('webp')->quality(90)->fit(Fit::Contain, 1200, 800)->nonQueued();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->singleFile();
        $this->addMediaCollection('images_secondary')->singleFile();
    }

    public function getImageUrl(string $conversion = '', string $collection = 'images'): ?string
    {
        $media = $this->getFirstMedia($collection);

        if (! $media) {
            return null;
        }

        return $conversion ? $media->getUrl($conversion) : $media->getUrl();
    }

    public function hasImage(string $collection = 'images'): bool
    {
        return $this->hasMedia($collection);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(fn ($q) => $q->whereNull('start_date')->orWhere('start_date', '<=', now()))
            ->where(fn ($q) => $q->whereNull('end_date')->orWhere('end_date', '>=', now()));
    }

    public function scopeCategorySlug($query, string $slug)
    {
        return $query->whereHas('category', fn ($q) => $q->where('slug', $slug));
    }

    public function option(string $key, $default = null)
    {
        return data_get($this->options, $key, $default);
    }
}
