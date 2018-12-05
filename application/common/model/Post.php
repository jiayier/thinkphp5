<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/22
 * Time: 9:47
 * Auther sl
 */

namespace app\common\model;
use think\Model;

class Post extends Model
{
  public  function post($url, $data=[])
    {
        $postdata = http_build_query(
            $data
        );

        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        try {
            $context = stream_context_create($opts);
            $result = file_get_contents($url, false, $context);
            return $result;

        } catch (\Exception $e) {
            echo  $e->getMessage();
            return false;
        }
    }
  public  function request_post($url = '', $param = '') {

//        if (empty($url) || empty($param)) {
//
//            return false;
//
//        }



        $postUrl = $url;

        $curlPost = $param;

        $ch = curl_init();//初始化curl

        curl_setopt($ch, CURLOPT_URL,$postUrl);//抓取指定网页

        curl_setopt($ch, CURLOPT_HEADER, 0);//设置header

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//要求结果为字符串且输出到屏幕上

        curl_setopt($ch, CURLOPT_POST, 1);//post提交方式

        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);

        $data = curl_exec($ch);//运行curl

        curl_close($ch);

        // echo 'fasdfasdf';

        return $data;

    }
}



