<?php

namespace App;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Log;

/**
 * App\Content
 *
 * @property int    $id
 * @property string $name
 * @property string $author
 * @property string $type
 * @method static Builder|Content newModelQuery()
 * @method static Builder|Content newQuery()
 * @method static Builder|Content query()
 * @method static Builder|Content whereAuthor($value)
 * @method static Builder|Content whereId($value)
 * @method static Builder|Content whereName($value)
 * @method static Builder|Content whereType($value)
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
     * Св-ва, которые будут преобразованы
     * @var array
     */
    protected $casts = [
        'something' => 'array',
    ];

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

    /**
     * @param $user
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTopContents($user): Collection
    {
        return $user->contents()->wherePivot('sort', '=', 1)->getResults();
    }

    /**
     * @param $content
     * @return array
     */
    public static function getContentImage($content): array
    {
        $basicUrl = 'https://www.googleapis.com/customsearch/v1?key=' . env('API_GKEY') . '&cx=' . env('CX') . '&searchType=image&num=1&q=';

        $client = new Client();

        $result = [];

        foreach ($content as $item) {

            if (array_key_exists('imgLink', $item->something)) {
                $result[] = $item->something['imgLink'];
            } else {
                $searchPhrase = $item->name . ' ' . ($item->author ? $item->author . ' ' : '') . $item->type;
                Log::channel('list')->debug('searchPhrase: ' . $searchPhrase, ['contentName' => $item->name]);

                try {
                    $myResponse = $client->request('GET', $basicUrl . $searchPhrase);
                } catch (GuzzleException $e) {
                    Log::channel('list')->error('При обращении к стороннему API возникла ошибка ' . $e->getMessage());
                    continue; // TODO : CHANGE IT
                }
                Log::channel('list')->debug($myResponse->getStatusCode());

                $responseBody = $myResponse->getBody();
                Log::channel('list')->debug($responseBody);

                $jsonResult = json_decode($responseBody, false);

                $link = $jsonResult->items[0]->link;
                Log::channel('list')->debug('url найденной картинки ' . $link, ['contentName' => $item->name]);

                $item->something = '{ "imgLink": "' . $link . '"}';
                $item->save();

                $result[] = $link;
            }
        }

        Log::channel('list')->debug('linksArray: ', $result);

        return $result;
    }
}
