<?php
namespace app\index\controller;

use think\Controller;
use think\Db;

class Index extends Controller
{
    public function index()
    {
        if (request()->isPost()){
            $data=input('post.');
            //$this->check(input('code')); //使用验证码
            //unset($data['code']);

            //dump($data);die;
            //验证手机验证码是否正确
//            if ($data['send_code'] !=session('mobileCode')){
//                //$this->error("手机验证码错误,请填写正确的手机验证码");
//                return ['code'=>0,'msg'=>'手机验证码错误,请填写正确的手机验证码'];
//
//            }
//            unset($data['send_code']);
//            if ($data['mobile'] !=session('mobileUser')){
//                //$this->error("请填写您短信验证成功验证的手机号!");
//                return ['code'=>0,'msg'=>'请填写您短信验证成功验证的手机号'];
//            }
            //validate验证机制
            $validate=validate('Member');
            if(!$validate->scene('register')->check($data)){
                $this->error($validate->getError());
                //return ['code'=>0,'msg'=>$validate->getError()];
            }
            $data['password']=md5($data['password']);
            $data['time']=time();
            $data['ip']=request()->ip();
            $data['agent']='小唐';

            $register=Db::name('member')->insert($data);
            $userId = Db::name('member')->getLastInsID();
            if ($register){
                session('user_id',$userId);
                session('user_mobile',$data['mobile']);
                session('user_name',$data['name']);
                //$this->success('恭喜你!注册成功','welcome');
                return ['code'=>1,'msg'=>'恭喜你!注册成功'];
            }else{
                //$this->error('抱歉注册失败');
                return ['code'=>0,'msg'=>'抱歉注册失败'];
            }
        }


        $cacheTime=86400*7;
        if (cache('projectRes')){
            $projectRes=cache('projectRes');
        }else{
            $projectRes=Db::name('project')->where('status',1)->order('sort ASC')->select();
            cache('projectRes',$projectRes,$cacheTime);
        }
        $this->assign([
            'projectRes'=>$projectRes,
        ]);

        return view();
    }

    public function welcome(){

        echo "恭喜您!注册成功";
    }



    // 验证码检测 验证码
    public function check($code='')
    {
        if (!captcha_check($code)) {
            $this->error('验证码填写错误');
        } else {
            return true;
        }
    }
}
