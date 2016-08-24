<?php

namespace App\Http\Controllers;

use App\Cate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function getAdd()
    {
        return view('backend.pages.post.add');
    }

    public function postAdd(Request $rq)
    {
        $this->validate(
            $rq,
            [
                'cate_id' => 'required|not_in:0',
                'title' => 'required|unique:posts,title',
                'body' => 'required',
                'description' => 'required'
            ],
            [
                'cate_id.required' => 'Bắt buộc chọn danh mục',
                'cate_id.not_in' => 'Bắt buộc chọn danh mục',
                'title.required' => 'Bắt buộc nhập tiêu đề bài viết!',
                'title.unique' => 'Tiêu đề bài viết đã tồn tại!',
                'body.required' => 'Bắt buộc nhập nội dung bài viết!',
                'description.required' => 'Bắt buộc nhập mô tả cho bài viết!'
            ]
        );
        $post = new Post();
        $post->title = $rq->title;
        $post->slug = makeSlug($rq->title);
        if ($rq->hasFile('image')) {
            $file = $rq->file('image');
            do {
                $name = str_random(5) . '_' . $file->getClientOriginalName();
            } while (file_exists('uploads/images/' . $name));

            $file->move('uploads/images', $name);
            $post->image = $name;
        } else {
            $post->image = '';
        }
        $post->body = $rq->body;
        $post->keywords = $rq->keywords;
        $post->description = $rq->description;
        $post->status = $rq->status;
        $post->tags = $rq->tags;
        $post->cate_id = $rq->cate_id;
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect()->route('admin.post.list')->with(['flash_class' => 'alert-success', 'flash_message' => 'Thêm mới thành công!']);
    }

    public function getList()
    {
        $posts = Post::orderBy('id', 'DESC')->get();
        return view('backend.pages.post.list', compact('posts'));
    }

    public function getEdit($id)
    {
        $post = Post::find($id);
        if (empty($post)) {
            return redirect()->route('admin.post.list')->withErrors('Không tồn tại bài viết có id = ' . $id);
        }
        if ($post->user_id != Auth::user()->id) {
            return redirect()->route('admin.post.list')->withErrors('Không được sửa bài viết không phải do bạn đăng');
        }
        return view('backend.pages.post.edit', compact('post'));
    }

    public function postEdit(Request $rq, $id)
    {
        $this->validate(
            $rq,
            [
                'cate_id' => 'required|not_in:0',
                'title' => 'required|unique:posts,title,' . $id,
                'body' => 'required',
                'description' => 'required'
            ],
            [
                'cate_id.required' => 'Bắt buộc chọn danh mục',
                'cate_id.not_in' => 'Bắt buộc chọn danh mục',
                'title.required' => 'Bắt buộc nhập tiêu đề bài viết!',
                'title.unique' => 'Tiêu đề bài viết đã tồn tại!',
                'body.required' => 'Bắt buộc nhập nội dung bài viết!',
                'description.required' => 'Bắt buộc nhập mô tả cho bài viết!'
            ]
        );
        $post = Post::find($id);
        $post->title = $rq->title;
        $post->slug = makeSlug($rq->title);
        if ($rq->hasFile('image')) {
            if ($post->image != "") {
                if (file_exists('uploads/images/' . $post->image)) {
                    unlink('uploads/images/' . $post->image);
                }
            }
            $file = $rq->file('image');
            do {
                $name = str_random(5) . '_' . $file->getClientOriginalName();
            } while (file_exists('uploads/images/' . $name));

            $file->move('uploads/images', $name);
            $post->image = $name;
        }
        $post->body = $rq->body;
        $post->keywords = $rq->keywords;
        $post->description = $rq->description;
        $post->status = $rq->status;
        $post->tags = $rq->tags;
        $post->cate_id = $rq->cate_id;
        $post->save();
        return redirect()->route('admin.post.list')->with(['flash_class' => 'alert-success', 'flash_message' => 'Cập nhật thành công!']);
    }

    public function viewPost($id)
    {
        $post = Post::find($id);
        if (empty($post) || $post->status == 0) {
            return redirect()->route('home')->with(['flash_class' => 'alert-info', 'flash_message' => 'Bài viết không khả dụng!']);
        }
        $post->view++;
        $post->save();
        return view('frontend.pages.post', ['post' => $post]);
    }
}
