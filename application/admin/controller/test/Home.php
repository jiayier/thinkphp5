<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 11:15
 * Auther sl
 */

namespace app\admin\controller;
use  app\admin\controller\Common_admin;
use think\Request;

class Home extends Common_admin
{
    public function index()
    {
        $this->assign('title','首页');
        return $this->fetch();
    }
    public function detail()
    {
        $this->assign('title','详情');
        $this->assign('article_id',1);
        return $this->fetch();
    }

    public function test(Request $request)
    {

        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:POST,GET,PUT');
        return json(['asdfasdf'=>$request->method()]);
        
    }
}