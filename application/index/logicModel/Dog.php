<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/23
 * Time: 10:05
 * Auther sl
 */
namespace app\index\logicModel;

trait Dog{
 //   public $name="dog";
    public function drive(){
        echo "This is dog drive";
    }
    public function eat(){
        echo "This is dog eat";
        return 's';
    }
}