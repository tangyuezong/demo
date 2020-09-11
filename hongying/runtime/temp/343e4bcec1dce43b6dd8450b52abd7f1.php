<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/home/wwwroot/www.gdhy56.com/public/../application/index/view/index/index.html";i:1544254593;}*/ ?>
﻿<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>来钱快</title>
	<meta id="description" name="description" content="这里是网站描述" />
	<meta id="keywords" name="keywords" content="关键词,网站关键词" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=0,width=device-width" /
	><meta name="format-detection" content="telephone=no" />
	<meta name="format-detection" content="email=no" />
	<meta name="format-detection" content="address=no;" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<!--标准mui.css-->
	<link rel="stylesheet" href="/static/index/css/mui.min.css">
	<!--App自定义的css-->
	<!--<link rel="stylesheet" type="text/css" href="css/app.css"/>-->
	<style type="text/css">
		.mui-popup-input input{
			height: 32px;
		}
		#canvas{
			float:right;
			display: inline-block;
			border:1px solid #ccc;
			border-radius: 5px;
			cursor: pointer;
		}
	</style>
	<link href="/static/index/css/style.css" rel="stylesheet" type="text/css" />
	<!--<script type="text/javascript" src="/static/index/js/jquery-1.6.min.js"></script>-->
	<script type="text/javascript" src="/static/index/js/myjs.js"></script>

</head>
<body>
<form id="form1">

	<div class="banner wapper">

		<img alt="通栏图片" src="/static/index/picture/20181125133020.jpg" />

	</div>

	<div class="con1 wapper">
		<div class="c1">
			<ul>

				<li>
					<img src="/static/index/picture/20181125133812.png" alt="急速放款" /><span>急速放款</span></li>

				<li>
					<img src="/static/index/picture/20181125133804.png" alt="无需抵押" /><span>无需抵押</span></li>

				<div class="clear"></div>
			</ul>
		</div>
	</div>
	<!--<header class="mui-bar mui-bar-nav">-->
		<!--<h1 class="mui-title">一秒花  <?php if(\think\Session::get('user_mobile')): ?><span style="color: red"><<?php echo \think\Session::get('user_mobile'); ?>></span> [<a href="<?php echo url('index/Login/logout'); ?>" style="color: red">退出</a>]<?php endif; ?></h1>-->
	<!--</header>-->
	<div class="con2 wapper">
		<ul>

			<li>
				<img src="/static/index/picture/20181125134542.png" alt="三分钟放款" style="box-shadow: 0px 0px 30px 0px #ff5f62; border-radius: 20px;" /><span>三分钟放款</span></li>

			<li>
				<img src="/static/index/picture/20181125134535.png" alt="缺钱找我" style="box-shadow: 0px 0px 30px 0px #7a6df0; border-radius: 20px;" /><span>缺钱找我</span></li>

			<li>
				<img src="/static/index/picture/20181125134527.png" alt="一键贷款" style="box-shadow: 0px 0px 30px 0px #3182ed; border-radius: 20px;" /><span>一键贷款</span></li>

			<div class="clear"></div>
		</ul>
	</div>
	<div class="con3 wapper">
		<div class="c3">
			<h2>
				<img src="/static/index/picture/huo.png">今日热门</h2>
			<ul>

				<?php if(is_array($projectRes) || $projectRes instanceof \think\Collection || $projectRes instanceof \think\Paginator): $i = 0; $__LIST__ = $projectRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<li>
					
					<a href="<?php echo $vo['link_url']; ?>" title="<?php echo $vo['name']; ?>">
						
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="24%" align="center">
									<img class="img1" src="/static/uploads/<?php echo $vo['thumb']; ?>" alt="<?php echo $vo['name']; ?>" width="78" height="76" /></td>
								<td width="69%">
									<div class="c3_txt"><strong><?php echo $vo['name']; ?></strong><span></span><b>可贷额度：<em>额度<?php echo $vo['limit']; ?>    利率<?php echo $vo['dayrate']; ?>%</em></b></div>
								</td>
								<td width="7%">
									<img class="img2" src="/static/index/picture/jt.png"></td>
							</tr>
						</table>
					</a>
				</li>
				<?php endforeach; endif; else: echo "" ;endif; ?>

			</ul>
		</div>
	</div>

	<div class="footer wapper">
		<ul>
			<li>一秒花</li>
			<li><span>简单 快捷 安全</span></li>
		</ul>
	</div>

