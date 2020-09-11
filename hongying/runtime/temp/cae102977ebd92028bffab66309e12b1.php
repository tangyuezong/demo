<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"/home/wwwroot/www.gdhy56.com/public/../application/admin/view/member/index.html";i:1543294475;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>会员列表</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css">
</head>

<body style="padding:10px 10px;">
<a class="layui-btn layui-btn-sm" style="float:right;height: 24px;line-height: 24px;padding: 0 5px;font-size: 12px;" href="javascript:location.replace(location.href);" title="刷新">
    <i class="layui-icon" style="margin-right:1px;">&#xe669;</i>
</a>
<span class="layui-breadcrumb">
  <a href="JavaScript:;">首页</a><a><cite>会员列表</cite></a>
</span>
<hr>

<div class="demoTable" style="float: left">
    搜索：
    <div class="layui-inline">
        <input class="layui-input" name="search" placeholder="请输入会员账号" id="demoReload" autocomplete="off">
    </div>
    <button class="layui-btn" data-type="reload">搜索</button>
</div>

<div class="searchTime" style="float: left;margin-left: 30px;margin-bottom:5px">
    时间搜索：
    <div class="layui-inline">
        <input class="layui-input" name="time_min" id="time_min" value="<?php echo date('Y-m-d H:i:s', strtotime('-1 year'));?>" autocomplete="off">
    </div>
    <span>—</span>
    <div class="layui-inline">
        <input class="layui-input" name="time_max" id="time_max" value="<?php echo date('Y/m/d H:i:s',time())?>" autocomplete="off">
    </div>
    <button class="layui-btn" data-type="reload">搜索</button>
</div>

<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">

    <div style="clear:both"></div>

    <form class="layui-form" action="">
        <table class="layui-hide" id="datatable" lay-filter="datatable"></table>
    </form>

</fieldset>





<script type="text/html" id="barDemo">
    <a class="layui-btn layui-btn-sm" lay-event="edit">查看</a>
    <a href="javascript:;" class="layui-btn layui-btn-danger layui-btn-sm" lay-event="del">
        <i class="layui-icon">&#xe640;</i>删除
    </a>
</script>


<a class="layui-btn layui-btn-normal layui-btn-sm" href="javascript:;" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</a>
    <a class="layui-btn layui-btn-sm dels" href="<?php echo url('deltableall'); ?>" ><i class="layui-icon">&#xe640;</i>清空数据表</a>
    <?php if(\think\Session::get('admin_id') == 1): ?>
     <a class="layui-btn layui-btn-sm layui-btn-danger" href="<?php echo url('leadingin'); ?>" ><i class="layui-icon">&#xe681;</i></a>
        <a class="layui-btn layui-btn-normal layui-btn-sm " href="<?php echo url('exportexecl'); ?>"><i class="layui-icon">&#xe601;</i></a>
    <?php endif; ?>

<!--<a class="layui-btn layui-btn-sm" href="<?php echo url('deltableall'); ?>" ><i class="layui-icon">&#xe640;</i>清空数据表</a>-->




<script src="/static/admin/layui/jquery.js"></script>
<script src="/static/admin/layui/layui.js"></script>

<script>
    layui.use(['element', 'form'], function(){
        var element = layui.element;
        var form = layui.form;

        $('.dels').on('click',function () {
            var url=$(this).attr('href');
            layer.confirm('确定要执行清空表全部记录吗?请慎重!', {icon: 3, title:'温馨提示'}, function(index){
                //do something
                location.href=url;
                layer.close(index);
            });
            return false;
        })
    form.on('checkbox(quanxuan)', function(data){
        if(data.elem.checked){
            $('.qx').prop('checked',true);
            form.render();
        }else {
            $('.qx').prop('checked',false);
            form.render();
        }
    });

    });
</script>

<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#time_min' //指定元素
            ,type: 'datetime'
            ,format: 'yyyy/MM/dd HH:mm:ss' //可任意组合
        });
        laydate.render({
            elem: '#time_max' //指定元素
            ,type: 'datetime'
            ,format: 'yyyy/MM/dd HH:mm:ss' //可任意组合
        });
    });
