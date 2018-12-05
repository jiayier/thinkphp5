<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/13
 * Time: 14:45
 * Auther sl
 */

namespace app\admin\model;

use think\Model;

class Article extends Model
{
    // 设置当前模型对应的完整数据表名称
    protected $table = 'dp_article_list';
    public function ArticleDetail()
    {
        return $this->belongsTo("ArticleDetail", "article_id", "art_id", [], 'LEFT');
    }
}