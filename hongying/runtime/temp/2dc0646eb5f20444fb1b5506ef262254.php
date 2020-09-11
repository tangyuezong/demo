<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/home/wwwroot/www.gdhy56.com/public/../application/admin/view/index/index.html";i:1543572083;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" href="/static/admin/layui-admin/layui/css/layui.css" media="all" />
    <link rel="stylesheet" href="/static/admin/layui-admin/css/index.css" media="all" />
    <link href="/static/admin/layui-admin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .layui-nav-tree .layui-nav-item a{
            height: 44.5px;
            line-height: 44.5px;
        }
    </style>
</head>
<body class="main_body">
<div class="layui-layout layui-layout-admin">
    <!-- 顶部 -->
    <div class="layui-header header">
        <div class="layui-main mag0" style="margin: 0px; ">
            <a href="javascript:;" class="logo" style="font-size:20px;">后台管理系统</a>
            <!-- 显示/隐藏菜单 -->
            <a href="javascript:;" class=" hideMenu layui-icon layui-icon-shrink-right"></a>
            <!-- 顶级菜单 -->
            <ul class="layui-nav topLevelMenus" pc>

                <a href="<?php echo url('index/Index/index'); ?>" target="_blank" title="前台" style="color: #fff;font-size:16px">
                    <cite><i class="layui-icon">&#xe7ae;</i> 前台</cite>
                </a>
                <a href="javascript:;" class="refresh refreshThis" style="color: #fff;font-size:16px;margin: 0 20px;">
                    <cite><i class="layui-icon layui-icon-refresh-3"  style="font-size:14px;"></i> 刷新</cite>
                </a>
            </ul>

            <!-- 顶部右侧菜单 -->
            <ul class="layui-nav top_menu">
                <li class="layui-nav-item">
                    <a href="<?php echo url('admin/index/clear'); ?>" class="clearCache">
                        <cite><i class="layui-icon" data-icon="&#xe640;">&#xe640;</i>清除缓存</cite><span class="layui-badge-dot"></span>
                    </a>
                </li>

                <li class="layui-nav-item" pc>
                    <!--<a href="javascript:;"><i class="seraph icon-lock"></i><cite>锁屏</cite></a>-->
                    <dd pc><a href="javascript:;" class="changeSkin" style="padding: 0 10px;"><i class="layui-icon">&#xe66a;</i><cite>换肤</cite></a></dd>
                </li>
                <li class="layui-nav-item lockcms" pc>
                    <a href="javascript:;" style="padding: 0 10px;"><i class="seraph icon-lock"></i><cite><i class="layui-icon">&#xe673;</i> 锁屏</cite></a>
                </li>
                <li class="layui-nav-item" pc >
                    <dd pc><a href="javascript:;" id="screenbs" onclick="fullScreen()"><i class="fa fa-arrows-alt" aria-hidden="true"></i><cite>全屏</cite></a></dd>
                </li>
                <li class="layui-nav-item" id="userInfo">
                    <a href="javascript:;" >
                        <img src="/static/admin/layui-admin/images/face.jpg" class="layui-nav-img userAvatar" style="border: 2px solid #A9B7B7; width: 35px;height: 35px;"><cite class="adminName"><?php echo \think\Session::get('admin_name'); ?></cite></a>
                    <dl class="layui-nav-child">
                        <dd><a href="<?php echo url('admin/logout'); ?>" class="signOut"><i class="seraph icon-tuichu"></i><cite>退出</cite></a></dd>
                    </dl>
                </li>
            </ul>
        </div>
    </div>
    <!-- 左侧导航 -->

    <div class="layui-side layui-bg-black">
        <!--
        <div class="user-photo">
            <a class="img" title="我的头像"><img src="images/face.jpg"></a>
             <p style="font-size:14px"><span class="userName" style="margin-right: 10px">Admin</span><a href="#" style="color: #fff">退出</a></p>
        </div>
        -->
        <div class="navBar layui-side-scroll" style="border-top: 3px solid #1AA094;">
            <ul class="layui-nav layui-nav-tree" style="margin-top: 3px">
                <!--
               <div class="user-photo">
                   <a class="img" title="我的头像"><img src="images/face.jpg"></a>
                   <p style="font-size:14px"><span class="userName" style="margin-right: 10px">Admin</span><a href="#" style="color: #fff">退出</a></p>
               </div>
               <!--<li class="layui-nav-item">
                   <a href="javascript:;">
                       <i class="layui-icon">&#xe68e;</i>
                       <cite>后台首页</cite>
                   </a>
               </li>-->
                <!--<div class="user-photo" style="border-bottom: 2px solid #fff;padding:6px 0 3px;">-->


                <div class="user-photo" style="padding:6px 0 3px;">
                    <a class="img" title="我的头像"><img src="/static/admin/layui-admin/images/face.jpg" style="border: 2px solid #A9B7B7;" width="35px"></a>
                    <p style="font-size:14px">
                        <!--<span class="userName" style="margin-right: 10px"><?php echo \think\Session::get('admin_name'); ?></span>-->
                        <span class="userName" style="margin-right: 10px"><?php echo \think\Session::get('admin_name'); ?></span>
                        <a href="<?php echo url('admin/logout'); ?>" style="color: #fff">退出</a>
                    </p>
                </div>

                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <i class="layui-icon">&#xe66f;</i>
                        <cite>管理员</cite><span class="layui-nav-more"></span>
                    </a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="<?php echo url('Admin/index'); ?>"><cite>管理员列表</cite></a>
                        </dd>
                    </dl>
                </li>

                <li class="layui-nav-item">
                    <a class="" href="javascript:;"><i class="layui-icon">&#xe770;</i>&nbsp;会员管理</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="<?php echo url('Member/index'); ?>"><cite>会员列表</cite></a>
                        </dd>
                    </dl>
                </li>

                <!--<li class="layui-nav-item">-->
                    <!--<a class="" href="javascript:;"><i class="layui-icon">&#xe653;</i>&nbsp;项目管理</a>-->
                    <!--<dl class="layui-nav-child">-->
                        <!--<dd>-->
                            <!--<a href="javascript:;" data-url="<?php echo url('Project/add'); ?>"><cite>添加项目</cite></a>-->
                        <!--</dd>-->
                    <!--</dl>-->
                <!--</li>-->

                <li class="layui-nav-item">
                    <a class="" href="javascript:;"><i class="layui-icon">&#xe653;</i>&nbsp;项目管理</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:;" data-url="<?php echo url('Project/add'); ?>"><cite>添加项目</cite></a>
                        </dd>
                        <dd>
                            <a href="javascript:;" data-url="<?php echo url('Project/index'); ?>"><cite>项目列表</cite></a>
                        </dd>
                    </dl>
                </li>


            </ul>
        </div>
    </div>
    <!-- 右侧内容 -->
    <div class="layui-body layui-form" style="bottom:0px;">
        <div class="layui-tab mag0" lay-filter="bodyTab" id="top_tabs_box" style="margin: 0;">
            <ul class="layui-tab-title top_tab" id="top_tabs">
                <li class="layui-this" lay-id="" style="padding:0px;min-width: 50px;"><i class="layui-icon">&#xe68e;</i></li>
            </ul>

            <ul class="layui-nav closeBox">
                <li class="layui-nav-item">
                    <!--<a href="javascript:;"><i class="layui-icon caozuo">&#xe643;</i> 页面操作</a>-->
                    <a href="javascript:;"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> 页面操作</a>
                    <dl class="layui-nav-child">
                        <dd><a href="javascript:;" class="refresh refreshThis">刷新当前页面</a></dd>
                        <dd><a href="javascript:;" class="closePageOther">关闭其他页面</a></dd>
                        <dd><a href="javascript:;" class="closePageAll">关闭全部页面</a></dd>
                    </dl>
                </li>
            </ul>
            <div class="layui-tab-content clildFrame">
                <div class="layui-tab-item layui-show">
                    <iframe src="<?php echo url('console'); ?>"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    <!--<div class="layui-footer footer">-->
    <!--<p><span>copyright @2018 后台模板</span></p>-->
    <!--</div>-->
