<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 17:57
 * Auther sl
 */

namespace app\admin\model;


use think\Model;

class ArticleDetail extends Model
{
    protected $table = 'dp_article_detail';

    public function Article()
    {
        //hasMany('关联模型名','外键名','主键名',['模型别名定义']);
        //hasMany('关联模型名','cate的外键名','cate的主键名',['模型别名定义']);
        //cate的主键是id，article的外键是cateid，关联cate的id主键，article的外键是cateid
        return $this->hasMany("Article", "id", "id");
    }
}