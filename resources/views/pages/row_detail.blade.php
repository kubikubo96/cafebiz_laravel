@if(isset($error_comment))
<div class="col-md-12">
    <div class="alert alert-danger">
        {{$error_comment}}
    </div>
</div>
@endif
<!-- Posted Comments -->
@foreach($post->comment as $cm)
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="media"
                style="overflow: hidden;zoom: 1;padding-top: 15px;box-sizing: border-box; border-bottom: 1px solid #dddddd;margin-bottom: 15px;">
                <a class="pull-left" href="#" style="padding-right: 10px;">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a>
                <div class="media-body">
                    <h5 class="media-heading">{{@$cm->user->name}}
                        <small>{{$cm->created_at}}</small>
                    </h5>
                    {{$cm->content_comment}}
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach