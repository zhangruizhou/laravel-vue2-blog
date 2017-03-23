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
use Illuminate\Support\Facades\Storage;

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
        return $this->getSuccess('success', ['article'=>$article]);
    }

    public function store(Request $request){

        $rules = [
            'title' => 'required',
            'intro' => 'required',
            'cover' => 'required',
            'content' => 'required',
        ];
        $data = $request->only('title','cover','category_id','intro','content');
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->getError($validator->errors()->first());
        }
        $data['author'] = 'ruizhou';
        $data['user_id'] = 1;
        $articleId = $this->articleRepository->create($data);
        return $articleId > 0 ? $this->getSuccess('success',['id'=>$articleId]) : $this->getError('添加文章失败，请稍后再试');
    }

    public function cover(Request $request){
        $rules = [
            'photo' => 'max:2048|mimes:jpg,jpeg,png,gif',
        ];
        $data = $request->only('cover');
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->getError($validator->errors()->first());
        }
        $file = $request->file('cover');
        $filename = 'uploads/' . date("Ymd") . '/' . md5(time()) . '.' . $file->getClientOriginalExtension();
        $res = Storage::disk('qiniu')->writeStream($filename, fopen($file->getRealPath(),'r'));
        if ($res != 1) {
            return $this->getError('上传图片失败!');
        }
        $fileUrl = '//'.config('filesystems.disks.qiniu.domain') . '/' . $filename . '-indexthumb';
        return $this->getSuccess('success',['photo_url'=>$fileUrl]);
    }

    public function update($id){
        $rules = [
            'title' => 'required',
            'intro' => 'required',
            'content' => 'required',
        ];
        $data = app('request')->only('title','cover','category_id','intro','content');
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->getError($validator->errors()->first());
        }
        $data['cover'] = 'a.jpg';
        $res = $this->articleRepository->update(['id'=>$id], $data);
        return $res ? $this->getSuccess('success', []) : $this->getError('删除失败！');
    }

    public function delete($id){
        $res = $this->articleRepository->update(['id'=>$id], ['status'=>0]);
        return $res ? $this->getSuccess('success', []) : $this->getError('删除失败！');
    }
}