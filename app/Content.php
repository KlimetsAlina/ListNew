<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

/**
 * App\Content
 *
 * @property int    $id
 * @property string $name
 * @property string $author
 * @property string $type
 * @method static \Illuminate\Database\Eloquent\Builder|Content newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Content query()
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Content whereType($value)
 * @mixin \Eloquent
 */
class Content extends Model
{
    /**
     * Связанная с моделью таблица.
     *
     * @var string
     */
    protected $table = 'content';

    /**
     * Определяет необходимость отметок времени для модели.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Юзеры, имеющие этот контент
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_contents', 'contentId', 'userId')->withPivot(['watched', 'sort']);
    }

    public static function getContent($type, $userId)
    {
        return User::findOrFail($userId)->contents()->where('type', $type)->get();
    }

    /**
     * Нахождение контента по имени и автору
     * @param string $name
     * @param string $author
     * @return \App\Content|\Illuminate\Database\Eloquent\Builder|mixed|null
     */
    public function findContent(string $name, string $author)
    {
        $content = self::whereName($name)->get();

        foreach ($contents = $content as $item) {
            if ($item->author === $author) {
                return $item;
            }
        }

        return null;
    }


}
