<?php
namespace app\index\validate;

use think\Validate;

class Member extends Validate
{
    protected $rule = [
        'mobile' => 'require|unique:member|mobile|number',
        'password' => 'require',
        'name' => 'require',
    ];

    protected $message = [
        'mobile.require' => '用户名(手机号)必须填写！',
        'mobile.unique' => '该用户名(手机号)已注册过！请勿重复注册！',
        'mobile.mobile' => '手机号格式错误！',
        'mobile.number' => '请填写正确的手机号！',
        'password.require' => '密码必须填写！',
        'name.require' => '真是姓名必须填写！',

    ];
    //验证手机号格式
    protected $regex = [
        'mobile'    => '/^1[34578]{1}\d{9}$/',
    ];

    protected $scene=[
        'register'=>['mobile','password','name'],
    ];



}
