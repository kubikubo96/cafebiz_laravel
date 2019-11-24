<div class="modal fade add_post" tabindex="-1" role="dialog" id="add_post" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <button style="padding: 10px; margin-top: 10px;" type="button" class="close" data-dismiss="modal"
                aria-label="Close">
                <span aria-hidden="true" style="float: right;">&times;</span>
            </button>
            <div class="col-md-12">
                <h1 class="page-header" style="margin-top: 0;">Posts
                    <small>Add</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-md-12">
                <form enctype="multipart/form-data" id="postForm" name="postForm" class="form-horizontal"
                    style="width: 90%; margin: 0 auto;">
                    {{--meta name="csrf-token"...  => phải có mới dùng đc ajax--}}
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}" />
                    <div class="form-group">
                        <label>Title</label>
                        <input class="form-control" name="title" id="title" placeholder="Nhập title" />
                    </div>
                    <div class="form-group">
                        <label>Title_link</label>
                        <input class="form-control" name="title_link" id="title_link" placeholder="Nhập title_link" />
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea class="form-control" rows="3" name="content_post" id="content_post"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" id="image">
                    </div>
                    <div style="margin-top: 20px;">
                        <p class="error_post text-danger hidden"></p>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="margin-top: 10px; border: none;">
                <button type="button" id="saveChangePost" class="btn btn-primary">Save changes
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>