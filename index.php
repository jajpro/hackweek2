<?php

  ob_start();
  session_start();

  // 네이버 로그인 접근토큰 요청 예제
  $client_id = "WCE0_RqO7EjPIszSHpBe";
  $redirectURI = urlencode("http://jaj78844.cafe24.com/hackweek2/login_do.php");
  //$redirectURI = urlencode("http://jaj78844.cafe24.com/hackweek/login_do.php");
  $state = "RAMDOM_STATE";
  $apiURL = "https://nid.naver.com/oauth2.0/authorize?response_type=code&client_id=".$client_id."&redirect_uri=".$redirectURI."&state=".$state;

?>
<?php

    $db=mysqli_connect("localhost:3306","root","1234","jaj78844");
 

    $select_query = "SELECT store_id, store_name FROM store";
    $result_set = mysqli_query($db,$select_query);
    
    while($row = mysqli_fetch_assoc($result_set)){
    	//echo 'store_id : '.$row['store_id'].', '.'store_name : '.$row['store_name'].'<br>';
    }

    $count = mysqli_num_rows($result_set);
    //echo '$count : '.$count.'<br>';

    /*
    while($row = mysqli_fetch_row($result_set)){
    	print_r($row);
    	echo "<br>";
    }
	*/


    //테이블 삽입
    /*
    $insert_query = "create table person2(
name varchar(30) character set utf8 not null,
age int not null);";
    mysqli_query($db,$insert_query);
	*/
    //레코드 삽입
    /*
    $insert_query = "INSERT INTO person(name,age) VALUES('홍길동', 25)";
    mysqli_query($db,$insert_query);
	*/


?>
<html >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes"/>
<meta name="format-detection" content="telephone=no"/>
<meta http-equiv="Pragma" content="no-cache"/>
<meta http-equiv="Expires" content="0"/> 

    <title>DOT</title>   

	<link href="index_contents.css" rel="stylesheet" type="text/css">
	<!--<link href="http://s3.amazonaws.com/codecademy-content/courses/ltp2/css/bootstrap.min.css" rel="stylesheet">-->
	<script type="text/javascript" src="../jquery-3.1.1.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
	<script type="text/javascript" src="index_app.js"></script>
	<script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
	<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>


	<link href="css/bootstrap.min.css" rel="stylesheet">


    <style type="text/css">
        #layer_fixed
        {            
            width:100%;            
            position:fixed;
            z-index:999;
            bottom : 0px;
            background-color:#75A7D1;
            color:#fff;
            font-weight:bold;
            
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function () {

            var visualSlide = $('.visual_slide').bxSlider({
                mode: 'horizontal'	// 가로 방향 수평 슬라이드
				, auto: true        // 자동 실행 여부
				, speed: 800        // 이동 속도를 설정 1000 -> 1초
				, pause: 4000	// 각각의 페이지 로딩 속도 1000 -> 1초
                //, autoDelay: 0		// 페이지 로딩 후 자동스타트 딜레이 초
				, pager: false      // 현재 위치 페이징 표시 여부 설정
				, moveSlides: 1     // 슬라이드 이동시 개수
                //, slideWidth: 708   // 슬라이드 너비
				, minSlides: 1      // 최소 노출 개수
				, maxSlides: 1      // 최대 노출 개수
				, slideMargin: 0    // 슬라이드간의 간격
				, autoHover: true   // 마우스 호버시 정지 여부
				, controls: false    // 이전 다음 버튼 노출 여부
                , preventDefaultSwipeY: false
                , swipeThreshold: 100
				, onSlideBefore: function () {
				    $('.visual_circle > a').removeClass('on').eq(visualSlide.getCurrentSlide()).addClass('on');
				}
            });
            $('.visual_circle > a').click(function (e) {
                visualSlide.goToSlide($(this).index());
                e.preventDefault();
            });
            $('.visualSlide-prev-btn').on('click', function (e) {
                visualSlide.goToPrevSlide();
                e.preventDefault();
            });
            $('.visualSlide-next-btn').on('click', function (e) {
                visualSlide.goToNextSlide();
                e.preventDefault();
            });

            //mhkim
            $.ajax({
                type: "POST",
                url: "./search/popword.aspx?target=popword&collection=_ALL_&range=D",
                //url: "http://www.inha.ac.kr/search/popword/popword.jsp?target=popword&collection=_ALL_&range=D",
                dataType: "text",
                success: function (text) {
                    var appyn = document.getElementById("appyn").value;

                    text = trim(text);
                    var xml = $.parseXML(text);
                    var str = "";

                    $(xml).find("Query").each(function () {
                        str += "<li>";
                        if (appyn == 'y') {
                            str += "<span><strong>" + $(this).attr("id") + "</strong> <a href='URL:http://www.inha.ac.kr/search/search.jsp?query=" + encodeURI($(this).text(), 'UTF-8') + "'>" + $(this).text() + "</a></span>";
                        }
                        else {
                            str += "<span><strong>" + $(this).attr("id") + "</strong> <a href='http://www.inha.ac.kr/search/search.jsp?query=" + encodeURI($(this).text(),'UTF-8') + "' target='_blank'>" + $(this).text() + "</a></span>";
                        }

                        if ($(this).attr("updown") == "U") {
                            //str += "<span class='rank_up' align='right' >" + $(this).attr("count") + "</span>";
                            str += "<img src='/new/images/lank_up.gif' align='right' style='margin:2px'>";
                        } else if ($(this).attr("updown") == "D") {
                            //str += "<span class='rank_down'>" + $(this).attr("count") + "</span>";
                            str += "<img src='/new/images/lank_down.gif' align='right' style='margin:2px'>";
                        } else if ($(this).attr("updown") == "N") {
                            str += "<img src='/new/images/lank_new.gif' align='right' style='margin:2px;margin-top:3px'>";
                        } else if ($(this).attr("updown") == "C") {
                            str += "<img src='/new/images/lank_no.gif' align='right' style='margin:2px;margin-top:5px'>";
                        }

                        str += "</li>";
                    });

                    $("#popword_list").html(str);

                    var noticeTicker = $('.notice_ticker').bxSlider({
                        mode: 'vertical'	// 가로 방향 수평 슬라이드
				        , auto: true
				        , minSlides: 1      // 최소 노출 개수
				        , maxSlides: 1      // 최대 노출 개수
				        , speed: 1000        // 이동 속도를 설정 1000 -> 1초
				        , controls: false    // 이전 다음 버튼 노출 여부
				        , pager: false      // 현재 위치 페이징 표시 여부 설정
                        //				, ticker: true
                    });
                },   //end of success

                error: function (request, status, error) {
                    //alert("code:" + request.status + "\n" + "message:" + request.responseText + "\n" + "error:" + error);
                }
            }); //end of ajax

        })

        function setCookie(cname, cvalue, exdays) {
            var d = new Date();
            //d.setMinutes(d.getMinutes() + exdays);
            d.setDate(d.getDate() + exdays);
            var expires = "expires=" + d.toGMTString();
            document.cookie = cname + "=" + cvalue + "; " + expires;
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
            }
            return "";
        }


	</script>
   
