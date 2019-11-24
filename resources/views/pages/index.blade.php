@extends('layouts.master')

@section('content')
<div class="content">
    <div class="container" style="margin-top: 0px;">
        <div class="row">
            <div class="col-md-9 c1" style=" ">
                <h4 class="c2" style="">
                    <a href="detail/{{$hotnews->id}}/{{$hotnews->title_link}}.html"
                        style="text-decoration: none;color: black;"><b>{{$hotnews->title}}</b>
                    </a>
                </h4>
                <div class="row" style="margin: 0">
                    <div class="col-md-5 c3" style="padding: 0px;margin-left: 0;">
                        <p class="c5" style="">Telepro - nền tảng kết nối tư vấn viên với doanh
                            nghiệp - đã từ chối 1 triệu USD của
                            Shark Liên để nhận 300.000 USD của Shark Dzung trong tập 13 Shark Tank Việt Nam. Nhờ
                            việc Telepro nhận được đầu tư của Shark Thủy trước đó, Shark Dzung mới đồng ý giảm số cổ
                            phần hoán đổi xuống 15%, để "Shark Thủy khỏi lăn tăn, không lại bảo Shark Dzung ép Shark
                            Thủy"</p>
                    </div>
                    <div class="col-md-7 c4" style="padding: 0px">
                        <img src="images/{{$hotnews->image}}" width="94.3%" />
                    </div>
                    @foreach($hotnews2 as $ht)
                    <div class="col-md-4 c6 c61" style="">
                        <img src="images/{{$ht->image}}" width="100%" />
                        <h6><a style="color: black;text-decoration: none;"
                                href="detail/{{$ht->id}}/{{$ht->title_link}}.html">{{$ht->title}}</a></h6>
                    </div>
                    @endforeach
                    <div class="row">
                        @foreach($post as $pt)
                        <div class="col-5 c7">
                            <img src="images/{{$pt->image}}" width="100%" />
                        </div>
                        <div class="col-7 c7">
                            <h4><a style="text-decoration: none;color: #000000;"
                                    href="detail/{{$pt->id}}/{{$pt->title_link}}.html">{{$pt->title}}</a></h4>
                            <p><b>Sống</b> - 2 giờ trước</p>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="col-md-12" style="text-align: center; margin-top: 20px;">
                        {{$post->links()}}
                    </div>
                </div>
            </div>
            <div class="col-md-3 cc" style="text-align: center;">
                <img class="c9" src="images/qc1.JPG" width="80%" />
                <img class="c9" src="images/qc2.JPG" width="80%" />
                <img class="c9" src="images/qc3.JPG" width="80%" />
            </div>
        </div>
    </div>
</div>
@endsection