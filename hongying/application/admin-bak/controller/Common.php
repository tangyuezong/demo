<?php
namespace app\admin\controller;
use think\Controller;

class Common extends Controller
{
    public function _initialize()
    {
        if(!$this->ischecklogin()){
            $this->redirect("admin/Login/index");
        }
    }
    public function isCheckLogin(){
        if(session('admin_id') && session('admin_name')){
            return true;
        }
        return false;
    }

}
