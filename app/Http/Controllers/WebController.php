<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class WebController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 1)->orderBy('id', 'DESC')->paginate(Config::get('blogsettings.POSTS_PER_PAGE_HOME'));
        return view('frontend.pages.index', ['posts' => $posts]);
    }

    public function admin_index()
    {
        return view('backend.pages.index');
    }

    public function getSearch(Request $rq)
    {
        $k = $rq->k;
        $type = '';
        if ($rq->has('type') && $rq->type == 'tags') {
            $type = $rq->type;
            $posts = Post::where('tags', 'like', '%' . $k . '%')
                ->where('status', 1)
                ->orderBy('id', 'DESC')->paginate(Config::get('blogsettings.POSTS_PER_PAGE_SEARCH'));
        } else {
            $posts = Post::where(function ($query) use ($k) {
                $query->where('title', 'like', '%' . $k . '%')
                    ->orWhere('keywords', 'like', '%' . $k . '%')
                    ->orWhere('description', 'like', '%' . $k . '%')
                    ->orWhere('body', 'like', '%' . $k . '%')
                    ->orWhere('tags', 'like', '%' . $k . '%');
            })
                ->where('status', 1)
                ->orderBy('id', 'DESC')->paginate(Config::get('blogsettings.POSTS_PER_PAGE_SEARCH'));
        }
        return view('frontend.pages.search', ['type' => $type, 'k' => $k, 'posts' => $posts]);
    }
}
