@extends('layouts.master')

@section('content')
<!-- page_content -->
<div class="content">
    <div class="container" style="padding: 0;">
        <div class="row">
            <div class="col-md-9 c1" style="padding: 0 20px; border-right: 1px solid #e6e6e6;">
                <h4 style="margin:30px 15px 15px 15px;"><b>{{$post->title}}</b></h4>
                <p style="margin: 0 15px 15px 15px;">{{$post->created_at}} | <span>SỐNG</span></p>
                <div style="border-bottom: 1px dotted #b4b4b4; margin: 15px;"></div>
                <div class="c11" style="width: 90%; padding-left: 50px;">
                    <img style="margin-top: 30px;margin-bottom: 30px;" src="images/{{$post->image}}" width="100%" />
                    {!! $post->content_post !!}
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12" style="  min-height: 20px;
                                                                padding: 19px;
                                                                margin-bottom: 20px;
                                                                background-color: #f5f5f5;
                                                                border: 1px solid #e3e3e3;
                                                                border-radius: 4px;">
                                @if(!isset(Auth::user()->name))
                                <h4>Đăng nhập để bình luận<span class="glyphicon glyphicon-pencil"></span></h4>
                                <form action="" method="" role="">
                                    @csrf
                                    <div class="form-group">
                                        <textarea disabled class="form-control" name="content_comment"
                                            rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-dark">Comment</button>
                                </form>
                                @else
                                @if(session('notify'))
                                {{session('notify')}}
                                @endif
                                <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                                <form action="comments" method="post" role="form">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    @csrf
                                    <input type="hidden" id="id_user" value="{{Auth::id()}}" />
                                    <input type="hidden" id="id_post" value="{{$post->id}}" />
                                    <div class="form-group">
                                        <textarea class="form-control" name="content_comment" id="content_comment"
                                            rows="3"></textarea>
                                    </div>
                                    <button type="button" onclick="addComment()" class="btn btn-dark">Comment
                                    </button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="contentComment">
                    @include('pages.row_detail')
                </div>
            </div>
            <div class="col-md-3 cc" style="text-align: center;margin-top: 30px;">
                <img class="c9" src="images/qc3.JPG" width="80%" />
                <img class="c9" src="images/qc1.JPG" width="80%" />
                <img class="c9" src="images/qc2.JPG" width="80%" />
            </div>
        </div>
    </div>
</div>
<!-- end_page_content -->
@endsection('content')

@section('script')
<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //add comment
        function addComment() {
            var data = {
                id_post: $('#id_post').val(),
                id_user: $('#id_user').val(),
                content_comment: $('#content_comment').val(),
            }

            $.ajax({
                url: "{{route('comments.add_comments')}}",
                type: "post",
                dataType: "text",
                data: data,
                success: function (result) {
                    $("#contentComment").html(result);
                }
            });
        }
</script>
@endsection