</script>

<!--lay删除提示-->
<script>
    layui.use('layer', function(){
        var layer = layui.layer;
        $('.del').on('click',function () {
            var url=$(this).attr('href');
            layer.confirm('确定要删除该记录吗?', {icon: 3, title:'温馨提示'}, function(index){
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
    layui.use('table', function(){
        var table = layui.table;

        table.render({
            elem: '#datatable'
            ,url: "<?php echo url('dataTable'); ?>"
            //,height: 400
            ,page: true //开启分页
            ,limit:15
            ,limits:[5,10,15,20,30,50,70,80,90,100,500,1000,5000,10000]
            ,loading: true
            ,cols: [[
                {type:'checkbox'},
                {field: 'id', title: 'ID', width:100, sort: true}
                ,{field: 'mobile', title: '客户手机号', width:200, sort: true ,templet: '#sexTpl'}
                ,{field: 'name', title: '客户姓名', width: 300}
                ,{field: 'time', title: '注册时间', width:200,sort: true }
                // ,{field: 'ip', title: '注册IP',sort: true, width: 200}
                ,{field: 'status',title: '状态', width: 200}
                ,{field: 'caozuo',title: '操作', width: 300, toolbar: '#barDemo'}
            ]],
            id:'testReload',
        });

        //姓名和账户
        var $ = layui.$, active = {
            reload: function(){
                var demoReload = $('#demoReload');
                //执行重载
                table.reload('testReload', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    ,url:"<?php echo url('dataTable'); ?>"
                    ,where: {
                        key: {
                            search: demoReload.val()
                        }
                    }
                });
            }
        };
        $('.demoTable .layui-btn').on('click', function(){
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });


        var $ = layui.$, active1 = {
            reload: function(){
                var timeStart = $('#time_min');
                var timeEnd = $('#time_max');
                //执行重载
                table.reload('testReload', {
                    page: {
                        curr: 1 //重新从第 1 页开始
                    }
                    ,url:"<?php echo url('dataTable'); ?>"
                    ,where: {
                        keytime: {
                            time_min: timeStart.val(),
                            time_max: timeEnd.val()
                        }
                    }
                });
            }
        };
        $('.searchTime .layui-btn').on('click', function(){
            var type = $(this).data('type');
            active1[type] ? active1[type].call(this) : '';
        });

        //事件监听
        table.on('tool(datatable)', function(obj){
            var data = obj.data;
            var layEvent = obj.event;
            var tr = obj.tr;
            if(layEvent === 'edit'){
                location.href="<?php echo url('edit'); ?>?id="+data.id;
            } else if(layEvent === 'del'){
                layer.confirm('确定要删除吗?', function(index){
                    $.ajax({
                        type:"post",
                        url:"<?php echo url('del'); ?>",
                        data:{id:data.id},
                        dataType:"json",
                        success:function(res){
                            if(res.code==1){
                                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                                layer.close(index);
                            }else{
                                layer.msg(res.msg);
                            }
                        }
                    });
                });
            }
        });
    });


    //批量删除
    function delAll (argument) {
        //监听表格复选框选择
        var table = layui.table;

        var checkStatus = table.checkStatus('datatable');
        var ids=new Array(),key;
        for(key in checkStatus.data){
            ids.push(checkStatus.data[key].id);
        }
        ids=ids.join(",");
        alert(ids)
        if(ids == "" || ids == null || ids == undefined){
            layer.msg('请选择您要删除的数据');
            return false;
        }
        layer.confirm('确定要删除吗?', {icon: 3, title:'温馨提示'},function () {
            //捉到所有被选中的，发异步进行删除
            $.post("<?php echo url('delAll'); ?>",{id:ids},function(res){
                if(res.code==1){
                    //$(".layui-form-checked").not('.header').parents('tr').remove();
                    layer.msg(res.msg,{time:1000},function () {
                        location.reload();
                    });
                }else {
                    layer.msg(res.msg);
                }
            },'json');
        });
    }
</script>

</body>
</html>