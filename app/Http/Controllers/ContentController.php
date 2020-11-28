<?php

namespace App\Http\Controllers;

use App\Content;

class ContentController extends Controller
{
    public function getFilms()
    {
        return $this->getUserContentByType('film');
    }

    public function getSerials()
    {
        return $this->getUserContentByType('serial');
    }

    public function getBooks()
    {
        return $this->getUserContentByType('book');
    }

    public function getMusic()
    {
        return $this->getUserContentByType('music');
    }

    public function getOther()
    {
        return $this->getUserContentByType('other');
    }

    public function getUserContentByType(string $type)
    {
        $content = Content::where('type', $type)->get();

        return view('list', [
            'contentType' => $type,
            'content'     => $content,
        ]);
    }
}
