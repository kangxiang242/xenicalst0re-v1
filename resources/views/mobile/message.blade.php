@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/message.css') }}?ver={{ config('app.asset_version') }}"/>

@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.contip.js') }}"></script>
    <script src="{{ asset('static/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('static/js/api.js') }}"></script>


@stop

@section('title-before','聯絡我們')

@section('billboard-title','聯絡我們')

@section('billboard-desc','禮來致力於為我們的客戶提供資訊。若您有疑問，請聯絡我們。')

@section('content')

<section class="message-container">

    <div class="side">

        <div class="left-side">
            <div class="head">
                <p class="desc">
                    {!! app('cache.config')->get('page_lianluo_desc') !!}
                </p>
            </div>
            <div class="body">
                <form action="" method="post" onsubmit="return messageStore()" id="message-form">
                    {{ csrf_field() }}
                    <div class="form-main">
                        <div class="form-group">
                            <label>姓名：</label>
                            <input class="form-control" type="text" name="name" placeholder="請輸入你的稱呼">
                        </div>
                        <div class="form-group">
                            <label>性別：</label>
                            <div class="option">
                                <div class="checkbox">
                                    <input type="radio" class="form-radio" id="sex-0" name="sex" value="0" checked>
                                    <label class="checked-label" for="sex-0">
                                        <span class="dress"></span>
                                        <span class="text">不透露</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" class="form-radio" id="sex-1" name="sex" value="1" >
                                    <label class="checked-label" for="sex-1">
                                        <span class="dress"></span>
                                        <span class="text">先生</span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <input type="radio" class="form-radio" id="sex-2" name="sex" value="2" >
                                    <label class="checked-label" for="sex-2">
                                        <span class="dress"></span>
                                        <span class="text">女士</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>聯絡電話：</label>
                            <input class="form-control" type="text" name="phone" placeholder="請輸入聯絡你的電話號碼">
                        </div>
                        <div class="form-group">
                            <label>E-mail：</label>
                            <input class="form-control" type="text" name="email" placeholder="請輸入聯絡你的電子郵箱">
                        </div>
                        <div class="form-group">
                            <label>留言類型：</label>
                            <select class="form-control" name="type">
                                <option value="1">售前咨詢</option>
                                <option value="2">劑量咨詢</option>
                                <option value="3">修改訂單資訊</option>
                                <option value="5">意見或建議</option>
                                <option value="6">退換貨</option>
                                <option value="0" selected>其它</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>留言內容：</label>
                            <textarea class="form-control form-textarea" name="content" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="form-btn">確認送出</button>

                        </div>

                    </div>
                    <p class="protect">此頁面受到reCAPTCHA 保護<br>並適用<a href="https://policies.google.com/privacy" target="_blank">Google 隱私政策</a>及<a href="https://policies.google.com/terms" target="_blank">服務條款</a></p>
                </form>

            </div>
        </div>

        <div class="right-side">
            <div class="contact">
                <div class="group">
                    <p class="p1">Cambridge, MA</p>
                    <div class="specific">
                        <p class="p2">
                            Eli Lilly and Company
                        </p>
                        <p class="p3">
                            450 Kendall Street<br>
                            Cambridge, MA 02142
                        </p>
                    </div>
                </div>

                <div class="group">
                    <p class="p1">Indianapolis, IN</p>
                    <div class="specific">
                        <p class="p2">
                            Lilly Global Headquarters

                        </p>
                        <p class="p3">
                            Eli Lilly and Company<br>
                            Lilly Corporate Center<br>
                            Indianapolis, IN 46285<br>
                            +1-317-276-2000<br>
                        </p>
                    </div>
                    <div class="specific">
                        <p class="p2">
                            Lilly USA
                        </p>
                        <p class="p3">
                            1500 South Harding Street<br>
                            Indianapolis, IN 46221<br>
                            +1-317-433-1625
                        </p>
                    </div>
                    <div class="specific">
                        <p class="p2">
                            Lilly Technology Center
                        </p>
                        <p class="p3">
                            1200 W. Morris Street<br>
                            Indianapolis, IN 46221<br>
                            +1-317-651-7973
                        </p>
                    </div>
                </div>

                <div class="group">
                    <p class="p1">New Jersey and New York</p>
                    <div class="specific">
                        <p class="p2">
                            Lilly NJ-NY Branchburg Manufacturing Site
                        </p>
                        <p class="p3">
                            33 ImClone Drive<br>
                            Branchburg, NJ 08876
                        </p>
                    </div>

                    <div class="specific">
                        <p class="p2">
                            Lilly NJ-NY Research Center
                        </p>
                        <p class="p3">
                            Alexandria Center for Life Science<br>
                            450 East 29th Street<br>
                            12th Floor<br>
                            New York, NY 10016
                        </p>
                    </div>
                </div>

                <div class="group">
                    <p class="p1">Puerto Rico</p>
                    <div class="specific">
                        <p class="p2">
                            Lilly Puerto Rico
                        </p>
                        <p class="p3">
                            235 Federico Costa Street<br>
                            Parque Las Américas I, Suite 401<br>
                            San Juan, Puerto Rico 00918<br>
                            +1-787-753-7070
                        </p>
                    </div>

                    <div class="specific">
                        <p class="p2">
                            Lilly del Caribe, Inc.
                        </p>
                        <p class="p3">
                            400 Calle Fabril<br>
                            Carolina, Puerto Rico 00987<br>
                            +1-787-257-5555
                        </p>
                    </div>
                </div>

                <div class="group">
                    <p class="p1">San Diego, CA</p>
                    <div class="specific">
                        <p class="p2">
                            Lilly Biotechnology Center San Diego
                        </p>
                        <p class="p3">
                            10290 Campus Point Drive<br>
                            San Diego, CA 92121<br>
                            +1-858-597-4990
                        </p>
                    </div>
                </div>

                <div class="group">
                    <p class="p1">Washington, DC</p>
                    <div class="specific">
                        <p class="p2">
                            Eli Lilly and Company
                        </p>
                        <p class="p3">
                            555 Twelfth Street NW<br>
                            Suite 650 South<br>
                            Washington, DC 20004<br>
                            +1-202-434-1015
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
@endsection
