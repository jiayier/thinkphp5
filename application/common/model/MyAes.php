<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/4
 * Time: 17:12
 * Auther sl
 */

namespace app\common\model;

use AES\AES;

trait MyAes
{
    private $AesModel = '';

    /**
     * 初始化
     * @auther sl
     */
    protected function instans()
    {
        if (empty($this->AesModel)) {
            $this->AesModel = new AES();
        }
    }

    /**
     * 加密
     * @param $dataStr
     * @auther sl
     * @return string
     */
    public function encode($dataStr)
    {
       $this->instans();
       $re = $this->AesModel->encode($dataStr);
        return base64_encode($re);
    }

    /**
     * 解密
     * @param $dataStr
     * @param string $type
     * @auther sl
     * @return bool|string
     */
    public function decode($dataStr,$type='json')
    {
        $this->instans();
        $re =  $this->AesModel->decode($dataStr);
        $length = strlen($re);
        $length = $type === 'json'? $length-11 : $length-3;//截取要根据实际情况判断
         //MyLog::write($length.'===>'.$type);
        return substr($re,0,$length);

    }
}