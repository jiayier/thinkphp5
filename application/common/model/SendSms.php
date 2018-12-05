<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/12/4
 * Time: 13:43
 * Auther sl
 */

namespace app\common\model;


class SendSms
{
    private $appkey = '23736637';
    private $secretKey = '330de4cf0370495a3d09e21f7354fd8e';
    private $c;
    private $req;
    private $smsTemplateCode = 'SMS_58730027';
    private $signName = '微猴科技';

    function __construct($appkey='',$secretKey='')
    {
        if (!empty($appkey) && !empty($secretKey)){
            $this->appkey = $appkey;
            $this->secretKey = $secretKey;
        }
    }
    /**
     * @param $mobile
     * @param $content
     * @auther sl
     */
    public  function sendSms($mobile,$content){
        if (!is_phone($mobile)){
            return false;
        }


        include EXTEND_PATH.'sdk-php-dayu/TopSdk.php';//这是载入阿里大鱼
        $c = new \TopClient();
        $c->appkey =$this->appkey;
        $c->secretKey = $this->secretKey;
        $req = new \AlibabaAliqinFcSmsNumSendRequest();
        $req->setSmsType("normal");
        $req->setSmsFreeSignName($this->signName);//你在阿里大于设置的那个
        $req->setSmsParam($content);//我只是用来做验证码，因此只有这一个
        $req->setRecNum($mobile);//手机号码
        $req->setSmsTemplateCode($this->smsTemplateCode);//自己的编号
        $resp = $c->execute($req);
        return $resp;
    }
}