</head>
<body>
    <form name="form1" method="post" action="index.aspx" id="form1">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="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" />
</div>

<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="90059987" />
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWBALo15yrBQKGpMjwCwLFnfXuCgLl0b/aC1r6vJWVHdcpG0zb3Jh7Q/30ZRth" />
</div>

    
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
  m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-78301200-1', 'auto');
    ga('send', 'pageview');

</script>
<script type="text/javascript">
    function topmenuClick() {
        var menu = document.getElementById('HeaderControl_topleftmenu_display');
        document.getElementById('HeaderControl_rightmenu_display').style.display = 'none';

        if (menu.style.display != 'none')
            menu.style.display = 'none';
        else
            menu.style.display = '';
    }

    function quickmenuClick() {
        var menu = document.getElementById('HeaderControl_rightmenu_display');
        document.getElementById('HeaderControl_topleftmenu_display').style.display = 'none';

        if (menu.style.display != 'none')
            menu.style.display = 'none';
        else
            menu.style.display = '';
    }
</script>

<div id="HeaderControl_headerouter">
    <div class="header">
        <div class="btn_menu" onclick="topmenuClick();return false;">
            <a id="btn" href="#"><img src="image/btn_menu.png" width="30" height="30"  alt="Menu" /></a>
        </div>
        <!--<h1><a id="HeaderControl_homeBtn" href="/index.aspx"><img src="/new/images/logo.png" alt="인하대학교"/></a></h1>-->
        <h1 id="HeaderControl_homeBtn"><a href="dotgame.php"><b>DOT Start!</b></a></h1>
        <div id="HeaderControl_quickMenu" class="btn_quickmenu" onclick="quickmenuClick();return false;">
            <a href="#"><img src="image/btn_quick.png" width="40" height="40" alt="Quick" /></a>
        </div>
    </div>
    <div id="HeaderControl_rightmenu_display" class="right_menu" style="display:none;">
    	<ul>
    		<li><a href="/board/board_main.aspx">메뉴1</a></li>
    		<li><a href="/new_plaza/plaza_main.aspx">메뉴2</a></li>
    		<li><a href="/portal/portal_main.aspx">메뉴3</a></li>
    		<li><a href="/mail/portalmail.aspx">메뉴4</a></li>
    	</ul>
    <div class="__web-inspector-hide-shortcut__"><a href="/smart/smart_main.aspx">사용자설정</a></div>
    </div>
    <div id="HeaderControl_topleftmenu_display" class="gnb" style="display:none;">
        <ul>
            <li><a href="/index_sub.aspx">메뉴1</a></li>
            <li><a href="/iphak/iphak_main.aspx">메뉴2</a></li>
            <li><a href="/portal/Student/jobNotice.aspx">메뉴3</a></li>
            <li><a href="/homepage/campus/FoodMenuView.aspx">메뉴4</a></li>
            <li><a href="/board/news/newsList.aspx">메뉴5</a></li>

        </ul>

    </div>
