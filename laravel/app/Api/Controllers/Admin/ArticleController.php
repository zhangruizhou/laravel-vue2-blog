<?php
/**
 * Created by PhpStorm.
 * User: zhangruizhou
 * Date: 2017/3/15
 * Time: 上午11:08
 */
namespace App\Api\Controllers\Admin;

use App\Api\Controllers\AdminController;
use App\Repositories\ArticleRepository;

class ArticleController extends AdminController {

    public function __construct(
        ArticleRepository $articleRepository
    )
    {
        parent::__construct();
        $this->articleRepository = $articleRepository;
    }

    /**
     * 文章列表
     * @return array
     */
    public function index(){

        $where = ['status' => 1];
        $articles = $this->articleRepository->getList($where, ['*'], 1, 20, ['id'=>'desc']);
        return $this->getSuccess('success', $articles);
    }

    public function store(){

    }

    public function update(){

    }

    public function delete($id){

    }
}