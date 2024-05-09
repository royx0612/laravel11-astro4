<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\MediaLibrary\ConversionsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    use HasFactory, Notifiable, LogsActivity, InteractsWithMedia, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('帳號')
            ->logAll()
            ->logOnlyDirty()
            ->dontLogIfAttributesChangedOnly(['updated_at'])
            ->dontSubmitEmptyLogs();
    }

    /**
     * Media Library Collections
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            ->registerMediaConversions(function (Media $media): void {
                $this->addMediaConversion(ConversionsEnum::THUMB->value)
                    ->fit(
                        Fit::Contain,
                        ConversionsEnum::THUMB->getResolution(),
                        ConversionsEnum::THUMB->getResolution(),
                    )
                    ->fit(
                        Fit::Contain,
                        ConversionsEnum::SMALL->getResolution(),
                        ConversionsEnum::SMALL->getResolution(),
                    );

                $this->addMediaConversion(ConversionsEnum::SMALL->value)
                    ->nonQueued()
                    ->fit(
                        Fit::Contain,
                        ConversionsEnum::SMALL->getResolution(),
                        ConversionsEnum::SMALL->getResolution(),
                    );

                $this->addMediaConversion(ConversionsEnum::MEDIUM->value)
                    ->fit(
                        Fit::Contain,
                        ConversionsEnum::MEDIUM->getResolution(),
                        ConversionsEnum::MEDIUM->getResolution(),
                    );

                $this->addMediaConversion(ConversionsEnum::LARGE->value)
                    ->fit(
                        Fit::Contain,
                        ConversionsEnum::LARGE->getResolution(),
                        ConversionsEnum::LARGE->getResolution(),
                    );
            });
    }

    /**
     * Media Library Conversions
     * @param Media|null $media
     * @return void
     */
    public function registerMediaConversions(Media $media = null): void
    {
    }
}
