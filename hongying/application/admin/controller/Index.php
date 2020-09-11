<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;//引入数据类；可以查询数据库信息
class Index extends Common
{
    public function index()
    {

        return view();
    }

    //生成二维码
    // https://www.dwz.mn/qr.aspx?text=https://dwz.mn/M4uI
    public function domain(){
        if (request()->isPost()){
            $data=input('post.');
            $domain=$data['domain'];
            //dump($data);die;

            /**
             * @param $data['type']  1:通用短连接   2：百度短连接 3：百度长连接
             */
            if ($data['type']==1){
                $url='http://h5ip.cn/index/api?format=json&url='.$domain;
                $result=file_get_contents($url);
                $currentFrom = json_decode($result,true);
                if($currentFrom['code']==0){
                    return ['code'=>1,'url'=>$currentFrom['short_url']];
                }else{
                    return ['code'=>0,'msg'=>'您输入的网址存在安全隐患或者错误，请重新输入'];
                }
            }elseif ($data['type']==2){
                //0：短连接转长连接 1:长连接转短连接
                $resultLong= baiduUrlAPI(1, $domain);
                if ($resultLong['code']==1){
                    return ['code'=>1,'url'=>$resultLong['ShortUrl']];
                }else{
                    return ['code'=>0,'msg'=>'您输入的网址存在安全隐患或者错误，请重新输入'];
                }
            }elseif ($data['type']==3){
                //0：长连接转短连接 1:短连接转长连接
                $resultLong= baiduUrlAPI(0, $domain);
                //dump($resultLong);
                if ($resultLong['code']==1){
                    return ['code'=>1,'url'=>$resultLong['LongUrl']];
                }else{
                    return ['code'=>0,'msg'=>'您输入的网址存在安全隐患或者错误，请重新输入'];
                }
            }
        }
    }


    //加载欢迎页面
    public function console(){

        //dump($_SERVER);die;
        $server=[
            'ip'=>$_SERVER['REMOTE_ADDR'],//获取服务器IP地址
            'HTTP_HOST'=>$_SERVER['HTTP_HOST'],
            'SERVER_SOFTWARE'=>$_SERVER['SERVER_SOFTWARE'],
            'osname'=>php_uname(),
            'HTTP_ACCEPT_LANGUAGE'=>$_SERVER['HTTP_ACCEPT_LANGUAGE'],//语言
            'SERVER_PORT'=>$_SERVER['SERVER_PORT'],//端口
            'SERVER_NAME'=>$_SERVER['SERVER_NAME'],//主机名
            //服务器操作系统/php_uname
            'os'=>PHP_OS,
            //运行环境
            'server'=>$_SERVER["SERVER_SOFTWARE"],
        ];
        //获取数据库信息
        $version=Db::query("select version()");
        $server['mysqlversion']=$version[0]['version()'];
        $server['databasename'] =config('database')['database'];
        $server['phpversion']=phpversion();
        $server['maxupload']=ini_get('max_file_uploads');

        $this->assign('server',$server);


        return view();
    }

    // 清除缓存
    public function clear(){
        $this->clearCache("../runtime");
        $this->success('清除缓存成功',url('index'));
    }
    public function clearCache($dir){
        if(!file_exists($dir)){
            return false;
        }
        $arr=scandir($dir);
        foreach ($arr as $key => $value) {
            if($key>1){
                $path=$dir.'/'.$value;
                if(is_dir($path)){
                    $this->clearCache($path);
                }
                if(is_file($path)){
                    unlink($path);
                }
            }
        }
        rmdir($dir);
    }


    //页面测试设置demo
    public function demo($id){
        return view();
    }

}
