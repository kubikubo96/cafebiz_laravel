<table class="table table-striped table-bordered table-hover dataTableComment" id="sample_2">
    <thead>
        <tr>
            <th>Commenter</th>
            <th>Title of Posts</th>
            <th>Content Comment</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody id="comment_result">
        @foreach($comment as $cm)
        <tr id="comment_id_{{$cm->id}}">
            <td>
                {{@$cm->user->name}}
            </td>
            <td>
                {{@$cm->post->title}}
            </td>
            <td>
                {{$cm->content_comment}}
            </td>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <td><a onclick="deleteComment({{ $cm->id }})" href="javascript:void(0);" style="color:#FE2E2E;"> Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>