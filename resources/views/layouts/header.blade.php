<!-- start_header -->
<div class="header" style="background-color: #343A40;  position: fixed;z-index: 10000;width: 100%;">
    <div class="container" style="padding: 0px;">
        <nav style="margin: 0;padding:0;" class="navbar navbar-expand-lg navbar-light bg-dark">
            <a style="color:white;" class="navbar-brand" href="">
                <!--                    <i style="margin-left: 15px;" class="fa fa-home"-->
                <!--                       aria-hidden="true"></i>-->
                <img src="images/cafe.JPG" width="60px" height="30px" style="border-radius: 50%; margin-left: 15px;" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i style="color: white;" class="fa fa-bars" aria-hidden="true"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li style="margin-left: 15px;" class="nav-item active">
                        <a style="color:white; font-size: 13px;font-weight: bold; " class="nav-link" href="">THỜI
                            SỰ <span class="sr-only">(current)</span></a>
                    </li>
                    <li style="margin-left: 15px;" class="nav-item active">
                        <a style="color:white;font-size: 13px;font-weight: bold;" class="nav-link" href="">KINH TẾ
                            VĨ MÔ <span class="sr-only">(current)</span></a>
                    </li>
                    <li style="margin-left: 15px;" class="nav-item active">
                        <a style="color:white;font-size: 13px;font-weight: bold;" class="nav-link" href="">KINH
                            DOANH <span class="sr-only">(current)</span></a>
                    </li>
                    <li style="margin-left: 15px;" class="nav-item active">
                        <a style="color:white;font-size: 13px;font-weight: bold;" class="nav-link" href="">CÔNG
                            NGHỆ <span class="sr-only">(current)</span></a>
                    </li>
                    <li style="margin-left: 15px;" class="nav-item active">
                        <a style="color:white;font-size: 13px;font-weight: bold;" class="nav-link" href="">SỐNG
                            <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <div class="my-2 my-lg-0">
                    @if(!isset(Auth::user()->name))
                    <a href="login"
                        style="color:white; margin-right: 10px;font-size: 12px;font-weight: bold;text-decoration: none;">ĐĂNG
                        NHẬP</a>
                    <a href="register"
                        style="color:white; margin-right: 10px;font-size: 12px;font-weight: bold;text-decoration: none;">ĐĂNG
                        KÝ</a>
                    @else
                    <i style="color:white;" class="fa fa-user" aria-hidden="true"></i>
                    <a href="user_personal/{{Auth::id()}}"
                        style="text-decoration: none;color:white; margin-right: 10px;font-size: 12px;font-weight: bold;">{{Auth::user()->name}}</a>
                    <a href="logout"
                        style="color:white; margin-right: 10px;font-size: 12px;font-weight: bold;text-decoration: none;">LOGOUT</a>
                    @endif
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- end header-->