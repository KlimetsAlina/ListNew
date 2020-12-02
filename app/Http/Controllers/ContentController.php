<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;

class ContentController extends Controller
{
    public function getContent($type)
    {
        $userId      = 1;         // TODO: получение/передача id юзера
        $userContent = User::findOrFail($userId)->contents()->where('type', $type)->get();

        return view('list', [
            'contentType' => $type,
            'content'     => $userContent,
            'menu'        => Menu::all(),
        ]);
    }
}
