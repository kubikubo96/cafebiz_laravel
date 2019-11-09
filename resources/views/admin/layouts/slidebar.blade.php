<!-- sidebar -->
<ul class="sidebar navbar-nav">
    <li class="nav-item active">
        <a class="nav-link" href="admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="admin/posts">
            <i class="fas fa-fw fa-table"></i>
            <span>Posts</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="admin/users">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span></a>
    </li>
    {{--@can('root', 'user')--}}
        <li class="nav-item">
            <a class="nav-link" href="admin/roles">
                <i class="fas fa-fw fa-user-check"></i>
                <span>Roles</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="admin/permissions">
                <i class="fas fa-fw fa-key"></i>
                <span>Permissions</span>
            </a>
        </li>
    {{--@endcan--}}
</ul>
<!-- end_slidebar -->
