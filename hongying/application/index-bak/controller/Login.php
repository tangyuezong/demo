<?php
namespace app\index\controller;

use think\Controller;

class Login extends Controller
{
    public function index(){

        if (session('user_id')&&session('user_mobile')&&session('user_name')){
            $this->error('您已经登录成功，请勿重新登录','index/Index/index');
        }

        if (request()->isPost()){
            $data=input('post.');
            //dump($data);

            $user=db('Member')->where('mobile',trim($data['mobile']))->where('password',trim(md5($data['password'])))->find();
            //dump($user);die;
            if (empty($user)){
                //$this->error('账号或者密码填写错误');
                $this->error('账号或者密码填写错误');
            }else{
                session('user_id',$user['id']);
                session('user_mobile',$user['mobile']);
                session('user_name',$user['name']);
                return ['code'=>1,'msg'=>'恭喜你!登录成功'];
            }

        }
        return view();
    }

    public function logout(){
        session('user_id',null);
        session('user_mobile',null);
        session('user_name',null);
        $this->success('退出成功！','index/Index/index');
    }


}
