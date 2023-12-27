<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    const IS_AVAILABLE = 'available';

    protected $appends = ['status_readable', 'attribute_readable'];

    public function scopeAvailable(Builder $query): void
    {
        $query->where('status', self::IS_AVAILABLE);
    }

    protected function getStatusReadableAttribute()
    {
        return match ($this->status) {
            'available' => 'ДОСТУПЕН',
            'unavailable' => 'НЕ ДОСТУПЕН'
        };
    }

    //    protected function data(): Attribute
    //    {
    //        return Attribute::make(
    //                        get: function (string $value) {
    //                            $result = [];
    //                            foreach (json_decode($value) as $attrName => $attrValue) {
    //                                $result[] = $attrName . ': ' . $attrValue;
    //                            }
    //
    //                            return $result;
    //                        }
    //        );
    //    }

    protected function getAttributeReadableAttribute()
    {
        $result = [];
        foreach (json_decode($this->data) as $attrName => $attrValue) {
            $result[] = $attrName.': '.$attrValue;
        }

        return $result;
    }
}
