<?php

namespace App\Http\Controllers;

use App\Content;

class ContentController extends Controller
{
    public function getContent($type)
    {
        $content = Content::where('type', $type)->get();

        if ($content) {
            return view('list', [
                'contentType' => $type,
                'content'     => $content,
            ]);
        }

        /* Когда контента нет return отдельн view
        или нет  */
        return view('home');
    }
}
