<?php
namespace app\admin\validate;
use think\Validate;
class Admin extends Validate
{
    protected $rule = [
        'admin_name' => 'require|unique:admin|max:15',
        'admin_password' => 'require|min:6',
    ];

    protected $message = [
        'admin_name.require' => '管理员名称不得为空！',
        'admin_name.unique' => '管理员名称不得重复！',
        'admin_name.max' => '管理员名称长度不能大于15个字符！',
        'admin_password.require' => '管理员密码不得为空！',
        'admin_password.min' => '管理员密码不得小于6位！',

    ];

    protected $scene=[
        'add'=>['admin_name','admin_password'],
        'edit'=>['admin_name','admin_password'=>'min:6'],
    ];


}