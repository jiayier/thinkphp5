<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/4
 * Time: 10:53
 * Auther sl
 */

namespace app\admin\controller;


use app\common\controller\CommonController as Common;
use think\Request;

class User extends Common
{
    public function login(Request $request){
        $lang =         cookie('think_var'); //语言
        $this->assign('title',getTitle());//标题
        $this->assign('lang',$lang);
        $this->assign('info',getInfo());

        return $this->fetch();
    }
}