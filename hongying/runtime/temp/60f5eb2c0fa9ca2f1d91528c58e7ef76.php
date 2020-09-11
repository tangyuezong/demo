<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/home/wwwroot/www.gdhy56.com/public/../application/admin/view/admin/index.html";i:1542549041;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>管理员列表</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
</head>

<body style="padding:10px 10px;">
<!--刷下页面代码-->
<a class="layui-btn layui-btn-sm" style="float:right;height: 24px;line-height: 24px;padding: 0 5px;font-size: 12px;" href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="margin-right:1px;">&#xe669;</i>
</a>
<span class="layui-breadcrumb">
  <a href="JavaScript:;">首页</a><a><cite>管理员列表</cite></a>
</span>
<hr>
<form class="layui-form" action="" method="post">
    <blockquote class="layui-elem-quote quoteBox" style="padding:8px;">
        <div class="layui-inline">
            <a class="layui-btn layui-btn-sm " href="javascript:;" onclick="add(this)"><i class="layui-icon">&#xe654;</i>添加管理员</a>
        </div>
        <span style="line-height:28px;float:right;">共有数据：<b style="color: red"><?php echo count($adminRes); ?></b> 条</span>
    </blockquote>
</form>


<form class="layui-form" action="">
    <table class="layui-table">
        <colgroup>
            <col width="5%">

            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="10%">
            <col width="15%">
        </colgroup>
        <thead>
        <tr>
            <th style="text-align: center;">ID</th>
            <th style="text-align: center;">管理员名称</th>
            <th style="text-align: center;">最后登录时间</th>
            <th style="text-align: center;">状态</th>
            <th >操作</th>
        </tr>
        </thead>
        <tbody>

        <?php if(is_array($adminRes) || $adminRes instanceof \think\Collection || $adminRes instanceof \think\Paginator): $i = 0; $__LIST__ = $adminRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin): $mod = ($i % 2 );++$i;?>
        <tr>
            <td align="center"><?php echo $admin['id']; ?></td>
            <td align="center"><?php echo $admin['admin_name']; ?></td>
            <td align="center"><?php echo date("Y/m/d H:i:s",$admin['last_time']); ?></td>
            <td align="center">
                <!--<input id="<?php echo $admin['id']; ?>" onclick="changestatus(this);" <?php if($admin['status'] == 1): ?> checked="checked"<?php endif; if($admin['id'] == 1): ?> disabled="disabled"<?php endif; ?> lay-skin="switch" lay-text="ON|OFF" type="checkbox">-->
                <span id="<?php echo $admin['id']; ?>" <?php if($admin['id'] != 1): ?> onclick="changestatus(this);"<?php endif; ?> >
                    <input  <?php if($admin['status'] == 1): ?> checked=""<?php endif; if($admin['id'] == 1): ?> disabled="disabled"<?php endif; ?> lay-skin="switch" lay-text=" 启用|禁用" type="checkbox" lay-filter="status">
                </span>
            </td>
            <!--<td align="center"><?php echo $admin['last_time']; ?></td>-->
            <td align="center">
                <!--<?php if($admin['id'] == 1): ?>-->
                <!--<a href="javascript:;" onclick="layer.msg('抱歉!请不要私自修改管理员密码!谢谢合作!')" class="layui-btn layui-btn-sm">-->
                    <!--<i class="layui-icon">&#xe642;</i> 编辑-->
                <!--</a>-->
                <!--<?php else: ?>-->
                <!--<a href="<?php echo url('Admin/edit',array('id'=>$admin['id'])); ?>" class="layui-btn layui-btn-sm">-->
                    <!--<i class="layui-icon">&#xe642;</i> 编辑-->
                <!--</a>-->
                <!--<?php endif; ?>-->
                <!--<a href="<?php echo url('Admin/edit',array('id'=>$admin['id'])); ?>" class="layui-btn layui-btn-sm">-->
                    <!--<i class="layui-icon">&#xe642;</i> 编辑-->
                <!--</a>-->
                <a  href="javascript:;" data-id="<?php echo $admin['id']; ?>" onclick="edit(this)" class="layui-btn layui-btn-sm">
                    <i class="layui-icon">&#xe642;</i> 编辑
                </a>
                <?php if($admin['id'] == 1): ?>
                <a href="javascript:;" class="layui-btn layui-btn-sm layui-btn-disabled"><i class="layui-icon">&#xe640;</i>删除</a>
                <?php else: ?>
                <!--<a href="<?php echo url('Admin/del',array('id'=>$admin['id'])); ?>" class="layui-btn layui-btn-danger layui-btn-sm del"><i class="layui-icon">&#xe640;</i>删除</a>-->
                <a href="javascript:;" data-id="<?php echo $admin['id']; ?>" onclick="del(this)" class="layui-btn layui-btn-danger layui-btn-sm">
                    <i class="layui-icon">&#xe640;</i>删除
                </a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>

    </table>
</form>

<div style="text-align: right; margin-top: 10px; ">
    <?php echo $adminRes->render(); ?>
</div>


<div style="height: 150px;"></div>
<script src="/static/admin/layui/jquery.js"></script>
<script src="/static/admin/layui/layui.js"></script>
<script>
    layui.use(['element', 'form'], function(){
        var element = layui.element;
        var form = layui.form;
        //layui复选的监听
        form.on("switch(status)",function (data) {
            console.log(data);
        });
    });
</script>


<!--Ajax异步更新管理员状态-->
<script type="text/javascript">
    function changestatus(o) {
        var id=$(o).attr('id');
        $.ajax({
            type:'POST',
            dataType:'json',
            data:{id:id},
            url:"<?php echo url('Admin/changestatus'); ?>",
            success:function (data) {

            }
        });
    }

</script>


<!--lay删除提示-->
<script>
    layui.use('layer', function(){
        var layer = layui.layer;
        $('.del').on('click',function () {
            var url=$(this).attr('href');
            layer.confirm('确定要删除该管理员吗?', {icon: 3, title:'温馨提示'}, function(index){
                //do something
                location.href=url;
                layer.close(index);
            });
            return false;
        })
    });
    $(function(){
        $(window.parent.document).find('#righttitle').text($('title').text());
    });
</script>


<script>
    function add(o) {
        var urls="<?php echo url('add'); ?>";
        //iframe层
        layer.open({
            type: 2,
            title: '编辑操作',
            shadeClose: true,
            shade: 0.8,
            area: ['60%', '75%'], //高度和宽度
            content: urls //iframe的url
        });
    }
    function edit(o) {
        var id=$(o).attr('data-id');
        var urls="<?php echo url('edit'); ?>?id="+id;
        //iframe层
        layer.open({
            type: 2,
            title: '编辑操作',
            shadeClose: true,
            shade: 0.8,
            area: ['60%', '75%'], //高度和宽度
            content: urls //iframe的url
        });
    }
    function del(o) {
        var id=$(o).attr('data-id');
        layer.confirm('确定要删除吗?', {icon: 3, title:'温馨提示'},function () {
            $.ajax({
                type:'delete',
                url:"<?php echo url('del'); ?>",
                datetype:'json',
                data:{id:id},
                success:function (res) {
                    if (res.code==1){
                        layer.msg(res.msg,{time:2000},function () {
                            location.reload()
                        });
                    }else {
                        layer.msg(res.msg);
                    }
                }
            })
        })
    }
</script>


</body>
</html>