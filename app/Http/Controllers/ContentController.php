<?php

namespace App\Http\Controllers;

use App\Content;
use App\Menu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContentController extends Controller
{
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

    public function addContent(Request $request)
    {
        Log::channel('list')->debug($request);

        $id       = 0;
        $contents = Content::all();
        foreach ($contents as $item) {
            if (($item->name === $request->name) && $item->author === $request->author) {
                $id = $item->id;
                break;
            }
        }

        if ($id) {
            $content = Content::find($id);
        } else {
            $content = new Content();

            $content->name      = $request->name;
            $content->author    = $request->author;
            $content->type      = substr($request->type, 1);
            $content->something = '{}';

            $content->save();
        }

        $user = User::find(Auth::id());
        $user->contents()->save($content, ['watched' => $request->watched]);
    }
}
