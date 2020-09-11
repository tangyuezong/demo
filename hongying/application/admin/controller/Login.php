<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Login extends Controller
{
    public function index()
    {
        if (session('admin_name')&&session('admin_id')){
            $this->error('您已经登录成功，请勿重新登录','Admin/Index/index');
        }
        if (request()->isPost()){
            $this->check(input('code')); //使用验证码
            $data=input('post.');
            //dump($data);die;
            $result=$this->logincheck($data);
            //dump($data);die;
            if($result['code']==1){
                $this->success($result['msg'],'index/index');
            }
            $this->error($result['msg']);
        }
        return view();
    }
    public function logincheck($data){
        $res=Db::name('admin')->where('admin_name',$data['admin_name'])->find();
        if(!$res){
            return ['code'=>0,'msg'=>'您的用户名或密码错误，请核准正确的用户名及密码'];
        }
        if(md5($data['admin_password'])!=$res['admin_password']){
            return ['code'=>0,'msg'=>'您的用户名或密码错误，请核准正确的用户名及密码','mid'=>$res['id']];
        }
        if(!$res['status']){
            return ['code'=>0,'msg'=>'抱歉！您账户已被封停，无法登陆！请联系超级管理员！','mid'=>$res['id']];
        }
        session('admin_name', $res['admin_name']);
        session('admin_id', $res['id']);
        Db::name('admin')->where(array('id'=>$res['id']))->update(['last_time'=>time()]);
        return ['code'=>1,'msg'=>'登录成功','mid'=>$res['id']];
    }
    public function check($code='')
    {
        if (!captcha_check($code)) {
            $this->error('验证码填写错误');
        } else {
            return true;
        }
    }
}
