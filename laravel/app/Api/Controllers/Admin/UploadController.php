<?php
/**
 * Created by PhpStorm.
 * User: zhangruizhou
 * Date: 2017/3/17
 * Time: 下午3:29
 */
namespace App\Api\Controllers\Admin;

use App\Api\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Validator;

class UploadController extends AdminController
{

    public function image(Request $request){
        $rules = [
            'photo' => 'max:2048|mimes:jpg,jpeg,png,gif',
        ];
        $data = $request->only('photo');
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return $this->getError($validator->errors()->first());
        }
        $file = $request->file('photo');
        $filename = 'uploads/' . date("Ymd") . '/' . md5(time()) . '.' . $file->getClientOriginalExtension();
        $res = Storage::disk('qiniu')->writeStream($filename, fopen($file->getRealPath(),'r'));
        if ($res != 1) {
            return $this->getError('上传图片失败!');
        }
        $fileUrl = '//'.config('filesystems.disks.qiniu.domain') . '/' . $filename . '-indexthumb';
        return $this->getSuccess('success',['photo_url'=>$fileUrl]);
    }
}