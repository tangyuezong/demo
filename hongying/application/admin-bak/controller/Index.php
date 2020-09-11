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

    public function domain(){
        if (request()->isPost()){
            $data=input('post.');
            $domain=$data['domain'];

            $url='http://h5ip.cn/index/api?format=json&url=http%3a%2f%2f'.$domain;
            $result=file_get_contents($url);
            $currentFrom = json_decode($result,true);
            return $currentFrom;
        }
    }


    //加载欢迎页面
    public function welcome(){

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
    public function demo(){
        return view();
    }

}
