<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use Illuminate\Support\Facades\Auth;

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
}
