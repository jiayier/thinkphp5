<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/30
 * Time: 9:16
 * Auther sl
 */

namespace app\admin\logicModel;


interface Titly
{
    public function myAdd($data,$type);
    public function myGetList($type);
    public function myEdit($data);
    public function myDelete($id);
}