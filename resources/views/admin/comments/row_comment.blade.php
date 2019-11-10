<tr id="comment_id_{{$cm->id}}">
    <td>
        {{@$cm->user->name}}
    </td>
    <td>
        {{$cm->post->title}}
    </td>
    <td>
        {{$cm->content_comment}}
    </td>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <td><a onclick="deleteComment({{ $cm->id }})" href="javascript:void(0);" style="color:#FE2E2E;"> Delete</a></td>
</tr>