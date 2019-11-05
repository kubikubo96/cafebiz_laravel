<!-- content-wapper -->
<div id="content-wrapper">

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="admin/posts">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Posts</li>
        </ol>
        <div class="col-md-12">
            <button type="button" style="color:white;background-color: #169ad6; border: none; margin-bottom: 10px;"
                    data-toggle="modal" data-target=".add_post">Add Post
            </button>
        </div>
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Title_link</th>
                            <th>Content_post</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Title_link</th>
                            <th>Content_post</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @if(isset($post))
                            @foreach($post as $pt)
                                <tr>
                                    <td>
                                        <div>
                                            {{$pt->title}}
                                        </div>
                                        <div>
                                            <img src="images/{{$pt->image}}" width="100px" height="100px"/>
                                        </div>
                                    </td>
                                    <td>{{$pt->title_link}}</td>
                                    <td>
                                        <div style="overflow: auto;height: 300px; width: 550px;">
                                            {!! $pt->content_post !!}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="admin/posts/edit/{{$pt->id}}">Edit</a>
                                    </td>
                                    <td>
                                        <a onclick="return confirm_delete()" href="admin/posts/delete/{{$pt->id}}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © BossVn 2019</span>
            </div>
        </div>
    </footer>

</div>
<!-- end_content-wrapper -->
