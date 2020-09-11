<?php
namespace app\admin\controller;

use think\Controller;
use think\Db;

class Admin extends Common
{
    public function index()
    {
        $adminRes=Db::name('admin')->order('id ASC')->paginate();
        $this->assign([
            'adminRes'=>$adminRes,
        ]);
        return view();
    }
    public function add()
    {
        if (request()->isPost()){
            $data=input('post.');
            $validate=validate('admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            $data['admin_password']=md5($data['admin_password']);
            $data['create_time']=time();
            $data['last_time']=time();
            $add=Db::name('admin')->insertGetId($data);
            if ($add){
                return ['code'=>1,'msg'=>'添加管理员成功!'];
            }else{
                return ['code'=>0,'msg'=>'添加管理员失败!'];
            }
        }
        return view();
    }
    public function edit(){
        if (request()->isPost()){
            $data=input('post.');
            $validate=validate('admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            if ($data['admin_password']){
                $data['admin_password']=md5($data['admin_password']);
            }else{
                unset($data['admin_password']);
            }
            $save=Db::name('admin')->update($data);
            if ($save !==false){
                return ['code'=>1,'msg'=>'修改管理员成功!'];
            }else{
                return ['code'=>0,'msg'=>'修改管理员成功!'];
            }
        }
        $id=input('id');
        $admins=Db::name('admin')->field('id,admin_name,status,groupid')->find($id);
        $this->assign([
            'admins'=>$admins,
        ]);
        return view();
    }
    public function del($id){
        if ($id==1){
            $this->error('超级管理员不允许删除');
        }
        $del=Db::name('admin')->delete($id);
        if ($del){
            return ['code'=>1,'msg'=>'删除管理员成功!'];
        }else{
            return ['code'=>0,'msg'=>'删除管理员失败!'];
        }
    }
    /*Ajax异步修改管理员状态*/
    public function changestatus(){
        $id=input('id');
        $admins=Db::name('admin')->field('status')->find($id);
        $status=$admins['status'];
        if ($status==1){
            Db::name('admin')->where(array('id'=>$id))->update(['status'=>0]);
        }else{
            Db::name('admin')->where(array('id'=>$id))->update(['status'=>1]);
        }
    }


    //退出登录功能
    public function logout(){
        session('admin_name',null);
        session('admin_id',null);
        $this->success('退出成功！','login/index');
    }






}
