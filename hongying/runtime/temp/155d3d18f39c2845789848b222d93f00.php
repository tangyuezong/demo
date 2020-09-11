<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:59:"/home/wwwroot/www.gdhy56.com/thinkphp/tpl/dispatch_jump.tpl";i:1543588498;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <link rel="stylesheet" href="/admin/pintuer.css">
    <title>系统提示</title>
    <style type="text/css">
        *{ margin:0px; padding:0px;}
        /*边框颜色*/
        .error-container{ background:#fff; border:1px solid #054187;  text-align:center; width:450px; margin:250px auto; font-family:Microsoft Yahei; padding-bottom:30px; border-top-left-radius:5px; border-top-right-radius:5px;  }
        /*头部颜色*/
        .error-container h1{ font-size:16px; padding:10px 0; background: #054187; color:#fff;}
        /*提示文字颜色*/
        .errorcon{ padding:35px 0; text-align:center; color: #008000; font-size:20px;font-weight:bold}
        .errorcon i{ display:block; margin:12px auto; font-size:30px; }
        .errorcon span{color:red;}
        h4{ font-size:14px; color:#666;}
        /*跳转这两个字*/
        a{color:#0ae;}
    </style>
</head>
<body>
<body class="no-skin">
<div class="error-container">
    <h1> 系统提示信息 </h1> 
    <div class="errorcon">
        <?php if(isset($message)) {?>
        <!-- <i class="icon-smile-o"></i>  -->
        <p class="success"><?php echo(strip_tags($msg)); ?></p>
        <?php }else{?>
        <!-- <i class="icon-frown-o"></i> -->
        <p class="error"><?php echo(strip_tags($msg)); ?></p>
        <?php }?>
        <p class="detail"></p>
    </div>
    <p class="jump">
        页面自动 <a id="href" class="href" href="<?php echo($url); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($wait); ?></b>
    </p>
</div>
<script type="text/javascript">
    (function(){
        var wait = document.getElementById('wait'),href = document.getElementById('href').href;
        var interval = setInterval(function(){
            var time = --wait.innerHTML;
            if(time <= 0) {
                location.href = href;
                clearInterval(interval);
            };
        }, 1000);
    })();
</script>
</body>
</html>