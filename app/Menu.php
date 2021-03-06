<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Menu
 *
 * @property int    $id
 * @property string $name
 * @property string $link
 * @method static Builder|Content newModelQuery()
 * @method static Builder|Content newQuery()
 * @method static Builder|Content query()
 * @method static Builder|Content whereId($value)
 * @method static Builder|Content whereName($value)
 * @method static Builder|Content whereLink($value)
 * @mixin \Eloquent
 */

class Menu extends Model
{
    protected $table      = 'menu';
    public    $timestamps = false;

}
