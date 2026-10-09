<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Food extends Model
{
    protected $table = 'foods';

    private const FALLBACK_FOOD_IMAGES = [
        'uji' => 'photo-1555078604-b2379f0e964a',
        'porridge' => 'photo-1555078604-b2379f0e964a',
        'burger' => 'photo-1568901346375-23c9450c58cd',
        'pizza' => 'photo-1513104890138-7c749659a591',
        'pasta' => 'photo-1551183053-bf91a1d81141',
        'chicken' => 'photo-1544025162-d76694265947',
        'juice' => 'photo-1600271886742-f049cd451bba',
        'rice' => 'photo-1512058564366-18510be2db19',
        'breakfast' => 'photo-1490645935967-10de6ba17061',
    ];

    private const GENERIC_FOOD_IMAGES = [
        'photo-1547592180-85f173990554',
        'photo-1512621776951-a57141f2eefd',
        'photo-1540189549336-e6e99c3679fe',
        'photo-1498837167922-ddd27525d352',
    ];

    protected $fillable = [
        'name',
        'category',
        'description',
        'price',
        'image',
        'is_available',
    ];

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return $this->fallbackImageUrl();
        }

        if (str_starts_with($this->image, 'foods/')) {
            return Storage::disk('public')->exists($this->image)
                ? Storage::disk('public')->url($this->image)
                : $this->fallbackImageUrl();
        }

        if (basename($this->image) === $this->image
            && is_file(public_path('images/foods/' . $this->image))) {
            return asset('images/foods/' . $this->image);
        }

        return $this->fallbackImageUrl();
    }

    private function fallbackImageUrl(): string
    {
        $foodDetails = strtolower($this->name . ' ' . $this->category);

        foreach (self::FALLBACK_FOOD_IMAGES as $keyword => $image) {
            if (str_contains($foodDetails, $keyword)) {
                return 'https://images.unsplash.com/' . $image . '?auto=format&fit=crop&w=900&q=80';
            }
        }

        $imageIndex = $this->getKey()
            ? ((int) $this->getKey() % count(self::GENERIC_FOOD_IMAGES))
            : 0;
        $image = self::GENERIC_FOOD_IMAGES[$imageIndex];

        return 'https://images.unsplash.com/' . $image . '?auto=format&fit=crop&w=900&q=80';
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}