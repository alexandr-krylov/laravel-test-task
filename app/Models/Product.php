<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const IS_AVAILABLE = 'available';

    public function scopeAvailable(Builder $query): void
    {
        $query->where('status', self::IS_AVAILABLE);
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => match ($value) {
                'available' => 'ДОСТУПЕН',
                'unavailable' => 'НЕ ДОСТУПЕН'
            }
        );
    }

    protected function data(): Attribute
    {
        return Attribute::make(
            get: function (string $value) {
                $result = [];
                foreach (json_decode($value) as $attrName => $attrValue) {
                    $result[] = $attrName.': '.$attrValue;
                }

                return $result;
            }
        );
    }
}
