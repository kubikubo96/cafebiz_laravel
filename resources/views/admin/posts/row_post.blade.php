<table class="table table-striped table-bordered table-hover postTable" id="sample_2">
    <thead>
        <tr>
            <th>Poster</th>
            <th>Title</th>
            <th>Title_link</th>
            <th>Content_post</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody id="posts_result">
        @foreach($post as $pt)
        <tr id="post_id_{{ $pt->id }}">
            <td>
                <div>
                    {{$pt->user->name}}
                </div>
            </td>
            <td>
                <div id="title_edit">
                    {{$pt->title}}
                </div>
                <div id="iamge_edit">
                    <img src="images/{{$pt->image}}" width="100px" height="100px" />
                </div>
            </td>
            <td id="title_link_edit">{{$pt->title_link}}</td>
            <td>
                <div id="conent_post_edit" style="overflow: auto;height: 300px; width: 550px;">
                    {!! $pt->content_post !!}
                </div>
            </td>
            <td>
                <a href="javascript:void(0);" onclick="openModalEdit({{$pt->id}})">Edit
                </a>
            </td>
            <td>
                <a href="javascript:void(0)" onclick="deletePost({{ $pt->id }})" style="color:#FE2E2E;">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>