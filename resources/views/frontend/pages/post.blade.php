@extends('frontend.layouts.master')
@section('title',$post->title.' - Sáng Béo Blog')
@section('keywords',$post->keywords.', Sáng Béo Blog')
@section('description',$post->description.' - Sáng Béo Blog')
@section('author',$post->user->name)

@section('content')
    <div class="row">
        @include('backend.layouts.partials.notify')
        <div class="col-md-12">
            <ul class="breadcrumb">
                {{ breadcrumb($post->cate_id) }}
            </ul>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h1 class="panel-title text-center">{{$post->title}}</h1>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="view-post-info">
                                <p><i class="fa fa-calendar"></i> Ngày đăng:
                                    <span>{{$post->created_at->format('d/m/Y H:i')}}</span></p>
                                <p><i class="fa fa-user"></i> Người đăng: <a
                                            href="{{route('user',$post->user_id)}}">{{$post->user->name}}</a></p>
                                <p><i class="fa fa-eye"></i> Lượt xem: <span>{{$post->view}}</span></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @if($post->image != "")
                                    <div class="col-md-12">
                                        <div class="post-image text-center">
                                            <img src="uploads/images/{{$post->image}}" alt="{{$post->title}}">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <div class="post-body">
                                        {!! $post->body !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="post-tags">
                                        <i class="fa fa-tags"></i> Tags:
                                        @foreach(explode(',',$post->tags) as $tag)
                                            @if($tag != "")
                                                <a href="{{route('search')}}?type=tags&k={{$tag}}"><span
                                                            class="label label-primary"><i
                                                                class="fa fa-tag"></i> {{$tag}}</span></a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-primary" id="comment">
                <div class="panel-heading">
                    <h4 class="panel-title">Bình luận</h4>
                </div>
                <div class="panel-body">
                    @if(Auth::check())
                        <form action="{{route('post.comment',$post->id)}}" role="form" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token()  }}">
                            <div class="form-group">
                                <textarea class="form-control" id="comment-box" name="comment"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi</button>
                        </form>
                    @else
                        <div class="alert alert-danger">
                            Bạn cần phải <a href="{{route('login')}}">Đăng nhập</a> để có thể bình luận
                        </div>
                    @endif
                    <hr>
                    @if(count($post->comments) == 0)
                        <div class="alert alert-info">Hiện tại bài viết chưa có bình luận nào</div>
                    @endif
                    @foreach($post->comments()->paginate(Config::get('blogsettings.COMMENTS_PER_PAGE')) as $comment)
                        <div class="media" data-id="{{$comment->id}}" id="comment-{{$comment->id}}">
                            <div class="media-body">
                                @if(Auth::user()->isAdmin() || Auth::user()->isMod())
                                    <button type="button" class="close manage-comment delete-comment"
                                            data-id="{{$comment->id}}">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                @endif
                                <h4 class="media-heading">{{$comment->user->username}} ({{$comment->user->name}})
                                    <small>{{$comment->created_at->format('d/m/Y H:i')}}</small>
                                </h4>
                                <div class="comment-body">
                                    {!! $comment->comment !!}
                                    <div class="col-md-12">
                                        <a href="">Trả lời</a>
                                    </div>
                                </div>
                            </div>
                            @foreach($comment->comments as $reply_comment)
                                <div class="media media-reply" data-id="{{$reply_comment->id}}"
                                     id="comment-{{$reply_comment->id}}">
                                    <div class="media-body">
                                        @if(Auth::user()->isAdmin() || Auth::user()->isMod())
                                            <button type="button" class="close manage-comment delete-comment"
                                                    data-id="{{$reply_comment->id}}">
                                                <i class="fa fa-remove"></i>
                                            </button>
                                        @endif
                                        <h4 class="media-heading">{{$reply_comment->user->username}}
                                            ({{$reply_comment->user->name}})
                                            <small>{{$reply_comment->created_at->format('d/m/Y H:i')}}</small>
                                        </h4>
                                        <div class="comment-body">
                                            {!! $reply_comment->comment !!}
                                            <div class="col-md-12">
                                                <a href="">Trả lời</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="row">
                        <div class="col-md-12 wrap-pagination">
                            {{ $post->comments()->paginate(Config::get('blogsettings.COMMENTS_PER_PAGE'))->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('before-custom-style')
    <link rel="stylesheet" href="plugins/simplemde/dist/simplemde.min.css">
@endsection

@section('before-custom-script')
    <script src="plugins/simplemde/dist/simplemde.min.js"></script>
@endsection

@section('after-custom-script')
    <script>
        var simplemde = new SimpleMDE({
            element: $("#comment-box")[0],
            spellChecker: false,
            autosave: {
                enabled: false
            },
            autoDownloadFontAwesome: false,
            tabSize: 4,
            status: false
        });

        $(".delete-comment").click(function () {
            var id = $(this).attr('data-id');
            if (confirm('Xác nhận xóa bình luận?')) {
                $.ajax({
                    url: 'ajax/comment/delete',
                    type: 'GET',
                    data: {
                        comment_id: id
                    },
                    success: function (data) {
                        if (data.success == true) {
                            $("div.media[data-id=" + id + "]").slideUp('slow');
                        }
                        alert(data.message);
                    }
                });
            }
        });
    </script>
@endsection