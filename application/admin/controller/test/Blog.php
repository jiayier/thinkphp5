<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 14:25
 * Auther sl
 */

namespace app\admin\controller;
use think\Request;
use app\admin\logicModel\ArticleLogic;
class Blog
{
    private $LogicModel='';
    function __construct()
    {

        if (empty($this->LogicModel)){
            $this->LogicModel = new ArticleLogic();
        }
    }
    public function index(Request $request)
    {
        return json($this->LogicModel->getOne($request->param()));
    }
    public function read($id)
    {
        return json( $this->LogicModel->getOne($id));
    }
    public function update(Request $request,$id){
        return json(['id'=>$id,'update'=>$request->method(),'data'=>$request->param()]);
    }
    public function edit(Request $request,$id){
        return json(['id'=>$id,'re'=>$request->method(),'data'=>$request->param()]);
    }
    /**
     * @param Request $request
     * @auther sl
     * @return \think\response\Json
     */
    public function save(Request $request){
        return json( $this->LogicModel->saveArticle($request->param()));
    }
}