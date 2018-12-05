<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/29
 * Time: 10:32
 * Auther sl
 */

namespace app\index\model;


use think\Model;

class Article extends Model
{
    protected $table = 'dp_article_list';
    public function ArticleDetail()
    {
        return $this->belongsTo("ArticleDetail", "article_id", "art_id", [], 'LEFT');
    }


}