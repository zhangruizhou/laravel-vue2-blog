<?php
/**
 * Created by PhpStorm.
 * User: zhangruizhou
 * Date: 2017/3/15
 * Time: 下午2:24
 */

namespace App\Models;

class ArticleModel extends BaseModel
{
    protected $table = 'articles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'author', 'cover', 'user_id', 'intro', 'content', 'category_id'
    ];

}