</form>


{if condition="$Think.session.user_mobile"}
<div class="mui-popup-backdrop mui-active" style="display: none" id="register_div">
	<div class="mui-popup mui-popup-in">
		<form action="" method="post" id="regform">
			<div class="mui-popup-inner">
				<div class="mui-popup-title">注册</div>
				<div class="mui-popup-text">请完善以下必填信息：</div>
				<div class="mui-popup-input"><input type="text"  name="name" autofocus="" placeholder="姓名"></div>
				<div class="mui-popup-input"><input type="password" name="password" autofocus="" placeholder="密码 "></div>
				<div class="mui-popup-input"><input type="text" name="mobile" autofocus="" maxlength="11" placeholder="手机号 "></div>
				< a href="JavaScript:;" onclick="$('#register_div').hide();$('#login_div').show();" style="margin-top: 5px;">有账号?立即登录</ a>
			</div>
			<div class="mui-popup-buttons"><span class="mui-popup-button" onclick="$('#register_div').hide();">取消</span>
				<button id="btnreg" type="button" class="mui-popup-button mui-popup-button-bold" >确定</button>
			</div>
		</form>
	</div>
</div>
<script src="/static/index/jquery.min.js"></script>
<script src="/static/index/jquery.cookie.js" type="text/javascript"></script>
<script src="/static/index/layer/layer.js"></script>
<script type="text/javascript" charset="utf-8">

    mui.init({
        swipeBack:true //启用右滑关闭功能
    });
    var slider = mui("#slider");
    slider.slider({
        interval: 3500
    });
    var registed=0;

    var show_num = [];
    draw(show_num);
    $("#canvas").on('click', function () {
        draw(show_num);
    });

    var mui_array=document.getElementsByClassName("mui-card");
    for(i=0;i<mui_array.length;i++){
        mui_array[i].addEventListener('tap', function(e) {
            url=$(this).attr('val_url');
            if(registed==0){
                $('#register_div').show();
            }else{
                $.post('index.php?act=index&op=product_click',{id:$(this).attr('val_id')},function(e){
                    location.href=url;
                },"JSON");
            }
        });
    }

    function checkMobile(){
        var mobile = jQuery.trim($('#register_mobile').val());
        mobile = mobile.replace(/\s/g, "");
        var reg = /^(1([3-9][0-9]|[5][012356789]|[4][57]|[7][0678]))\d{8}$/;
        if(mobile==""){
            mui.toast('请填写手机号');
            return false;
        }else if(!reg.test(mobile)){
            mui.toast('手机号格式不正确');
            return false;
        }else{
            return true;
        }
    }


</script>


<script>
    $('#btnreg').on('click',function () {
        var form_data=$('#regform').serialize();
        $.ajax({
            type:'post',
            url:"<?php echo url('index/Index/index'); ?>",
            data:form_data,
            success:function (data) {
                //console.log(data);
                if(data.code==1){
                    $('#register_div').hide();
                    layer.msg(data.msg);
                    location.reload();
                }else {
                    layer.msg(data.msg);

                }
            }
        });
    });
</script>

<script>
    $('#btnlogin').on('click',function () {
        var form_data=$('#loginform').serialize();
        console.log(form_data);
        $.ajax({
            type:'post',
            url:"<?php echo url('index/Login/index'); ?>",
            data:form_data,
            success:function (data) {
                //console.log(data);
                if(data.code==1){
                    $('#login_div').hide();
                    layer.msg(data.msg);
                    location.reload();
                }else {
                    layer.msg(data.msg);
                    $('#captcha').click();
                }
            }
        });
    });
</script>



</body>
</html>
