@extends('web.layout')
@php
    $comment_labels = $comment_labels->chunk(ceil(count($comment_labels)/1))
@endphp
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/goods.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        .g-icons{
            width: 60%;
            min-width: 340px;
            justify-content: space-between;
        }
        @media screen and (max-width: 1024px){
            .g-icons{
                width: 100%;
                min-width: 100%;
                justify-content: space-between;
            }
        }
    </style>
@stop

@section('header-class','sticky')

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.form.js') }}"></script>
    <script src="{{ asset('static/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('static/js/jquery.contip.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/lottie_svg.min.js') }}"></script>

    <script>
        function makeOrderLogs(){
            var order_log_time = parseInt(localStorage.getItem("order_log_time"))+10;
            var current_time = Date.parse(new Date())/1000;


            var swiper_html = '';
            if(order_log_time>current_time){
                swiper_html += '<div class="swiper-slide"><p class="ol"><span class="nick">'+localStorage.getItem("order_log_nickname")+'</span><span class="time">剛剛</span></p></div>';
            }
            for(var i=0;i<10;i++){
                var str = "買家09****"+getRandomNum()+"已下單<span class='quit'>"+getRandomInt(1,10)+"</span>瓶";
                var time = "剛剛";


                swiper_html += '<div class="swiper-slide"><p class="ol"><span class="nick">'+str+'</span><span class="time">'+time+'</span></p></div>';
            }
            $('#order-logs-swiper').find('.swiper-wrapper').html(swiper_html);


        }
        makeOrderLogs();
        function getRandomNum(){
            var randomNum = Math.random()

            var checkCode = randomNum*9000
            checkCode +=1000;
            return parseInt(checkCode)
        }

        function getRandomInt(min,max){
            return Math.floor(Math.random()*(max-min+1))+min;
        }

        var is_run = false;
        setInterval(function(){
            var time = getRandomInt(6,18)*1000;


            if(!is_run){
                is_run = true;

                setTimeout(function(){
                    localStorage.removeItem("order_log_time");
                    $('#order-logs-next').click();
                    is_run=false;

                },time)
            }


        },1000)


       /* var current_goods_id = "{{ $goods->id }}";
        var current_order_buy_num = getGoodsSales(current_goods_id);
        if(current_order_buy_num){
            $('#buy_num').text(current_order_buy_num);
        }

        setGoodsSales(current_goods_id,parseInt($('#buy_num').text()));


        var mySwiper = new Swiper('#order-logs-swiper', {
            autoplay: false,
            loop:true,
            simulateTouch : false,
            allowTouchMove: false,
            direction: 'vertical',
            observer: true,
            height:58,
            navigation: {
                nextEl: '#order-logs-next',
            },
            on: {
                slideChangeTransitionStart: function(swiper){
                    var str = $('#order-logs-swiper .swiper-slide').eq(this.activeIndex).find('.nick').text();

                    localStorage.setItem("order_log_nickname",str);
                    var order_buy_num = getGoodsSales(current_goods_id);
                    if(!order_buy_num){
                        order_buy_num = parseInt($('#buy_num').text());
                    }
                    var order_log_time = parseInt(localStorage.getItem("order_log_time"))+10;
                    var current_log_time = Date.parse(new Date())/1000;
                    if(!order_log_time || current_log_time>order_log_time){
                        localStorage.setItem("order_log_time",Date.parse(new Date())/1000);

                        var quit = $('#order-logs-swiper .swiper-slide').eq(this.activeIndex).find('.nick .quit').text()
                        quit = parseInt(quit)?parseInt(quit):1
                        setGoodsSales(current_goods_id,parseInt(order_buy_num)+quit);
                        $('#buy_num').text(order_buy_num+quit);
                    }
                },
            },
        })*/



    </script>

    <script>
        $(document).ready(function () {

            const page1 = $("#page1");
            const page2 = $("#page2");
            const page3 = $("#page3");
            const title1 = $("#title1");


            /*$('.page').each(function(){
                var height = $(this).find('div').outerHeight()+100;
                $(this).css('height',height+'px')
            })*/



            $("#title1").click(function () {
                $(".page").addClass("page1") .removeClass("page2 page3");

                $("#title1").addClass("title-on");
                $("#title2").removeClass("title-on");
                $("#title3").removeClass("title-on");
                $("#titlebar").removeClass("title-bar2");
                $("#titlebar").removeClass("title-bar3");

                $('.pagebox').height($('#page1').find('div').outerHeight()+100)


            });

            $("#title2").click(function () {
                $(".page").addClass("page2") .removeClass("page1 page3");

                $("#title1").removeClass("title-on");
                $("#title2").addClass("title-on");
                $("#title3").removeClass("title-on");
                $("#titlebar").addClass("title-bar2");
                $("#titlebar").removeClass("title-bar3");
                $('.pagebox').height($('#page2').find('div').outerHeight()+100)
            });

            /* $("#title3").click(function () {
                $(".page").addClass("page3") .removeClass("page1 page2");

                $("#title1").removeClass("title-on");
                $("#title2").removeClass("title-on");
                $("#title3").addClass("title-on");
                $("#titlebar").addClass("title-bar3");
                $('.pagebox').height($('#page3').find('div').outerHeight()+100)
            }); */

            page1.removeClass("active");
            title1.addClass("title-on");
        });
    </script>

    <script>
        let iconUp = document.querySelectorAll('.up');
        for (var i = 0; i < iconUp.length; i++) {
            let animationUp = bodymovin.loadAnimation({
                container: iconUp[i],
                renderer: 'svg',
                loop: false,
                autoplay: false,
                path: "/static/json/thumbUp.json"
            });

            var id = $(iconUp[i]).attr('data-id');
            var storage_key = 'comment_like_'+id;
            if(localStorage.getItem(storage_key)){
                $(iconUp[i]).attr('data-like',1);
                animationUp.setDirection(1);
                animationUp.play();
            }

            iconUp[i].addEventListener('click', (e) => {
                var _this = $(e.target).parents('.awesome');
                var id = _this.attr('data-id');
                var up = parseInt(_this.attr('data-up'));
                var storage_key = 'comment_like_'+id;
                if(_this.attr('data-like')){
                    var directionUp = -1;
                    _this.removeAttr('data-like');
                    localStorage.removeItem(storage_key);
                    up--;
                }else{
                    var directionUp = 1;
                    _this.attr('data-like',1);
                    localStorage.setItem(storage_key,1);
                    up++;

                }
                _this.attr('data-up',up)
                $.ajax({
                    url: '/api/comment/up',
                    type: 'POST',
                    data : {id:id,like:directionUp,_token:"{{ csrf_token() }}"},
                    dataType: 'json',
                });
                _this.next('.up-num').text("("+up+")")


                animationUp.setDirection(directionUp);
                animationUp.play();

            });
        }


    </script>


    <script>
        /*document.querySelector('a[href="#target"]').addEventListener('click', function(e) {
            e.preventDefault();
            const targetElement = document.querySelector('#target');
            if (targetElement) {
                const offset = -200;
                const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset;
                window.scrollTo({
                    top: targetPosition + offset,
                    behavior: 'smooth'
                });
            }
        });*/
    </script>

    <script>
        var page = 5;

        var currentPage = 1;
        var count = $('.rev').length;
        var pageNumber = Math.ceil(count/page);

        var pageLinkRender = function () {
            $('.history').append('<ul class="paging" id="paging"></ul>')
            var temp = '<li class="prev"><svg t="1695783674431" class="previcon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4168" width="200" height="200"><path d="M563.626667 490.666667L298.666667 229.376 358.186667 170.666667 682.666667 490.666667 358.186667 810.666667 298.666667 751.957333z" p-id="4169"></path></svg></li>';
            for (var i=0;i<pageNumber;i++){
                temp += '<li class="turn '+(i==0?'active':'')+'" data-page="'+(i+1)+'"><span>'+(i+1)+'</span></li>'
            }
            temp += '<li>···</li><li class="next"><svg t="1695783674431" class="nexticon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4168" width="200" height="200"><path d="M563.626667 490.666667L298.666667 229.376 358.186667 170.666667 682.666667 490.666667 358.186667 810.666667 298.666667 751.957333z" p-id="4169"></path></svg></li>';
            $('#paging').html(temp)
        }
        if(pageNumber>1){
            //pageLinkRender();
        }
        $('.rev').hide();
        var showLinkPage = function (show_page) {

            $('.rev').hide()
            var show_page = parseInt(show_page);
            for(var i=0;i<page;i++){
                var eq = i+(show_page-1)*page
                var rev = $('.rev').eq(eq);
                if(rev){
                    rev.show();
                }
            }
            currentPage = show_page;

            $("[data-page='"+show_page+"']").addClass('active').siblings().removeClass('active');


            $('#paging .prev').removeClass('disabled')
            $('#paging .next').removeClass('disabled')
            if(currentPage <= 1){
                $('#paging .prev').addClass('disabled');
            }
            if(currentPage >= pageNumber){
                $('#paging .next').addClass('disabled');
            }

        }
        showLinkPage(1);
        $('#paging .turn').click(function () {
            if(!$(this).hasClass('active')){
                var show_page = $(this).attr('data-page');
                showLinkPage(show_page);

            }
        })

        $('#paging .next').click(function () {
            let nextPage = currentPage+1;
            if(nextPage<=pageNumber){
                $('.reviews .loading').addClass('active')
                setTimeout(function () {
                    showLinkPage(nextPage)
                    $('.reviews .loading').removeClass('active')
                    $('.pagebox').height($('.comment-box').outerHeight() + 100)
                },500)

            }

        })

        $('#paging .prev').click(function () {
            let prevPage = currentPage-1;
            if(prevPage>=1){
                $('.reviews .loading').addClass('active')
                setTimeout(function () {
                    showLinkPage(prevPage)
                    $('.reviews .loading').removeClass('active')
                    $('.pagebox').height($('.comment-box').outerHeight() + 100)
                },500)
            }

        })

        $('.lord-more').click(function (){
            var nextPage = currentPage+1;
            if(nextPage<=pageNumber){
                showLinkPage(nextPage)
            }

            if(nextPage==pageNumber){
                $('.lord-more').hide();
            }

        })


    </script>

    <script>
        var _0xf5c2fc=(776869^776870)+(134623^134622);const salesSwiper=document['\u0067\u0065\u0074\u0045\u006C\u0065\u006D\u0065\u006E\u0074\u0042\u0079\u0049\u0064']("\u0073\u0061\u006C\u0065\u0073\u0053\u0077\u0069\u0070\u0065\u0072");_0xf5c2fc=(286273^286279)+(667660^667652);const height=salesSwiper['\u0063\u0068\u0069\u006C\u0064\u0072\u0065\u006E'][552857^552857]['\u006F\u0066\u0066\u0073\u0065\u0074\u0048\u0065\u0069\u0067\u0068\u0074'];var _0x6a953f=(734124^734125)+(799889^799893);let isAnimating=false;_0x6a953f=721810^721819;var _0xc71bff=(797458^797460)+(944557^944553);let counter=791031^791031;_0xc71bff="kmhakc".split("").reverse().join("");var _0x57bad=(138054^138053)+(568551^568545);const interval=276879^274999;_0x57bad='\u0064\u0061\u006E\u006B\u0062\u0065';function getRandomDelay(){return Math['\u0066\u006C\u006F\u006F\u0072'](Math['\u0072\u0061\u006E\u0064\u006F\u006D']()*((932869^946725)-(414572^423036)+(634712^634713)))+(118106^125514);}function generateRandomSalesNumber(){return Math['\u0066\u006C\u006F\u006F\u0072'](Math['\u0072\u0061\u006E\u0064\u006F\u006D']()*((450338^449733)-(160189^160217)+(397317^397316)))+(223309^223273);}function updateRandomNumber(){var _0x2af=(553831^553831)+(117377^117379);const _0x62g=Math['\u0066\u006C\u006F\u006F\u0072'](Math['\u0072\u0061\u006E\u0064\u006F\u006D']()*((545774^545206)-(197221^197621)+(731549^731548)))+(388717^389117);_0x2af=(312825^312826)+(216156^216152);document['\u0067\u0065\u0074\u0045\u006C\u0065\u006D\u0065\u006E\u0074\u0042\u0079\u0049\u0064']("rebmuNmodnar".split("").reverse().join(""))['\u0069\u006E\u006E\u0065\u0072\u0054\u0065\u0078\u0074']=_0x62g;}function updateNextSalesNumber(_0xcb5fb){const _0xccd90b=salesSwiper['\u0063\u0068\u0069\u006C\u0064\u0072\u0065\u006E'][617118^617119];_0xcb5fb=691799^691794;if(_0xccd90b){const _0x392db=_0xccd90b['\u0071\u0075\u0065\u0072\u0079\u0053\u0065\u006C\u0065\u0063\u0074\u006F\u0072']("\u0023\u0073\u0061\u006C\u0065\u0073\u004E\u0075\u006D\u0062\u0065\u0072");if(_0x392db){_0x392db['\u0069\u006E\u006E\u0065\u0072\u0054\u0065\u0078\u0074']=generateRandomSalesNumber();}}}function startSwiper(){setInterval(()=>{if(isAnimating)return;isAnimating=!![];let _0x3e481a;const _0x7d524d=counter%(276148^276150)===(345397^345397)?getRandomDelay():interval;_0x3e481a=(232623^232622)+(813358^813358);setTimeout(()=>{updateNextSalesNumber();updateRandomNumber();salesSwiper['\u0073\u0074\u0079\u006C\u0065']['\u0074\u0072\u0061\u006E\u0073\u0069\u0074\u0069\u006F\u006E']="\u0074\u0072\u0061\u006E\u0073\u0066\u006F\u0072\u006D\u0020\u0031\u0073\u0020\u0063\u0075\u0062\u0069\u0063\u002D\u0062\u0065\u007A\u0069\u0065\u0072\u0028\u0030\u002E\u0035\u002C\u0020\u0030\u002C\u0020\u0030\u002C\u0020\u0031\u0029";salesSwiper['\u0073\u0074\u0079\u006C\u0065']['\u0074\u0072\u0061\u006E\u0073\u0066\u006F\u0072\u006D']=`translateY(-${height}px)`;setTimeout(()=>{salesSwiper['\u0073\u0074\u0079\u006C\u0065']['\u0074\u0072\u0061\u006E\u0073\u0069\u0074\u0069\u006F\u006E']="enon".split("").reverse().join("");salesSwiper['\u0061\u0070\u0070\u0065\u006E\u0064\u0043\u0068\u0069\u006C\u0064'](salesSwiper['\u0063\u0068\u0069\u006C\u0064\u0072\u0065\u006E'][676885^676885]);salesSwiper['\u0073\u0074\u0079\u006C\u0065']['\u0074\u0072\u0061\u006E\u0073\u0066\u006F\u0072\u006D']=`translateY(0)`;setTimeout(()=>{salesSwiper['\u0073\u0074\u0079\u006C\u0065']['\u0074\u0072\u0061\u006E\u0073\u0069\u0074\u0069\u006F\u006E']=")1 ,0 ,0 ,5.0(reizeb-cibuc s1 mrofsnart".split("").reverse().join("");isAnimating=false;},850445^850495);},601523^601691);},_0x7d524d);counter++;},interval);}startSwiper();updateRandomNumber();var randomInterval=Math['\u0066\u006C\u006F\u006F\u0072'](Math['\u0072\u0061\u006E\u0064\u006F\u006D']()*((141859^141868)-(463973^463983)+(507705^507704)))+(728872^728866);setInterval(updateRandomNumber,randomInterval*(402570^403298));
    </script>
    <script>
        function updateCountdown(_0x_0xcaa,_0x70afdf,_0xc_0x552){var _0xc1eb=new Date();_0x_0xcaa=883901^883900;_0xc1eb['\u0073\u0065\u0074\u0048\u006F\u0075\u0072\u0073'](305964^305981,793167^793167,531621^531621,879606^879606);var _0xd6dcfa=_0xc1eb['\u0067\u0065\u0074\u0054\u0069\u006D\u0065']();_0x70afdf=(189133^189130)+(866904^866905);const _0xd2f=document['\u0067\u0065\u0074\u0045\u006C\u0065\u006D\u0065\u006E\u0074\u0042\u0079\u0049\u0064']("pmatsemiTtegrat".split("").reverse().join(""));const _0xga1dbc=new Date()['\u0067\u0065\u0074\u0054\u0069\u006D\u0065']();let _0x1df=_0xd6dcfa-_0xga1dbc;if(_0x1df<=(370030^370030)){_0xc1eb['\u0073\u0065\u0074\u0044\u0061\u0074\u0065'](_0xc1eb['\u0067\u0065\u0074\u0044\u0061\u0074\u0065']()+(205755^205754));_0xd6dcfa=_0xc1eb['\u0067\u0065\u0074\u0054\u0069\u006D\u0065']();_0x1df=_0xd6dcfa-_0xga1dbc;}var _0xgca=(255338^255330)+(453395^453397);const _0x37a1d=String(Math['\u0066\u006C\u006F\u006F\u0072'](_0x1df%((355351^356351)*(104192^104252)*(809280^809340)*(366631^366655))/((572124^571700)*(112367^112339)*(956757^956777))))['\u0070\u0061\u0064\u0053\u0074\u0061\u0072\u0074'](569433^569435,"\u0030");_0xgca=(960446^960440)+(377283^377282);const _0xa49bab=String(Math['\u0066\u006C\u006F\u006F\u0072'](_0x1df%((644784^644440)*(720254^720194)*(498817^498877))/((962151^961935)*(779712^779772))))['\u0070\u0061\u0064\u0053\u0074\u0061\u0072\u0074'](168025^168027,"\u0030");_0xc_0x552='\u0067\u0069\u0068\u0064\u006F\u0066';const _0x7bf6ce=String(Math['\u0066\u006C\u006F\u006F\u0072'](_0x1df%((393289^394145)*(574360^574372))/(988755^988603)))['\u0070\u0061\u0064\u0053\u0074\u0061\u0072\u0074'](950700^950702,"\u0030");let _0x2f9b=String(Math['\u0066\u006C\u006F\u006F\u0072'](_0x1df%(439865^439761)));_0x2f9b=_0x2f9b['\u0073\u006C\u0069\u0063\u0065'](630565^630565,_0x2f9b['\u006C\u0065\u006E\u0067\u0074\u0068']-(531965^531964));_0xd2f['\u0069\u006E\u006E\u0065\u0072\u0048\u0054\u004D\u004C']=`${_0x37a1d}:${_0xa49bab}:${_0x7bf6ce}:${_0x2f9b}`;setTimeout(updateCountdown,676042^676032);}updateCountdown();

        function getRandomNumber(){return Math['\u0066\u006C\u006F\u006F\u0072'](Math['\u0072\u0061\u006E\u0064\u006F\u006D']()*((858563^855731)-(782525^786205)+(812258^812259)))+(572746^570090);}function updateRandomNumber(){var _0x55e2d=(171796^171794)+(868471^868464);var _0xcc83d=Date['\u006E\u006F\u0077']();_0x55e2d="ffoagc".split("").reverse().join("");var _0x88f12g=localStorage['\u0067\u0065\u0074\u0049\u0074\u0065\u006D']("\u006C\u0061\u0073\u0074\u0055\u0070\u0064\u0061\u0074\u0065\u0054\u0069\u006D\u0065");var _0x125a6a=localStorage['\u0067\u0065\u0074\u0049\u0074\u0065\u006D']("\u0074\u006F\u0074\u0061\u006C\u0073\u0061\u006C\u0065");var _0x9f3abd=(522396^522384)*(255750^255802)*(187159^187179)*(797165^797189);if(!_0x88f12g||_0xcc83d-_0x88f12g>=_0x9f3abd){var _0x57agea=getRandomNumber();localStorage['\u0073\u0065\u0074\u0049\u0074\u0065\u006D']("elaslatot".split("").reverse().join(""),_0x57agea);localStorage['\u0073\u0065\u0074\u0049\u0074\u0065\u006D']("\u006C\u0061\u0073\u0074\u0055\u0070\u0064\u0061\u0074\u0065\u0054\u0069\u006D\u0065",_0xcc83d);_0x125a6a=_0x57agea;}document['\u0067\u0065\u0074\u0045\u006C\u0065\u006D\u0065\u006E\u0074\u0042\u0079\u0049\u0064']("\u0074\u006F\u0074\u0061\u006C\u0073\u0061\u006C\u0065")['\u0069\u006E\u006E\u0065\u0072\u0054\u0065\u0078\u0074']=_0x125a6a;}updateRandomNumber();setInterval(updateRandomNumber,(938559^938547)*(379617^379613)*(305242^305254)*(658309^657517));
    </script>
