<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Markdown;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class CommentController extends Controller
{
    public function postComment(Request $rq, $post_id)
    {
        $this->validate(
            $rq,
            [
                'comment' => 'required'
            ],
            [
                'comment.required' => 'Bắt buộc nhập nội dung bình luận'
            ]
        );
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('Bạn phải đăng nhập để thực hiện hành động này!');
        }
        $post = Post::find($post_id);
        if (empty($post) || $post->status == 0) {
            return redirect()->route('home')->with(['flash_class' => 'alert-info', 'flash_message' => 'Bài viết không khả dụng!']);
        }
        $comment = new Comment();
        $comment->post_id = $post_id;
        $comment->user_id = Auth::user()->id;
        $comment->comment = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", nl2br(Markdown::parse($rq->comment)));
        if (Config::get('blogsettings.APPROVE_COMMENT') == 1) {
            if (Auth::user()->isAdmin() || Auth::user()->isMod()) {
                $comment->status = 1;
            } else {
                $comment->status = 0;
            }
        } else {
            $comment->status = 1;
        }
        $comment->save();
        if ($comment->status == 1) {
            return redirect(route('post', $post_id) . '#comment')->with(['flash_class' => 'alert-success', 'flash_message' => 'Thêm mới bình luận thành công']);
        } else {
            return redirect()->route('post', $post_id)->with(['flash_class' => 'alert-warning', 'flash_message' => 'Thêm mới bình luận thành công. Chờ kiểm duyệt!']);
        }
    }

    public function getList()
    {
        $comments = Comment::orderBy('status', 'ASC')->orderBy('id', 'DESC')->get();
        return view('backend.pages.comment.list', ['comments' => $comments]);
    }
}
