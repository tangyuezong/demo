<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/www.gdhy56.com/public/../application/admin/view/project/index.html";i:1543591778;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>项目列表</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
</head>

<body style="padding:10px 10px;">
<a class="layui-btn layui-btn-sm" style="float:right;height: 24px;line-height: 24px;padding: 0 5px;font-size: 12px;" href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="margin-right: 1px;">&#xe669;</i>
</a>
<span class="layui-breadcrumb">
  <a href="/">首页</a><a><cite>项目类表</cite></a>
</span>
<hr>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
    <legend>
        <a class="layui-btn layui-btn-sm " href="<?php echo url('add'); ?>">添加项目</a>
    </legend>
    <form class="layui-form layui-form-pane" action="" method="get" >
        <div class="layui-inline" style="float: right;height: 20px">
            <label class="layui-form-label">搜索关键词</label>
            <div class="layui-input-inline">
                <input type="text" name="search" value="<?php echo $keyword; ?>" placeholder="请输入会员账号" class="layui-input">
            </div>

            <button class="layui-btn">搜索</button>
        </div>
    </form>
</fieldset>

<form action="<?php echo url('sort'); ?>" method="post">
    <table class="layui-table"  lay-filter="mytable">
        <!--<colgroup>-->
            <!--<col width="5%">-->
            <!--<col width="5%">-->

            <!--<col width="10%">-->
            <!--<col width="10%">-->
            <!--<col width="10%">-->
            <!--<col width="10%">-->
            <!--<col width="10%">-->
            <!--<col width="15%">-->
        <!--</colgroup>-->
        <thead>
        <tr>
            <!--<th style="text-align: center;">ID</th>-->
            <!--<th style="text-align: center;">项目名称</th>-->
            <!--<th style="text-align: center;">项目图标</th>-->
            <!--<th style="text-align: center;">项目地址</th>-->
            <!--<th style="text-align: center;">日利率</th>-->
            <!--<th style="text-align: center;">额度</th>-->
            <!--<th style="text-align: center;">推荐</th>-->
            <!--<th style="text-align: center;">显示状态</th>-->
            <!--<th style="text-align:center;"><input  class="layui-btn layui-btn-sm" type="submit" value="排序"></th>-->
            <!--<th >操作</th>-->

            <th lay-data="{field:'id', width:100,sort: true}">ID</th>
            <th lay-data="{field:'name', width:120}">项目名称</th>
            <th lay-data="{field:'thumb', width:120}">项目图标</th>
            <th lay-data="{field:'link_url'}">项目地址</th>
            <th lay-data="{field:'dayrate', width:100,sort: true}">日利率</th>
            <th lay-data="{field:'limit', width:120}">额度</th>
            <th lay-data="{field:'recommend', width:100}">推荐</th>
            <th lay-data="{field:'status', width:100}">状态</th>
            <th lay-data="{field:'srot', width:100}">排序</th>
            <th lay-data="{field:'caozuo', width:200}">操作</th>
        </tr>
        </thead>
        <tbody>

        <?php if(is_array($projectRes) || $projectRes instanceof \think\Collection || $projectRes instanceof \think\Paginator): $i = 0; $__LIST__ = $projectRes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
        <tr>
            <td align="center"><?php echo $vo['id']; ?></td>
            <td align="center"><?php echo $vo['name']; ?></td>
            <td align="center">
                <?php if($vo['thumb'] != ''): ?>
                <img src="/static/uploads/<?php echo $vo['thumb']; ?>" height="30">
                <?php else: ?>
                暂无缩略图
                <?php endif; ?>
            </td>
            <td align="center"><a href="<?php echo $vo['link_url']; ?>" style="color: #19b0d7"><?php echo $vo['link_url']; ?></a></td>
            <td align="center"><?php echo $vo['dayrate']; ?></td>
            <td align="center"><?php echo $vo['limit']; ?></td>
            <td align="center"><?php if($vo['recommend'] == 1): ?>推荐<?php else: ?>不推荐<?php endif; ?></td>
            <td align="center">
                <a id="<?php echo $vo['id']; ?>" onclick="changestatus(this);" <?php if($vo['status'] == 1): ?> class="layui-btn layui-btn-sm" <?php else: ?>class="layui-btn layui-btn-sm layui-btn-danger" <?php endif; ?>>
                <?php if($vo['status'] == 1): ?>
                显示
                <?php else: ?>
                隐藏
                <?php endif; ?>
            </td>
            <td align="center"><input  name="sort[<?php echo $vo['id']; ?>]" type="text" value="<?php echo $vo['sort']; ?>" style="width: 30px; text-align: center;"></td>
            <td align="center">
                <a href="<?php echo url('edit',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-sm">
                    <i class="layui-icon">&#xe642;</i> 编辑
                </a>
                <a href="<?php echo url('del',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-danger layui-btn-sm del"><i class="layui-icon">&#xe640;</i>删除</a>
            </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>

    </table>
</form>

<div style="text-align: right; margin-top: 10px; ">

</div>


<div></div>
<script type="text/javascript" src="/static/admin/layui/jquery.js"></script>
<script type="text/javascript" src="/static/admin/layui/layui.js"></script>

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

<!--ajax异步修改栏目显示状态（显示/隐藏）-->
<script type="text/javascript">
    function changestatus(o) {
        var id=$(o).attr("id");
        $.ajax({
            type:"post",
            dataType:"json",
            data:{id:id},
            url:"<?php echo url('changestatus'); ?>",
            success:function (data) {
                if(data==1) {
                    $(o).attr("class","layui-btn layui-btn-sm layui-btn-danger");
                    $(o).text('隐藏');
                }else {
                    $(o).attr("class","layui-btn layui-btn-sm");
                    $(o).text('显示');
                }
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
            layer.confirm('确定要删除links吗?', {icon: 3, title:'温馨提示'}, function(index){
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
    var table;
    layui.use('table', function(){
        table= layui.table;
        var counts="<?php echo count($projectRes);?>";
        //转换静态表格
        table.init('mytable', {
            id:"mytable"
           // ,height: 415
            ,limit: 1
            ,limits:[100,500,1000,5000,10000]
            ,page:{
                count:counts,
                limit:15
            }
        });
    });
</script>

</body>
</html>