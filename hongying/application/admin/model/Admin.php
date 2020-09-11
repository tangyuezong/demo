<?php
namespace app\admin\model;
use think\Model;
class Admin extends Model
{
   public function login($data){
       $uname=$data['admin_name'];
       $password=md5($data['admin_password']);
       $admins=Admin::get(['admin_name'=>$uname]);
       if($admins){
           $_password=$admins['admin_password'];
           if($_password==$password){
               if($admins['status']==0){
                   return 4;//管理员被禁用
               }
               session('admin_name',$uname);
               session('admin_id',$admins['id']);
               return 1;//密码正确可以登录
           }else{
               return 2;//密码出错
           }
       }else{
           return 3;//用户不存在
       }
   }


}


