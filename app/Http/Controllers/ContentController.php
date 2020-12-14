<?php

namespace App\Http\Controllers;

use App\Content;
use App\Menu;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    /**
     * Получение пользовательского контента
     * конкретного типа
     * @param $type
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getContent($type)
    {
        $userId      = Auth::id();
        $userContent = Content::getContent($type, $userId);
        // $userContent = User::findOrFail($userId)->contents()->where('type', $type)->get();

        return view('list', [
            'contentType' => $type,
            'content'     => $userContent,
            'menu'        => Menu::all(),
        ]);
    }

    /**
     * Добавление контента
     * @param \Illuminate\Http\Request $request
     */
    public function addContent(Request $request): void
    {
        $name   = $request->name;
        $author = $request->author;

        $content = (new Content)->findContent($name, $author);

        if ($content === null) {
            $content            = new Content();
            $content->name      = $name;
            $content->author    = $author;
            $content->type      = $request->type;
            $content->something = '{}';
            $content->save();
        }

        $user = (new User)->find(Auth::id());

        if (!$user->contents()->get()->contains($content->id)) {
            $user->contents()->save($content, ['watched' => $request->watched]); // TODO подумать над watched
        }
        // Если watched различаются, то перезаписать это значение
    }

    /**
     * Удаление привязки контента
     * @param \Illuminate\Http\Request $request
     */
    public function deleteUserContent(Request $request): void
    {
        $content = (new Content)->findContent($request->name, $request->author);
        $user    = (new User)->find(Auth::id());

        $user->contents()->detach($content->id);
    }

    /**
     * Получение колонки контента (просмотренное/непросмотренное)
     * по типу и юзеру
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getColumnContent(Request $request): JsonResponse
    {
        $user    = (new User)->find(Auth::id());
        $content = Content::getContent($request->type, $user->id);

        $result = [];

        foreach ($content as $item) {
            if ($item->pivot->watched === $request->watched) {
                $result[] = [
                    'name'   => $item->name,
                    'author' => $item->author,
                ];
            }
        }

        return response()->json($result);
    }
}
