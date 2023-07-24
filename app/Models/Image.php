<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImg;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    protected $fillable = ['src', 'thumb', 'alt', 'imageable_id', 'imageable_type'];

    // Definisikan relasi dengan model Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public static function uploadImage($img_response, $rezize = true)
    {
        if ($rezize == true) {
            $thumbnail = InterventionImg::make($img_response->getPathname())->resize(390, 220, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/thumbnails/' . $img_response->hashName(), 60));

            $image = InterventionImg::make($img_response->getPathname())->resize(800, 550, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/images/' . $img_response->hashName(), 90));

            return [
                'thumb' => $thumbnail,
                'src' => $image
            ];
        }

        return [
            'thumb' => null,
            'src' => $img_response->store('images')
        ];
    }

    public static function getImage()
    {
        $file_name = Str::random(10) . '.jpg';
        $raw_image = InterventionImg::make('https://picsum.photos/1300/600?random=' . mt_rand(1, 6));
        $thumbnail = $raw_image->resize(290, 220, function ($constraint) {
            $constraint->aspectratio();
        })->save(storage_path('app/public/thumbnails/' . $file_name), 60, 'jpg');

        $image = $raw_image->resize(800, 550, function ($constraint) {
            $constraint->aspectratio();
        })->save(storage_path('app/public/images/' . $file_name), 60, 'jpg');

        return [
            'thumb' => $thumbnail,
            'src' => $image
        ];
    }

    public static function getAlt($image)
    {
        return trim(str_replace(['.jpeg', '.jpg', '.png'], '', $image->getClientOriginalName()), ' \.');
    }

    // boot
    public static function boot()
    {
        parent::boot();

        self::creating(function ($image) {
            // ... code here
        });

        self::created(function ($image) {
            // ... code here
        });

        self::updating(function ($image) {
            // ... code here
        });

        self::updated(function ($image) {
            // ... code here
        });

        self::deleting(function ($image) {
        });

        self::deleted(function ($image) {
            if (Storage::disk('public')->exists($image->src)) {
                Storage::delete($image->src);
            }
            if (Storage::disk('public')->exists($image->thumb)) {
                Storage::delete($image->thumb);
            }
        });
    }
}
