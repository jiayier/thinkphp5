<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/3
 * Time: 17:11
 * Auther sl
 */

namespace app\common\behavior;
class CheckLang
{
    public function run(&$params){
        cookie('think_var',$this->getLang());
    }
    /**
     * 获取语言
     * @auther sl
     * @return string
     */
    private function getLang(){
        $lang = empty($_GET['lang']) ?  'en':$_GET['lang'];
        return $lang;
    }
}