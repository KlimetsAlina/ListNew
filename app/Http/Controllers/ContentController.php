<?php

namespace App\Http\Controllers;

use App\Content;
use App\Menu;
use App\User;
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
        $userContent = User::findOrFail($userId)->contents()->where('type', $type)->get();

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

        $content = $this->findContent($name, $author);

        if (!$content) {
            $content = new Content();

            $content->name      = $name;
            $content->author    = $author;
            $content->type      = $request->type;
            $content->something = '{}';

            $content->save();
        }

        $user = (new User)->find(Auth::id());
        $user->contents()->save($content, ['watched' => $request->watched]);
    }

    /**
     * Удаление привязки контента
     * @param \Illuminate\Http\Request $request
     */
    public function deleteUserContent(Request $request): void
    {
        $content = $this->findContent($request->name, $request->author);
        $user    = (new User)->find(Auth::id());

        $user->contents()->detach($content->id);
    }

    /**
     * Нахождение контента по имени и автору
     * @param string $name
     * @param string $author
     * @return \App\Content|\Illuminate\Database\Eloquent\Builder|mixed|null
     */
    public function findContent(string $name, string $author)
    {
        $content = Content::whereName($name)->get();

        foreach ($contents = $content as $item) {
            if ($item->author === $author) {
                return $item;
            }
        }

        return null;
    }
}
