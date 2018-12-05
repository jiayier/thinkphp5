<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/28
 * Time: 16:15
 * Auther sl
 */

namespace app\common\model;

use   app\common\model\MyTi;
use   app\common\model\MyTi1;
use   think\Model;


class MyLog extends Model implements  MyTi,MyTi1,LogHandle
{
    private $Handle='';
    function __construct($file='')
    {
        if (empty($file)){
            $file = self::FILE_BASE_PATH.DS.date('Y-m-d').'.log';
        }
        $ss =  strrpos($file, '.') ? substr($file, strrpos($file, '.')+1) : '';//后缀
        if (!in_array($ss,['log','test'])){
            return false;
        }
        if (!file_exists(dirname($file))){
            $this->mkdirs(dirname($file));
        }
        $this->Handle = fopen($file,'a');
    }


    public function add($data){
     //  echo 'add';
    //  echo self::CAND;
     //  var_dump($data);
   }
   public function edit()
   {
     //  echo 'I am Edit';
       // TODO: Implement edit() method.
   }

    /**
     * 打印
     * @param $data
     * @param int $lvevl
     * @auther sl
     */
   public static function  write($data, $lvevl = 0)
   {
       try {
           if (is_array($data)){
               $msg = json_encode($data);
           }else if (is_string($data)){
               $msg = $data;
           }else{
               $msg = $data;
           }
           $msg = '[' . date('Y-m-d H:i:s') . '][' . self::LEVEL[$lvevl] . '] ' . "\n". $msg . "\n";
           $ss = new self();
           fwrite($ss->Handle, $msg, 4096);
       } catch (\Exception $e) {
           echo  $e->getMessage();
           return false;
       }
       // TODO: Implement write() method.
   }
    /**
     *
     */
    public function __destruct()
    {
        fclose($this->Handle);
    }
    /**
     * 创建路径
     * @param $path
     * @param int $methd
     * @auther sl
     * @return bool
     */
   private function mkdirs($path,$methd=777){
       if (!is_dir($path)) {
           $this->mkdirs(dirname($path));
           mkdir($path,$methd);
       }
       return is_dir($path);
   }

}