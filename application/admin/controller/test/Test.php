<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 17:18
 * Auther sl
 */

namespace app\admin\controller;


class Test
{
    function __construct()
    {
        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:POST,GET,PUT');
    }


    public function read($id)
    {


        return json(['id'=>$id]);

    }
    public function edit($id)
    {


        return json(['id'=>$id]);

    }
  public function update($id)
    {


        return json(['id'=>$id]);

    }






}