</div>

    

    <div class="top_search">
        <div class="top_conwrap">
            <div class="top_conarea">
            	<!--
                <fieldset>
                    <input name="mb_search" type="text" id="mb_search" style="background:#fff; border:0; width:70%;" />
                    <a href="javascript:complete_btn_search()"><img src="/new/images/btn_search_mb.png" align="right" alt="검색" /></a>
                    <input type="submit" name="BtnSearch" value="" id="BtnSearch" style="background-color:White;border-width:0px;height:0px;width:0px;visibility:hidden" />
                </fieldset>
				-->
				<div class="bor">
					

				<?php
  				if($_SESSION['access_token'] == null) {
  					echo '<a href="'.$apiURL.'"><img height="23" src="http://static.nid.naver.com/oauth/small_g_in.PNG"/></a>'; }
  				else {
  					echo '<p style="margin-left: 5px;">'.$_SESSION['email'].'</p>'; }
				?>


				</div>

                <div class="lank" style="background:url(/new/images/bg_lank.gif) no-repeat left center; height:13px;">
                    <ul id="popword_list" class="notice_ticker" style="width: 96%;"></ul>
                </div>
            </div>
            <div class="top_searcharea">
                
  	        </div>
        </div>
    </div>       
    
<!--
    <div class="main_visual">
        <ul id="visual_image" class="visual_slide">
<li><a href="#"><img src="/new/thumbs/upload_1484287725760_600.jpg" alt="이 주를 빛낸 인하의 얼굴들 "/></a></li>
<li><a href="/board/news/newsView.aspx?idx=5374082"><img src="/new/thumbs/upload_1484111124783_435.jpg" alt="진형준 교수 연구팀, ‘꿈의 신소재’ 그래핀 대량생산 기술 개발 "/></a></li>
<li><a href="/board/news/newsView.aspx?idx=5365830"><img src="/new/thumbs/upload_1482112591572_822.jpg" alt="인하대, 산학융합지구 조성사업 최종 선정 "/></a></li>
<li><a href="/board/news/newsView.aspx?idx=5374836"><img src="/new/thumbs/upload_1484287806969_117.png" alt="스물여섯 살 희귀암 청년의 감동 실화 통한 희망의 메시지 전달 "/></a></li>
<li><a href="/board/news/newsView.aspx?idx=5372169"><img src="/new/thumbs/upload_1483684021843_157.jpg" alt="‘2016 캠퍼스특허전략 유니버시아드’ 특허청장상 수상"/></a></li>
<li><a href="#"><img src="/new/thumbs/upload_1482394076070_228.jpg" alt="기부자 인터뷰 : 최영은 박사 (아시아다문화융합연구소) "/></a></li></ul>
	    <div id="visual_link" class="visual_circle">
<a href="#" class="on">1</a>
<a href="#">2</a>
<a href="#">3</a>
<a href="#">4</a>
<a href="#">5</a>
<a href="#">6</a></div>
    </div>
-->
    
    <div class="main_menu"><a href="dotgame.php"></a>

<!--
	 <div class="row">
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     </div>
     <div class="row">
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     </div>
     <div class="row">
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="dotgame.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     </div>
     <div class="row">
     <div class="col-xs-3"><a href="timer.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="timer.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="timer.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     <div class="col-xs-3"><a href="timer.php"><img src="image/btn_test.png" width="100" height="100"></a></div>
     </div>
-->

    </div>

    
    

    <script type="text/javascript">

        function gohome() {
            document.location.href = '/index.aspx';
        }

        function gopc() {
            document.location.href = 'http://www.inha.ac.kr/';
        }
        function logoutBtnEvent() {
            document.getElementById("FooterControl_btn_logout").click();
        }
        function goTop() {
            document.body.scrollTop = 0;
        }
        function goBottom() {
            document.body.scrollTop = document.body.scrollHeight;
        }

    </script>

  <div id="FooterControl_footerouter">
    <div class="footerf">
	    <div class="footer_btns">
            <a id="FooterControl_pcBtn" class="btn_pc" href="#"  style="margin-left: 60px; margin-top: 10px;" >PC버전</a>
            
            

        </div>
    <!--
	    <div class="footer_menub">
    	    <ul>
                <li><a href="#" target="_blank" title="새창에서 열림">개인정보처리방침</a></li>
                <li><a href="#" target="_blank" title="새창에서 열림">이메일무단수집거부</a></li>
            </ul>
	    </div>
    
	    <div class="footer_addrb" >
		    22212 인천광역시 남구 인하로 100, TEL. 032-860-7114 
            <br />FAX. 032-863-1333, 긴급전화(24시간) 032-860-9119
	    </div>
    -->
	    <div class="copy">
            <a id="FooterControl_Hyperlink1" href="#" style="margin-left: 60px;" ><font color="black">개인정보처리방침</font></a> | 
            <a id="FooterControl_Hyperlink2" href="#"><font color="black">이메일주소무단수집거부</font></a><br />
            <p style="text-align: center;">Copyright ⓒ 2015. Jang All Rights Reserved.<p>
        </div>
    </div>
    
    
    

</div>        
         
    
        
    <input type="hidden" name="appyn" id="appyn" />
    
    </form>

<script src="jquery.ui.touch-punch.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
