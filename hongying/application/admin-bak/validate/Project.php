<?php
namespace app\admin\validate;

use think\Validate;

class Project extends Validate
{
    protected $rule = [
        'name' => 'require|unique:project',

    ];

    protected $message = [
        'name.require' => '项目名称不得为空！',
        'name.unique' => '项目名称不得重复！',

    ];

    protected $scene=[

        'add'=>['name'],
        'edit'=>['name'],
    ];

}
