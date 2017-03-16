<?php
/**
 * Created by PhpStorm.
 * User: zhangruizhou
 * Date: 2017/3/15
 * Time: 下午2:38
 */
namespace App\Repositories;

use App\Models\ArticleModel;
use App\Models\CategoryModel;
use Illuminate\Database\QueryException;

class ArticleRepository extends BaseRepository
{
    public $articleModel;
    public $categoryModel;

    public function __construct(
        ArticleModel $articleModel,
        CategoryModel $categoryModel
    )
    {
        $this->articleModel = $articleModel;
        $this->categoryModel = $categoryModel;
    }

    public function getList($where, $fields=['*'], $page, $pagesize, $orderBy){
        $articles['count'] = $this->articleModel->countBy($where);
        $articles['list']  = $this->getListCategory($this->articleModel->lists($fields, $where, $orderBy, [], $pagesize, $page));
        return $articles;
    }

    protected function getListCategory($articleList){
        if (empty($articleList)) {
            return $articleList;
        }
        foreach ($articleList as $key => $article) {
            if (!isset($category[$article['category_id']])) {
                $category[$article['category_id']] = $this->categoryModel->where(['id' => $article['category_id']])->first();
            }
            $articleList[$key]['category_name'] = $category[$article['category_id']]['name'];
        }
        return $articleList;
    }

    /**
     * @param $data
     * @return int
     */
    public function create(array $data){
        try {
            $article = $this->articleModel->create($data);
            return $article->id;
        } catch (QueryException $e) {
            return 0;
        }
    }

    /**
     * @param array $where
     * @param array $data
     * @return bool|mixed
     */
    public function update(array $where, array $data){
        try {
            //return $this->articleModel->updateBy($data, $where);
            return $this->articleModel->where($where)->update($data);
        } catch (QueryException $e) {
            return false;
        }
    }

}