@stop

@section('content')


    <div class="container no-curtain">

        <div class="main">
            <div class="wrap">
                <div class="goods-body">

                    <div class="goods">

                        <div class="img-wrap">
                            <img src="{{ asset_upload($goods->img) }}" alt="{{ str_replace("<br />"," ",$goods->name) }}">
                        </div>
                        <div class="info-wrap">
                            <h1 class="name">{{ str_replace("<br />"," ",$goods->name) }}</h1>
                            {{--<p class="privacy">{!! str_replace(PHP_EOL,"<br>",app('cache.config')->get('privacy_text')) !!}</p>--}}
                            <div class="sales-sec"> 
                                <p class="sales-week">近七天已售<span id="totalsale"></span>盒</p>
                                <div class="order-views">
                                    <div class="sales-swiper" id="salesSwiper">
                                        <p class="viewtext"><svg t="1740988716160" class="viewicon" viewBox="0 0 1448 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="44856" width="200" height="200"><path d="M430.452 596.128c65.924 0.328 125.617-39.358 150.872-100.363 25.255-61.005 11.48-130.865-35.094-177.767-46.574-46.574-116.762-60.677-177.767-35.422-61.005 25.255-100.69 84.62-100.69 150.544 0 89.867 72.811 163.008 162.679 163.008z m762.56 118.73c-30.83-36.735-70.516-65.27-115.45-82.652-68.22-25.583-141.032-37.718-213.845-36.078-72.812-1.968-145.624 10.167-213.845 36.078-44.933 17.383-84.62 45.917-115.45 82.651-29.518 35.423-47.23 79.7-49.853 125.618 0 44.934 36.406 81.34 81.34 81.34h595.617c44.934 0 81.34-36.406 81.34-81.34-2.296-45.918-20.007-90.195-49.854-125.618zM864.045 542.01c87.9 0.328 167.272-52.477 201.054-133.817 33.782-81.011 15.415-174.815-46.902-236.803-61.988-62.317-155.464-81.012-236.803-47.23-81.34 33.454-134.145 112.826-134.145 200.726 0 119.386 96.755 216.796 216.796 217.124z m-343.07 131.194c12.135-25.255-10.823-27.879-25.583-28.535-9.183-0.656-205.973-11.151-300.104 98.395-23.287 27.223-36.078 61.989-36.078 97.739 0 44.934 36.406 81.34 81.34 81.34h183.998c26.567 0 32.47-13.12 27.223-27.223-42.31-111.514 68.22-219.093 69.204-221.716z" p-id="44857"></path></svg><span id="randomNumber"></span>&nbsp;名訪客正在瀏覽</p>
                                        <p class="sales-now">感恩末三碼09*****<span id="salesNumber">999</span>顧客已訂購&nbsp;&nbsp;剛剛</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ensures">
                                <div class="icons">
                                    <p class="ioc"><svg t="1740985236469" class="salesicon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7769" width="200" height="200"><path d="M512 0a512 512 0 1 0 512 512 512 512 0 0 0-512-512z m171.885714 739.474286a55.588571 55.588571 0 0 1-40.228571 16.822857 53.394286 53.394286 0 0 1-39.497143-16.822857l-146.285714-142.628572a59.245714 59.245714 0 0 1-16.822857-40.228571V275.748571a57.051429 57.051429 0 0 1 113.371428 0v257.462858L683.885714 658.285714a56.32 56.32 0 0 1 0 81.188572z" p-id="7770"></path></svg><span>當天發貨</span></p>
                                    <p class="ico-sub">距當天17:00發貨還有 <span id="targetTimestamp" style="display: inline-block; text-align: left; width: 60px; margin-left: 2px;">10:20:31:9</span></p>
                                </div>
                                <div class="icons">
                                    <p class="ioc"><svg t="1740985282332" class="salesicon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="10685" width="200" height="200"><path d="M25.208829 336.71419v659.614465c0.86337 15.540655 14.677285 28.491201 30.21794 27.627831h906.538204c15.540655 0.86337 29.35457-11.223806 30.21794-27.627831V336.71419H25.208829z m590.544887 309.949729l-216.705799 267.644613 73.386426-188.214599h-81.156754l82.020123-221.886017h151.089701L525.963265 646.663919h89.790451zM478.477931 6.906958v275.41494H25.208829L131.403304 41.441746c10.360437-21.584243 31.94468-35.398158 56.119032-34.534788h290.955595zM830.732776 6.906958c24.174352-0.86337 45.758595 12.950546 56.119032 34.534788L992.182913 282.321898H538.913811V6.906958h291.818965z" p-id="10686"></path></svg><span>現貨速達</span></p>
                                    <p class="ico-sub">官方配送預計&nbsp;{{ date('n月j日',strtotime('+2 day')) }}～{{ date('n月j日',strtotime('+3 day')) }}&nbsp;可送達</p>
                                </div>
                                <div class="icons">
                                    <p class="ioc"><svg t="1740985536511" class="salesicon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="33474" width="200" height="200"><path d="M379.75365 1023.999451a169.343819 169.343819 0 0 1-29.257111-2.468568 163.583825 163.583825 0 0 1-102.290176-65.590787 463.140075 463.140075 0 0 1-57.234225-104.813602 296.228254 296.228254 0 0 1-143.176989-80.255914A164.717538 164.717538 0 0 1 6.341479 625.18845a243.602025 243.602025 0 0 1 21.942834-62.335933 384.182446 384.182446 0 0 0 17.11541-41.654813 268.415712 268.415712 0 0 0-19.913122-51.035373 237.604317 237.604317 0 0 1-23.771403-67.419357 161.188399 161.188399 0 0 1 9.508562-82.377054 169.800961 169.800961 0 0 1 42.422811-59.721079 400.456714 400.456714 0 0 1 119.497015-69.906211 279.953986 279.953986 0 0 1 70.948495-133.741571A176.822668 176.822668 0 0 1 370.555946 4.169687a208.109491 208.109491 0 0 1 36.004533 3.236568 261.028292 261.028292 0 0 1 49.170233 13.988556 140.580421 140.580421 0 0 1 16.932553 8.612563 97.298181 97.298181 0 0 0 28.178256 12.324558 19.455979 19.455979 0 0 0 2.779425 0.365714c0.877713 0 1.828569 0.109714 2.724569 0.109714a182.984947 182.984947 0 0 0 61.513077-21.083406 223.981474 223.981474 0 0 1 53.796513-20.114264 200.3015 200.3015 0 0 1 25.179402-1.645713 164.717538 164.717538 0 0 1 28.543969 2.431998 167.643249 167.643249 0 0 1 104.22846 67.27307 500.753749 500.753749 0 0 1 57.307367 101.394177 286.957407 286.957407 0 0 1 142.280991 81.023914 171.190674 171.190674 0 0 1 42.349669 144.895844 261.832862 261.832862 0 0 1-23.222833 68.333641c-5.796565 12.927986-11.775987 26.294829-16.621696 40.703957a355.949333 355.949333 0 0 0 19.108551 52.022801 190.902653 190.902653 0 0 1 21.57712 112.347308c-13.659414 92.653615-81.645627 124.818152-147.400985 155.940405-7.058278 3.327996-14.262842 6.747421-21.229692 10.14856a299.647679 299.647679 0 0 1-69.906211 131.382717 167.094678 167.094678 0 0 1-123.20901 53.394228 197.320931 197.320931 0 0 1-29.915397-2.340569l-3.529139-0.621713a259.12658 259.12658 0 0 1-64.127931-22.326834 413.786985 413.786985 0 0 0-41.307385-16.877696 270.628281 270.628281 0 0 0-53.577085 21.083406 201.36207 201.36207 0 0 1-65.02393 22.454833 206.811207 206.811207 0 0 1-23.40569 1.371427z m294.070542-508.342312a116.297018 116.297018 0 0 0-88.155334 34.87082 132.059287 132.059287 0 0 0-33.023964 94.299327 120.137014 120.137014 0 0 0 31.085681 86.674193 109.019312 109.019312 0 0 0 81.865055 32.201108 115.199877 115.199877 0 0 0 87.66162-34.870819 131.529002 131.529002 0 0 0 32.914251-93.641043 123.995296 123.995296 0 0 0-29.549683-88.319905 108.854741 108.854741 0 0 0-82.797626-31.213681zM634.985377 280.887105L325.499994 757.06488h81.042199l310.125382-476.177775zM377.303367 274.285969a116.242161 116.242161 0 0 0-88.155334 34.852534A132.13243 132.13243 0 0 0 256.105783 403.456116a120.118728 120.118728 0 0 0 31.085681 86.655907 108.964455 108.964455 0 0 0 81.865055 32.201109 115.803304 115.803304 0 0 0 87.643335-34.523392 130.30386 130.30386 0 0 0 32.91425-93.257043 124.818152 124.818152 0 0 0-29.714254-88.667333A108.379312 108.379312 0 0 0 377.303367 274.285969z m292.205401 431.01211c-31.085681 0-46.811378-21.44912-46.811378-63.762218a87.442192 87.442192 0 0 1 12.031987-50.559946 41.636527 41.636527 0 0 1 36.114247-16.841124 39.6251 39.6251 0 0 1 33.188536 16.932553 79.030772 79.030772 0 0 1 12.617129 47.817091 86.564479 86.564479 0 0 1-11.794273 49.810233 40.685671 40.685671 0 0 1-35.327962 16.603411z m-296.520825-241.37117c-30.628539 0-46.153093-21.44912-46.153093-63.762218a86.966764 86.966764 0 0 1 12.123416-50.559946 42.057098 42.057098 0 0 1 36.370246-16.841124c29.750825 0 44.836523 21.778262 44.836524 64.749645a86.564479 86.564479 0 0 1-11.794273 49.810232 40.685671 40.685671 0 0 1-35.38282 16.566839z" p-id="33475"></path></svg><span>官網福利</span></p>
                                    <p class="ico-sub">官網折扣優惠&四盒以上免運優惠</p>
                                </div>
                                <div class="icons">
                                    <p class="ioc"><svg t="1740986070832" class="salesicon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="42986" width="200" height="200"><path d="M933.376 145.408l-24.576-0.512c-1.024 0-98.816-2.048-199.68-41.984-103.424-40.96-170.496-88.064-171.008-88.576L523.264 3.584c-3.072-2.56-7.168-3.584-11.264-3.584-4.096 0-8.192 1.536-11.264 3.584l-14.848 10.24c-1.024 0.512-67.584 47.616-170.496 88.576-100.864 39.936-198.656 41.984-199.68 41.984l-25.088 0.512c-10.752 0.512-18.944 8.192-18.944 18.432v414.208c0 217.088 286.208 446.464 440.32 446.464s440.32-229.376 440.32-445.952V163.84c0-10.24-8.704-18.432-18.944-18.432z m-189.952 265.728l-260.608 260.608c-15.872 15.872-41.984 15.872-57.856 0l-144.896-144.896c-15.872-15.872-15.872-41.984 0-57.856 8.192-8.192 18.432-11.776 29.184-11.776 10.24 0 20.992 4.096 29.184 11.776l115.712 115.712L686.08 352.768c15.872-15.872 41.984-15.872 57.856 0 15.36 16.384 15.36 42.496-0.512 58.368z" p-id="42987"></path></svg><span>安全訂購</span></p>
                                    <p class="ico-sub">安全支付&隱密發貨，加密保護訂購訊息</p>
                                </div>
                            </div>
                            <div class="foot">
                                <p class="price">
                                    <span class="now">NT${{ number_format(intval($goods->price)) }}</span>
                                    <span class="market">NT${{ number_format(intval($goods->market_price)) }}</span>
                                </p>
                                <a class="go-btn" href="{{ url('shopping/'.$goods->id) }}" data-observer="點擊購買-{{ $goods->name }}">點擊購買</a>
                            </div>
                            <div class="spec">
                                <div class="spec-item"><p class="head">藥品規格</p><p class="desc">{{ app('cache.config')->get('product_spec') }}</p></div>
                                <div class="spec-item"><p class="head">主要成分</p><p class="desc">{{ app('cache.config')->get('product_component') }}</p></div>
                                <div class="spec-item"><p class="head">生産廠家</p><p class="desc">{{ app('cache.config')->get('product_manufacturer') }}</p></div>
                                <div class="spec-item"><p class="head">適應症</p><p class="desc">{{ app('cache.config')->get('product_indication') }}</p></div>
                                <div class="spec-item"><p class="head">貯藏</p><p class="desc">{{ app('cache.config')->get('product_storage') }}</p></div>
                                <div class="spec-item"><p class="head">有效期</p><p class="desc">{{ app('cache.config')->get('product_valid') }}</p></div>
                            </div>
                            <div class="privacy">
                                <ul class="g-icons">

                                    <li>
                                        <p class="p1"><i class="iconfont">&#xeb67;</i></p>
                                        <p class="p2">官方正品</p>
                                    </li>

                                    <li>
                                        <p class="p1"><i class="iconfont">&#xebb9;</i></p>
                                        <p class="p2">隱密包裝</p>
                                    </li>

                                    <li>
                                        <p class="p1"><i class="iconfont">&#xe60f;</i></p>
                                        <p class="p2">當天出貨</p>
                                    </li>

                                </ul>

                                <ul class="g-icons">



                                    <li>
                                        <p class="p1"><i class="iconfont">&#xe63f;</i></p>
                                        <p class="p2">鄉民推薦</p>
                                    </li>

                                    <li>
                                        <p class="p1"><i class="iconfont">&#xe624;</i></p>
                                        <p class="p2">免費換貨</p>
                                    </li>

                                    <li>
                                        <p class="p1"><i class="iconfont">&#xe88c;</i></p>
                                        <p class="p2">安全結賬</p>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="info-page">
                        <div class="title-box" id="titlebar">
                            <p class="title" id="title1">詳情介紹</p>
                            <p class="title" id="title2">付款與售後</p>
                            <!-- <p class="title" id="title3"></p> -->
                        </div>
                        <div class="pagebox">
                            <div class="page" id="page1">
                                <div class="content">
                                    <div class="desc-images">
                                        @php
                                            $product_present_images = json_decode(app('cache.config')->get('product_present_images'),true);
                                        @endphp
                                        @if($product_present_images)
                                            @foreach($product_present_images as $image)
                                                <img src="{{ asset_upload(array_get($image,'img')) }}" alt="{{ array_get($image,'img_alt') }}">
                                            @endforeach
                                        @endif

                                    </div>
                                    <div class="desc-info">
                                        @php
                                            $product_present_texts = json_decode(app('cache.config')->get('product_present_texts'),true);
                                        @endphp
                                        @if($product_present_texts)
                                            @foreach($product_present_texts as $text)
                                                <div class="info-item">
                                                    <div class="info-item-header"><span>{{ array_get($text,'title') }}</span></div>
                                                    <div class="info-item-desc">

                                                        <p>{!! str_replace(PHP_EOL,"<br>",array_get($text,'content')) !!}</p>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>

                            </div>
                            {{--<div class="page" id="page2">
                                
                                <div class="comment-box" id="target">

                                <div class="comment">
                                    <div class="widg">
                                        <div class="amount-wrap">
                                            @php
                                                $commentGroup = $comment->groupBy('star');
                                                $star_5 = $commentGroup->get(5)?$commentGroup->get(5)->count():0;
                                                $star_4 = $commentGroup->get(4)?$commentGroup->get(4)->count():0;
                                                $star_3 = $commentGroup->get(3)?$commentGroup->get(3)->count():0;
                                                $star_2 = $commentGroup->get(2)?$commentGroup->get(2)->count():0;
                                                $star_1 = $commentGroup->get(1)?$commentGroup->get(1)->count():0;

                                                $count_comment = count($comment);

                                                $f_count_comment = $comment->count();

                                                $star_rate_5 = $count_comment?number_format($star_5/$count_comment,2)*100:0;
                                                $star_num_5 = intval(round($f_count_comment*($star_rate_5/100),0));

                                                $star_rate_4 = $count_comment?number_format($star_4/$count_comment,2)*100:0;
                                                $star_num_4 = intval(round($f_count_comment*($star_rate_4/100),0));

                                                $star_rate_3 = $count_comment?number_format($star_3/$count_comment,2)*100:0;
                                                $star_num_3 = intval(round($f_count_comment*($star_rate_3/100),0));

                                                $star_rate_2 = $count_comment?number_format($star_2/$count_comment,2)*100:0;
                                                $star_num_2 = intval(round($f_count_comment*($star_rate_2/100),0));

                                                $star_rate_1 = $count_comment?number_format($star_1/$count_comment,2)*100:0;
                                                $star_num_1 = intval(round($f_count_comment*($star_rate_1/100),0));

                                            @endphp
                                            <div class="total-box">

                                            
                                                <div class="total">
                                                    <!-- <p class="score-desc">買家平均評價</p> -->
                                                    <p class="score">4.{{ rand(5,9) }}</p>
                                                    <div class="stars">
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a1;</i>
                                                        <i class="iconfont">&#xe9a3;</i>
                                                    </div>
                                                    <!-- <p class="text">共{{ $f_count_comment }}則評價</p> -->
                                                    <p class="text">共10536則評價</p>
                                                </div>
                                                <div class="histogram">
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: 78%"></span></div>
                                                        <div class="percentage">78%</div>
                                                        <div class="frequency">(8218)</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: 22%"></span></div>
                                                        <div class="percentage">22%</div>
                                                        <div class="frequency">(2408)</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: {{ $count_comment?number_format($star_3/$count_comment,2)*100:0 }}%"></span></div>
                                                        <div class="percentage">{{ $star_rate_3 }}%</div>
                                                        <div class="frequency">({{ $star_num_3 }})</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: {{ $count_comment?number_format($star_2/$count_comment,2)*100:0 }}%"></span></div>
                                                        <div class="percentage">{{ $star_rate_2 }}%</div>
                                                        <div class="frequency">({{ $star_num_2 }})</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="stars">
                                                            <i class="iconfont">&#xe9a1;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                            <i class="iconfont">&#xe9a2;</i>
                                                        </div>
                                                        <div class="bar"><span class="progress" style="width: {{ $count_comment?number_format($star_1/$count_comment,2)*100:0 }}%"></span></div>
                                                        <div class="percentage">{{ $star_rate_1 }}%</div>
                                                        <div class="frequency">({{ $star_num_1 }})</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="label-sec">
                                                @foreach($comment_labels as $chunk)
                                                    <div class="label-box">
                                                        @foreach($chunk as $item)
                                                            <div class="label">{{ $item->name }}</div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- <div class="write-wrap">
                                                <form id="comment-form" action="{{ url('/comment/'.$goods->cate_id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <div class="group-one">

                                                        <div class="form-group">
                                                            <p class="lab">您的訂單編號</p>
                                                            <input class="form-control" name="number" required type="tel">
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <p class="lab">對本次購物評分</p>
                                                        <div class="stars hover pointer">
                                                            <i class="iconfont" title="1 Star" data-star="1">&#xe9a1;</i>
                                                            <i class="iconfont" title="2 Star" data-star="2">&#xe9a1;</i>
                                                            <i class="iconfont" title="3 Star" data-star="3">&#xe9a1;</i>
                                                            <i class="iconfont" title="4 Star" data-star="4">&#xe9a1;</i>
                                                            <i class="iconfont" title="5 Star" data-star="5">&#xe9a1;</i>
                                                        </div>
                                                        <input type="hidden" name="star" value="5">
                                                    </div>

                                                    <div class="form-group">
                                                        <p class="lab">評價內容</p>
                                                        <textarea class="form-control" required name="content" ></textarea>
                                                    </div>

                                                    <button class="submit-btn">提交評價</button>
                                                </form>
                                            </div>

                                            <div class="actions">
                                                <a class="write-btn" href="javascript:;">
                                                    <span>我要評價</span>

                                                    <svg t="1698290425926" class="writeicon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="21246" width="200" height="200"><path d="M172.397714 709.339429h124.269715l432.493714-432.493715-124.342857-124.342857L172.470857 585.142857v124.269714z m144.091429 96.109714H124.342857a48.054857 48.054857 0 0 1-48.054857-48.054857V565.174857c0-12.726857 5.046857-24.941714 14.043429-34.011428l480.548571-480.548572a48.054857 48.054857 0 0 1 67.949714 0l192.219429 192.219429a48.054857 48.054857 0 0 1 0 68.022857l-480.548572 480.548571a48.054857 48.054857 0 0 1-33.938285 14.043429z m586.313143 192.219428H121.197714a48.054857 48.054857 0 1 1 0-96.109714h781.604572a48.054857 48.054857 0 1 1 0 96.109714z" fill="" p-id="21247"></path></svg>

                                                </a>
                                            </div> -->
                                        </div>


                                    </div>

                                    <div class="history">
                                        <div class="info-item-header">
                                            <span>最新買家評價</span>
                                        </div>
                                        <!-- <div class="label-sec">
                                            @foreach($comment_labels as $chunk)
                                                <div class="label-loop">
                                                    @for($i=0;$i<2;$i++)
                                                        <div class="label-box">
                                                            @foreach($chunk as $item)
                                                                <div class="label">{{ $item->name }}</div>
                                                            @endforeach
                                                        </div>
                                                    @endfor
                                                </div>
                                            @endforeach
                                        </div> -->
                                        <div class="reviews">

                                            @foreach($comment as $item)
                                                <div class="rev">
                                                    <div class="name-box">
                                                        <div class="">

                                                        
                                                            <p class="nickname">
                                                                <span>買家09****{{ substr($item->phone,-4) }}</span>
                                                                <!-- @if($item->total_number == 1 || $item->total_number >= 4)
                                                                <span class="{{ $item->total_number==1?"new":"fans" }}">{{ $item->total_number==1?"首購返評":"瘦身達人" }}</span>
                                                                @endif -->
                                                            </p>
                                                            <div class="star-box">
                                                                <div class="stars">
                                                                    @for($i=1;$i<=5;$i++)
                                                                        <i class="iconfont">{{ $i<=$item->star?"&#xe9a1;":"&#xe9a2;" }}</i>
                                                                    @endfor
                                                                </div>
                                                                @if($item->time)<p class="date">{{ $item->time->format('Y/m/d') }}</p>@endif
                                                            </div>
                                                        </div>
                                                        <p class="today">{{ $item->time_at }}</p>
                                                    </div>

                                                    <!-- <p class="buy-text">本次已購 <span>{{ $item->current_purchase }}</span></p> -->

                                                    <p class="content" style="padding: 0;">
                                                        {{ $item->content }}
                                                    </p>
                                                    @if($item->comment_image)
                                                    <img class="content-pic" src="{{ asset_upload($item->comment_image) }}">
                                                    @endif
                                                    <div class="like-box">
                                                        <!-- <p class="doyou">這則評價對您有幫助嗎？</p> -->
                                                        <div class="up awesome" data-id="{{ $item->id }}" data-up="{{ $item->up }}"></div>
                                                        <span class="up-num">({{ $item->up }})</span>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <div class="loading" ><img src="/static/img/loading.svg" alt="loading"></div>
                                        </div>

                                        <div class="switch" id="paging">
                                            <a class="prev" id="comment-prev" href="javascript:;">上一頁</a>
                                            <a class="next" id="comment-next" href="javascript:;">下一頁</a>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                            --}}
                                
                            <div class="page" id="page2">
                                <div style="padding: 30px 15px;">
                                    {!! app('cache.config')->get('goods_payment2') !!}
                                </div>

                            </div>
                        </div>
                        
                    </div>

                </div>
            </div>



        </div>
    </div>




@endsection
