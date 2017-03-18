<?php
/**
 * Created by PhpStorm.
 * User: zhangruizhou
<<<<<<< Updated upstream
 * Date: 2017/3/17
 * Time: 上午9:49
=======
 * Date: 17/3/16
 * Time: 下午11:24
>>>>>>> Stashed changes
 */
namespace App\Api\Controllers\Admin;

use App\Api\Controllers\AdminController;
use App\Repositories\ArticleRepository;

class CategoryController extends AdminController
{
    protected $articleRepository;

    public function __construct(
        ArticleRepository $articleRepository
    )
    {
        $this->articleRepository = $articleRepository;
    }

    public function index(){
        $category = $this->articleRepository->categoryModel->alls()->toArray();
        foreach ($category as $key=>$value) {
            $category[$key]['id'] = (string) $value['id'];
        }

        $category = $this->articleRepository->categoryModel->alls(['*'],['status'=>1]);
        return $this->getSuccess('success',['category'=>$category]);
    }
}