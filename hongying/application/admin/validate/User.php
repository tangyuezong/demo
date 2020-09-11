<?php
namespace app\admin\validate;

use think\Validate;

class User extends Validate
{
    protected $rule = [
        'name' => 'require|max:25',
        'ticheng' => 'require|number|between:0,40',


    ];

    protected $message = [
        'name.require' => '姓名不得为空！',
        'name.max' => '姓名最多不能超过20个字符！',
        'ticheng.require' => '提成不得为空！',
        'ticheng.number' => '提成必须为数字！',
        'ticheng.between' => '提成比例必须在不能大于40%！',


    ];

    protected $scene=[

        'add'=>['name','ticheng'],
        'edit'=>['name','ticheng'], //可以不填，但是填了不能小于6位
    ];

}
