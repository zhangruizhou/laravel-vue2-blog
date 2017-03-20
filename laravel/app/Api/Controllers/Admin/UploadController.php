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

class UploadController extends AdminController
{

    public function image(Request $request){

        $file = $request->file('photo');
        $filename = 'uploads/' . date("Ymd") . '/' . md5(time()) . '.' .$file->getClientOriginalExtension();
        $res = Storage::disk('qiniu')->writeStream($filename, fopen($file->getRealPath(),'r'));
        $fileUrl = 'http://'.config('filesystems.disks.qiniu.domain') . '/' . $filename;
        return $this->getSuccess('success',['photo_url'=>$fileUrl]);
    }
}