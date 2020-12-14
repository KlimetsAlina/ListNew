<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\DefaultContent
 *
 * @property int    $id
 * @property string $name
 * @property string $type
 * @property string $imgLink
 * @method static Builder|Content newModelQuery()
 * @method static Builder|Content newQuery()
 * @method static Builder|Content query()
 * @method static Builder|Content whereId($value)
 * @method static Builder|Content whereName($value)
 * @method static Builder|Content whereType($value)
 * @method static Builder|Content whereImgLink($value)
 * @mixin \Eloquent
 */
class DefaultContent extends Model
{
    protected $table = 'default_content';

    public $timestamps = false;

}
