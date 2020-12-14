<?php

namespace App\Http\Controllers;

use App\Content;
use App\DefaultContent;
use App\Menu;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $content = Content::getTopContents(Auth::user())->take(6);

        if ($content->isEmpty()) {
            $content       = DefaultContent::all();
            $picturesLinks = [];
        } else {
            $picturesLinks = Content::getContentImage($content);
        }

        return view('home', [
            'menu'        => Menu::all(),
            'topContents' => $content,
            'links'       => $picturesLinks,
        ]);
    }
}
