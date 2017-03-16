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
use Illuminate\Http\Request;
use Validator;

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

    public function detail($id){
        $article = $this->articleRepository->articleModel->where(['id'=>$id])->first();
        $category = $this->articleRepository->categoryModel->alls(['id','name'],['status'=>1]);
        return $this->getSuccess('success', ['article'=>$article,'category'=>$category]);
    }

    public function store(Request $request){

        $rules = [
            'title' => 'required',
            'intro' => 'required',
            'content' => 'required',
        ];
        $data = $request->only('title','cover','category_id','intro','content');
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->getError($validator->errors()->first());
        }
        $data['cover'] = 'a.jpg';
        $data['author'] = 'ruizhou';
        $data['user_id'] = 1;
        $articleId = $this->articleRepository->create($data);
        return $articleId > 0 ? $this->getSuccess('success',['id'=>$articleId]) : $this->getError('添加文章失败，请稍后再试');
    }

    public function update(){

    }

    public function delete($id){
        $res = $this->articleRepository->update(['id'=>$id], ['status'=>0]);
        return $res ? $this->getSuccess('success', []) : $this->getError('删除失败！');
    }
}