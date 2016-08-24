<div class="col-sm-6 col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title">Tìm kiếm</h3>
        </div>
        <div class="panel-body">
            <form action="{!! route('search') !!}" method="get">
                <div class="input-group">
                    <input class="form-control" type="text" name="k" id="k" placeholder="Nhập từ khoá..."
                           value="{!! old('keyword') !!}">
                    <span class="input-group-btn">
					<button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
					</span>
                </div>
            </form>
        </div>
    </div>
</div>