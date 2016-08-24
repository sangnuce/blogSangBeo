<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Cate;
use Illuminate\Support\Facades\Auth;

class CateController extends Controller
{
    public function getAdd()
    {
        return view('backend.pages.cate.add');
    }

    public function postAdd(Request $rq)
    {
        $this->validate($rq, [
            'name' => 'required|unique:cates,name'
        ],
            [
                'name.required' => 'Tên chuyên mục bắt buộc nhập!',
                'name.unique' => 'Tên chuyên mục đã tồn tại!'
            ]);
        $cate = new Cate;
        $cate->name = $rq->name;
        $cate->slug = makeSlug($rq->name);
        $cate->keywords = $rq->keywords;
        $cate->description = $rq->description;
        $cate->parent_id = $rq->parent_id;
        $cate->status = $rq->status;
        $cate->save();
        return redirect()->route('admin.cate.list')->with(['flash_class' => 'alert-success', 'flash_message' => 'Thêm mới thành công!']);
    }

    public function getList()
    {
        $cates = Cate::orderBy('parent_id', 'ASC')->orderBy('name', 'ASC')->get();
        return view('backend.pages.cate.list', compact('cates'));
    }

    public function getEdit($id)
    {
        $cate = Cate::find($id);
        if (empty($cate)) {
            return redirect()->route('admin.cate.list')->withErrors('Không tồn tại danh mục có id = ' . $id);
        }
        return view('backend.pages.cate.edit', compact('cate'));
    }

    public function postEdit(Request $rq, $id)
    {
        $this->validate($rq, [
            'name' => 'required|unique:cates,name,' . $id
        ],
            [
                'name.required' => 'Tên chuyên mục bắt buộc nhập!',
                'name.unique' => 'Tên chuyên mục đã tồn tại!'
            ]);
        $cate = Cate::find($id);
        $cate->name = $rq->name;
        $cate->slug = makeSlug($rq->name);
        $cate->keywords = $rq->keywords;
        $cate->description = $rq->description;
        $cate->parent_id = $rq->parent_id;
        $cate->status = $rq->status;
        $cate->save();
        return redirect()->route('admin.cate.list')->with(['flash_class' => 'alert-success', 'flash_message' => 'Cập nhật thành công!']);
    }

    public function viewCate($id)
    {
        $cate = Cate::find($id);
        if (empty($cate) || $cate->status == 0) {
            return redirect()->route('home')->with(['flash_class' => 'alert-info', 'flash_message' => 'Danh mục không khả dụng!']);
        }
        return view('frontend.pages.cate', ['cate' => $cate]);
    }
}