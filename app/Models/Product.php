<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

/**
 * @property int           $id
 * @property string        $name
 * @property int           $price
 * @property string        $img
 * @property string        $description
 * @property bool          $in_stock
 * @property Carbon|string $created_at
 * @property Carbon|string $updated_at
 *
 * @method static User|Builder query()
 * @method User|Builder where($column, $operator = null, $value = null, $boolean = 'and')
 */
class Product extends Model
{
    use HasFactory;

    /**
     * @return Attribute
     */
    public function imgUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::drive('public')->url($this->attributes['img'])
        );
    }

    /**
     * @return Attribute
     */
    public function inStock(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->attributes['in_stock'] ? 'В наличии' : 'Нет в наличии'
        );
    }
}
