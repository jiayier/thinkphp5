<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
//Route::resource('blog','index/blog');
use think\Route;
//Route::resource('article','admin/blog',['var'=>['blog'=>'blog_id']]);
Route::resource('article','admin/blog',['var'=>['blog'=>'blog_id']]);
Route::resource('articleDetail','admin/ArticleDetail',['var'=>['blog'=>'blog_id']]);
Route::resource('test','admin/test',['var'=>['blog'=>'blog_id']]);
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    '__rest__'=>[
        // 指向index模块的blog控制器
        'article'=>'admin/blog',
    ],

];
