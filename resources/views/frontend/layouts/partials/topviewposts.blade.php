<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Bài viết nổi bật</h3>
        </div>
        <div class="list-group">
            @foreach(topViewPosts(5) as $post)
                <div class="list-group-item">
                    <span><i class="fa fa-arrow-circle-right"></i> <a
                                href="{{ route('post',$post->id) }}">{{ $post->title }}</a> - {{ $post->view }} view(s)</span>
                </div>
            @endforeach
        </div>
    </div>
</div>