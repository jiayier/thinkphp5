<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 9:30
 * Auther sl
 */

namespace app\index\controller\one;
use think\Controller;
use think\Request;
use app\common\model\MyLog;

class Common extends Controller
{

    public $url;
    public $LogModel = '';
     function __construct (Request $request){
         parent::__construct($request);
        $this->url=Request::instance()->url();
        $this->LogModel = new MyLog();
    }




}