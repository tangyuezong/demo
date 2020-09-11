<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:77:"/home/wwwroot/www.gdhy56.com/public/../application/admin/view/admin/edit.html";i:1542549012;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>修改管理员</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
</head>
<body style="padding:10px 10px;">
<!--刷下页面代码-->
<a class="layui-btn layui-btn-sm" style="float:right;height: 24px;line-height: 24px;padding: 0 5px;font-size: 12px;" href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="margin-right: 1px;">&#xe669;</i>
</a>
<!--刷下页面代码-->
<!-- <a href="<?php echo url('Index/index'); ?>">首页</a>  >  <a href="<?php echo url('index'); ?>">分类管理</a>  -->
<span class="layui-breadcrumb">
  <a href="/">首页</a><a href="<?php echo url('index'); ?>">管理员列表</a><a><cite>添加角色</cite></a>
</span>
<hr>

<div class="layui-container" style="margin-left:0px;">
    <form class="layui-form layui-form-pane" action="" id="myform" onsubmit="return checkform();">
        <input type="hidden" name="id" value="<?php echo $admins['id']; ?>">
        <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;padding: 30px 30px;">
            <legend>修改管理员</legend>

            <div class="layui-form-item">
                <label class="layui-form-label">管理员名称</label>
                <div class="layui-input-block">
                    <input type="text" name="admin_name" value="<?php echo $admins['admin_name']; ?>" required lay-verify="required" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">管理员密码</label>
                <div class="layui-input-block">
                    <input type="text" name="admin_password" placeholder="*默认留空则表示密码不修改" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">状态：</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="1" title="显示" <?php if($admins['status'] == 1): ?> checked=""<?php endif; ?>>
                    <input type="radio" name="status" value="0" title="隐藏" <?php if($admins['status'] == 0): ?> checked=""<?php endif; ?>>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn" lay-submit lay-filter="formDemo"><i class="layui-icon">&#xe672;</i>确认提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe63d;</i>重置</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>


<div style="height: 150px;"></div>
<script src="/static/admin/layui/jquery.js"></script>
<script src="/static/admin/layui/layui.js"></script>
<script>
    layui.use(['element', 'form'], function(){
        var element = layui.element;
        var form = layui.form;
    });
</script>

<!--Ajax异步修改-->
<script>
    function checkform() {
        var formdata=$('#myform').serialize();
        $.ajax({
            type:"POST",
            url:"<?php echo url('edit'); ?>",
            dataType:"json",
            data:formdata,
            success:function (data) {
                if(data.code==1){
                    layer.msg(data.msg,{time:2000},function () {
                        var index =parent.layer.getFrameIndex(window.name);
                        parent.layer.close(index);
                        parent.location.reload();
                    });
                }else {
                    layer.msg(data.msg)
                }
            }
        })
        return false;
    }
</script>



</body>
</html>