</div>

<!-- 移动导航 -->
<div class="site-tree-mobile"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>

<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<script type="text/javascript" src="/static/admin/layui-admin/layui/layui.js"></script>
<script type="text/javascript" src="/static/admin/layui-admin/js/index.js"></script>
<script type="text/javascript" src="/static/admin/layui-admin/js/cache.js"></script>
<script>
    //全屏
    function fullScreen(){
        var el = document.documentElement;
        var rfs = el.requestFullScreen || el.webkitRequestFullScreen || el.mozRequestFullScreen || el.msRequestFullscreen;
        if(typeof rfs != "undefined" && rfs) {
            rfs.call(el);

        };
        var screenbs='<dd pc><a href="javascript:;" id="screenbs" onclick="exitScreen()"><i class="fa fa-compress" aria-hidden="true"></i><cite>还原</cite></a></dd>';
        //alert(screenbs)
        $('#screenbs').replaceWith(screenbs);
        //var screenbig;
        return;
    }
    //退出全屏
    function exitScreen(){
        if (document.exitFullscreen) {
            document.exitFullscreen();
        }
        else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        }
        else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
        else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        }
        if(typeof cfs != "undefined" && cfs) {
            cfs.call(el);
        }
        var screenbs='<dd pc><a href="javascript:;" id="screenbs" onclick="fullScreen()"><i class="fa fa-arrows-alt" aria-hidden="true"></i><cite>全屏</cite></a></dd>';
        //alert(screenbs)
        $('#screenbs').replaceWith(screenbs);
        //var screenbig;
    }
</script>
</body>
</html>