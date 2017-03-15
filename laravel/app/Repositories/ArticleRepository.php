<?php
/**
 * Created by PhpStorm.
 * User: zhangruizhou
 * Date: 2017/3/15
 * Time: 下午2:38
 */
namespace App\Repositories;

use App\Models\ArticleModel;
use Illuminate\Database\QueryException;

class ArticleRepository extends BaseRepository
{
    private $articleModel;

    public function __construct(
        ArticleModel $articleModel
    )
    {
        $this->articleModel = $articleModel;
    }

    public function getList($where, $fields=['*'], $page, $pagesize, $orderBy){

        $articles['count'] = $this->articleModel->countBy($where);
        $articles['list']  = $this->articleModel->lists($fields, $where, $orderBy, [], $pagesize, $page);
        return $articles;
    }

    /**
     * @param $data
     * @return int
     */
    public function create(array $data){
        try {
            $articleId = $this->articleModel->saveBy($data);
            return $articleId;
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
            return $this->articleModel->updateBy($data, $where);
        } catch (QueryException $e) {
            return false;
        }
    }

}