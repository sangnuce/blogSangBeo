<?php

function show_cates($parent = 0, $str = "", $selected = 0, $excepted = 0)
{
    $cates = DB::table('cates')->where('parent_id', $parent)->where('status', 1)->get();
    foreach ($cates as $cate) {
        if ($cate->id == $excepted) continue;
        if ($cate->id == $selected) {
            echo '<option value="' . $cate->id . '" selected>' . $str . $cate->name . '</option>';
        } else {
            echo '<option value="' . $cate->id . '">' . $str . $cate->name . '</option>';
        }
        show_cates($cate->id, "&nbsp;&nbsp;&nbsp;&nbsp;" . $str, $selected, $excepted);
    }
}

function makeSlug($str)
{
    $str = trim($str);
    if ($str == "") return "";
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
        'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
        'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị',
        'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
        'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
        'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'd' => 'đ',
        'D' => 'Đ',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
        'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ'
    );
    foreach ($unicode as $khongdau => $codau) {
        $arr = explode('|', $codau);
        $str = str_replace($arr, $khongdau, $str);
    }
    $str = mb_convert_case($str, MB_CASE_LOWER, 'utf-8');
    $str = preg_replace('/[\\s\+\.]/', '-', $str);
    $str = preg_replace('/[^A-Za-z0-9-]/', '', $str);
    $str = preg_replace('/-+/', '-', $str);
    return $str;
}

function getCateName($cate_id)
{
    $cate = DB::table('cates')->where('id', $cate_id)->first();
    if (!empty($cate)) {
        return $cate->name;
    }
    return "NULL";
}

function breadcrumb($cate_id)
{
    if ($cate_id == 0) {
        echo '<li><a href="' . route('home') . '"><i class="fa fa-home"></i></a></li>';
    } else {
        $cate = DB::table('cates')->find($cate_id);
        breadcrumb($cate->parent_id);
        echo '<li><a href="' . route('cate', $cate->id) . '">' . $cate->name . '</a></li>';
    }
}

function getAllPostInCate($cate_id)
{
    $posts = DB::table('posts')->where('cate_id', $cate_id)->where('status', 1)->get();
    $cates = DB::table('cates')->where('parent_id', $cate_id)->where('status', 1)->get();
    foreach ($cates as $cate) {
        $posts = array_merge($posts, getAllPostInCate($cate->id));
    }
    return $posts;
}

function showListCate()
{
    $cates = DB::table('cates')->where('parent_id', 0)->orderBy('name', 'ASC')->where('status', 1)->get();
    foreach ($cates as $cate) {
        echo '<a href="' . route('cate', $cate->id) . '" class="list-group-item">' . $cate->name . ' <span class="badge pull-right" title="' . count(getAllPostInCate($cate->id)) . ' post(s)">' . count(getAllPostInCate($cate->id)) . '</span></a>';
    }
}

function topViewPosts($n)
{
    $posts = DB::table('posts')->where('status', 1)->orderBy('view', 'DESC')->take($n)->get();
    return $posts;
}