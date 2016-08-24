@extends('frontend.layouts.master')
@section('title', $cate->name . ' - Sáng Béo Blog')
@section('keywords',$cate->keywords.', Sáng Béo Blog')
@section('description',$cate->description.' - Sáng Béo Blog')
@section('author','Sáng Béo')

@section('content')
    <div class="row">
        @include('backend.layouts.partials.notify')
        <div class="col-md-12">
            <ul class="breadcrumb">
                {{ breadcrumb($cate->id) }}
            </ul>
        </div>
        @if(count($cate->cates)>0)
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Danh mục con</h3>
                    </div>
                    <div class="list-group">
                        @foreach($cate->cates as $category)
                            <a href="{{route('cate',$category->id)}}" class="list-group-item">{{$category->name}} <span
                                        class="badge">{{count(getAllPostInCate($category->id))}}</span></a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Bài viết mới trong danh mục</h3>
                </div>
                <div class="panel-body">
                    @if(count($cate->posts) == 0)
                        <p class="alert alert-info">Không có bài viết nào</p>
                    @endif
                    @foreach($cate->posts()->paginate(Config::get('blogsettings.POSTS_PER_PAGE_CATE')) as $post)
                        <div class="row post">
                            <div class="col-md-12">
                                <h3 class="post-title"><a href="post/{{$post->id}}">{{$post->title}}</a></h3>
                            </div>
                            <div class="col-md-12">
                                <div class="post-info">
                                    <p><i class="fa fa-calendar"></i> Ngày đăng:
                                        <span>{{$post->created_at->format('d/m/Y H:i')}}</span></p>
                                    <p><i class="fa fa-user"></i> Người đăng: <a
                                                href="{{route('user',$post->user_id)}}">{{$post->user->name}}</a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @if($post->image != "")
                                        <div class="col-md-3 col-sm-4 col-xs-5 thumb">
                                            <img src="uploads/images/{{$post->image}}" alt="{{$post->title}}">
                                        </div>
                                        <div class="col-md-9 col-sm-8 col-xs-7 post-detail">
                                            @else
                                                <div class="col-md-12 post-detail">
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-12 post-preview">
                                                            {{ $post->description }}
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-md-12 wrap-pagination">
                                    {{ $cate->posts()->paginate(Config::get('blogsettings.POSTS_PER_PAGE_CATE'))->links() }}
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
@endsection