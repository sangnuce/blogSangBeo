<?php

namespace App\Http\Controllers;

use App\Cate;
use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function getDeleteCate(Request $rq)
    {
        $result = ['success' => '', 'message' => ''];
        if (Auth::user()->isAdmin() || Auth::user()->isMod()) {
            $id = $rq->cate_id;
            $cate = Cate::find($id);
            if (!empty($cate)) {
                $cate->delete();
                $result['success'] = true;
                $result['message'] = 'Xoá thành công';
            } else {
                $result['success'] = false;
                $result['message'] = 'Không tồn tại danh mục có ID = ' . $rq->user_id;
            }
        } else {
            $result['success'] = false;
            $result['message'] = 'Bạn không được quyền thực hiện thao tác này';
        }
        return $result;
    }

    public function getDeleteUser(Request $rq)
    {
        $result = ['success' => '', 'message' => ''];
        if (Auth::user()->isAdmin() || Auth::user()->isMod()) {
            $id = $rq->user_id;
            $user = User::find($id);
            if (!empty($user)) {
                if (Auth::user()->isAdmin() || !$user->isAdmin()) {
                    $user->delete();
                    $result['success'] = true;
                    $result['message'] = 'Xoá thành công';
                } else {
                    $result['success'] = false;
                    $result['message'] = 'Bạn không được quyền thực hiện thao tác này với người dùng có cấp bậc cao hơn';
                }
            } else {
                $result['success'] = false;
                $result['message'] = 'Không tồn tại người dùng có ID = ' . $rq->user_id;
            }
        } else {
            $result['success'] = false;
            $result['message'] = 'Bạn không được quyền thực hiện thao tác này';
        }
        return $result;
    }

    public function getDeletePost(Request $rq)
    {
        $result = ['success' => '', 'message' => ''];
        if (Auth::user()->isAdmin() || Auth::user()->isMod()) {
            $id = $rq->post_id;
            $post = Post::find($id);
            if (!empty($post)) {
                if (Auth::user()->isAdmin() || $post->user->id == Auth::user()->id) {
                    if ($post->image != "") {
                        if (file_exists('uploads/images/' . $post->image)) {
                            unlink('uploads/images/' . $post->image);
                        }
                    }
                    $post->delete();
                    $result['success'] = true;
                    $result['message'] = 'Xoá thành công';
                } else {
                    $result['success'] = false;
                    $result['message'] = 'Bạn không được xoá bài viết của người khác';
                }
            } else {
                $result['success'] = false;
                $result['message'] = 'Không tồn tại bài viết có ID = ' . $rq->user_id;
            }
        } else {
            $result['success'] = false;
            $result['message'] = 'Bạn không được quyền thực hiện thao tác này';
        }
        return $result;
    }

    public function getPostRemoveImage(Request $rq)
    {
        $result = ['success' => '', 'message' => ''];
        if (Auth::user()->isAdmin() || Auth::user()->isMod()) {
            $id = $rq->post_id;
            $post = Post::find($id);
            if (!empty($post)) {
                if ($post->image != "") {
                    unlink("uploads/images/" . $post->image);
                    $post->image = "";
                    $post->save();
                    $result['success'] = true;
                    $result['message'] = 'Loại bỏ ảnh bài viết thành công';
                } else {
                    $result['success'] = false;
                    $result['message'] = 'Ảnh bài viết không tồn tại';
                }
            } else {
                $result['success'] = false;
                $result['message'] = 'Không tồn tại bài viết có ID = ' . $rq->post_id;
            }
        } else {
            $result['success'] = false;
            $result['message'] = 'Bạn không được quyền thực hiện thao tác này';
        }
        return $result;
    }

    public function getDeleteComment(Request $rq)
    {
        $result = ['success' => '', 'message' => ''];
        if (Auth::user()->isAdmin() || Auth::user()->isMod()) {
            $id = $rq->comment_id;
            $comment = Comment::find($id);
            if (!empty($comment)) {
                if (Auth::user()->isAdmin() || !$comment->user->isAdmin()) {
                    $comment->delete();
                    $result['success'] = true;
                    $result['message'] = 'Xoá thành công';
                } else {
                    $result['success'] = false;
                    $result['message'] = 'Bạn không được xoá bình luận của người có cấp bậc cao hơn';
                }
            } else {
                $result['success'] = false;
                $result['message'] = 'Không tồn tại bình luận có ID = ' . $rq->comment_id;
            }
        } else {
            $result['success'] = false;
            $result['message'] = 'Bạn không được quyền thực hiện thao tác này';
        }
        return $result;
    }

    public function getApproveComment(Request $rq)
    {
        $result = ['success' => '', 'message' => ''];
        if (Auth::user()->isAdmin() || Auth::user()->isMod()) {
            $id = $rq->comment_id;
            $comment = Comment::find($id);
            if (!empty($comment)) {
                if ($rq->status == 1) {
                    $comment->status = 1;
                    $result['message'] = 'Duyệt thành công';
                } else {
                    $comment->status = 0;
                    $result['message'] = 'Bỏ duyệt thành công';
                }
                $comment->save();
                $result['success'] = true;
            } else {
                $result['success'] = false;
                $result['message'] = 'Không tồn tại bình luận có ID = ' . $rq->comment_id;
            }
        } else {
            $result['success'] = false;
            $result['message'] = 'Bạn không được quyền thực hiện thao tác này';
        }
        return $result;
    }
}
