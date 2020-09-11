<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/home/wwwroot/www.gdhy56.com/public/../application/admin/view/index/console.html";i:1543589855;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta content="application/json; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>欢迎页2</title>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
    <script src=”http://html5shiv.googlecode.com/svn/trunk/html5.js”></script
</head>
<body class="body" style="padding:0 10px;">

<fieldset class="layui-elem-field site-demo-button">
    <legend>天气情况</legend>
    <div style="text-align:center">
        <iframe name="weather_inc" src="http://i.tianqi.com/index.php?c=code&id=11" width="500" height="25" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" ></iframe>
    </div>
</fieldset>


<div class="layui-container" style="margin-left:0px;">
    <form class="layui-form" action="" id="myform" onsubmit="return checkform();">
        <fieldset class="layui-elem-field site-demo-button" style="margin-top: 30px;padding: 30px 30px;">
            <legend>缩短网址</legend>
            <div class="layui-form-item" pane="">
                <label class="layui-form-label">生成类型</label>
                <div class="layui-input-block">
			<input type="radio" name="type" value="1" title="其他长转短连接" checked>
                    <input type="radio" name="type" value="2" title="百度长转短连接" >
                    <input type="radio" name="type" value="3" title="百度短转长连接">
                    
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">连接地址：</label>
                <div class="layui-inline" style="width:70%">
                    <input class="layui-input" name="domain" value="http://" required placeholder="请输入需要转换的链接">
                </div>
                <button class="layui-btn" lay-submit lay-filter="formDemo" style="float: right"><i class="layui-icon">&#xe672;</i>转换</button>
                <div id="domain">
                    <!--<blockquote class="layui-elem-quote site-text" style="color: red;font-weight: bold">-->
                        <!--<a href="https://www.dwz.mn/qr.aspx?text=https://dwz.mn/M4uI" download="w3logo">-->
                            <!--<img src="https://www.dwz.mn/qr.aspx?text=https://dwz.mn/M4uI" style="border: 2px solid #A9B7B7;" height="100">-->
                        <!--</a>-->
                        <!--<span>连接：https://dwz.cn/7KuF5st3</span>-->
                    <!--</blockquote>-->
                </div>
            </div>

        </fieldset>
    </form>
</div>

<table class="layui-table">
    <thead>
    <tr>
        <th colspan="2" scope="col">服务器信息</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th width="30%">服务器IP</th>
        <td><span id="lbServerName">http://127.0.0.1/</span></td>
    </tr>
    <tr>
        <td width="40%">服务器域名</td>
        <td width="60%"><?php echo $server['HTTP_HOST']; ?></td>
    </tr>
    <tr>
        <td>运行环境</td>
        <td><?php echo $server['SERVER_SOFTWARE']; ?></td>
    </tr>
    <tr>
        <td>服务器操作系统</td>
        <td><?php echo $server['osname']; ?></td>
    </tr>
    <tr>
        <td>服务器端口</td>
        <td><?php echo $server['SERVER_PORT']; ?></td>
    </tr>
    <tr>
        <td>服务器主机名</td>
        <td><?php echo $server['SERVER_NAME']; ?></td>
    </tr>

    </tbody>
</table>
<table class="layui-table">
    <thead>
    <tr>
        <th colspan="2" scope="col">数据库信息</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td width="40%">数据库版本</td>
        <td width="60%"><?php echo $server['mysqlversion']; ?></td>
    </tr>
    <tr>
        <td>数据库名称</td>
        <td><?php echo $server['databasename']; ?></td>
    </tr>
    </tbody>
</table>
<table class="layui-table">
    <thead>
    <tr>
        <th colspan="2" scope="col">PHP相关参数</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td width="40%">PHP版本</td>
        <td width="60%"><?php echo $server['phpversion']; ?></td>
    </tr>
    <!--<tr>-->
    <!--<td width="40%">框架版本</td>-->
    <!--<td width="60%">ThinkPHP <?php echo THINK_VERSION ;?></td>-->
    <!--&lt;!&ndash;<td width="60%">Laravel 5.6</td>&ndash;&gt;-->
    <!--</tr>-->
    <tr>
        <td>上传文件最大限制</td>
        <td><?php echo $server['maxupload']; ?></td>
    </tr>
    </tbody>
</table>

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
    //表单前端验证
    function checkform() {
        var formdata=$('#myform').serialize();
        //alert(formdata)
        //Ajax异步提交
        $.ajax({
            type:"POST",
            url:"<?php echo url('domain'); ?>",
            dataType:"json",
            data:formdata,
            success:function (data) {
                //alert(666)
                if(data.code==1){

                // <a href="https://www.dwz.mn/qr.aspx?text=https://dwz.mn/M4uI" download="w3logo">
                //         <img src="https://www.dwz.mn/qr.aspx?text=https://dwz.mn/M4uI" style="border: 2px solid #A9B7B7;" height="100">
                //         </a>
                    var str;
                    str = '<blockquote class="layui-elem-quote site-text" style="color: red;font-weight: bold">';
                    //   str = str + '<img src="/static/uploads/' + res.img + '" alt="" height="80">';
                    str = str +  '<a href="https://www.dwz.mn/qr.aspx?text=' + data.url + '" download="w3logo">';
                    str = str +  ' <img src="https://www.dwz.mn/qr.aspx?text=' + data.url + '" style="border: 2px solid #A9B7B7;" height="100">' ;
                    str = str +  '</a>' ;
                    str = str +  data.url ;
                    str = str + '</blockquote>';

                    $('#domain').append(str);

                }else {
                    //alert('失败');
                    layer.msg(data.msg)
                }
            }
        })
        //阻止表单提交
        return false;
    }
</script>

</body>
</html>