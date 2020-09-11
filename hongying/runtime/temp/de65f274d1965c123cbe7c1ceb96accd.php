<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/home/wwwroot/www.gdhy56.com/public/../application/admin/view/project/add.html";i:1543572234;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>添加项目</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">

</head>
<body style="padding:10px 10px;">
<a class="layui-btn layui-btn-sm" style="float:right;height: 24px;line-height: 24px;padding: 0 5px;font-size: 12px;" href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="margin-right: 1px;">&#xe669;</i>
</a>
<span class="layui-breadcrumb">
  <a href="/">首页</a><a href="<?php echo url('index'); ?>">项目列表</a><a><cite>添加项目</cite></a>
</span>
<hr>

<div class="layui-container" style="margin-left:0px;">
    <form class="layui-form layui-form-pane" action="" method="post" enctype="multipart/form-data">
        <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;padding: 30px 30px;">
            <legend>添加项目</legend>
            <div class="layui-form-item">
                <label class="layui-form-label">项目名称</label>
                <div class="layui-input-inline" style="width: 70%">
                    <input type="text" name="name" placeholder="请输入项目名称" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">项目标志</label>
                <div class="layui-input-inline" style="width: 70%">
                    <input type="file" name="thumb"  autocomplete="off">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">项目地址</label>
                <div class="layui-input-inline" style="width: 70%">
                    <input type="text" name="link_url" placeholder="请输入项目地址" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">日利率</label>
                <div class="layui-input-inline" style="width: 70%">
                    <input type="text" name="dayrate" placeholder="请输入日利率" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">额度</label>
                <div class="layui-input-inline" style="width: 70%">
                    <input type="text" name="limit" placeholder="请输入额度" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">是否推荐</label>
                <div class="layui-input-block">
                    <input type="radio" name="recommend" value="1" title="推荐" checked>
                    <input type="radio" name="recommend" value="0" title="不推荐" >
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">是否显示</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="1" title="显示" checked>
                    <input type="radio" name="status" value="0" title="不显示" >
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">确认提交</button>
                </div>
            </div>
        </fieldset>


    </form>

</div>
<script src="/static/admin/layui/jquery.js"></script>
<script src="/static/admin/layui/layui.js"></script>

<script>
    layui.use(['element', 'form'], function(){
        var element = layui.element;
        var form = layui.form;
    });
</script>
</body>
</html>