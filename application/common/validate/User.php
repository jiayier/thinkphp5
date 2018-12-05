<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/26
 * Time: 13:59
 * Auther sl
 */

namespace app\common\validate;

use think\Validate;
class User extends Validate
{
    protected $rule = [
        'name'  => 'require|max:25',
        'age'   => 'number|between:1,120',
        'email' => 'email',
        'captcha' => 'require|captcha',
        '__token__'=>'require|token'
    ];
    protected $msg = [
'name.require' => '名称必须',
'captcha.require' => '验证码必须',
'name.max'     => '名称最多不能超过25个字符',
'age.number'   => '年龄必须是数字',
'age.between'  => '年龄必须在1~120之间',
'email'        => '邮箱格式错误',
'__token__.require'        => 'token不能为空',
];

}