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
use itbdw\QiniuStorage\QiniuStorage;

class UploadController extends AdminController
{

    public function image(Request $request){

        $disk = QiniuStorage::disk('qiniu');
        //urlsafe_base64_encode();
        $a  = sha1('http://omy5cc3ne.bkt.clouddn.com/核验单.jpeg','MY_SECRET_KEY');
        $abd = \Qiniu\base64_urlSafeEncode($a);
        $Token = 'MY_ACCESS_KEY:'.$abd;
        $url = 'http://omy5cc3ne.bkt.clouddn.com/核验单.jpeg';
        print_r($url . '?e='.time().'&token='.$Token);die;

        $file  = $request->file('photo');
        $filePath = date("Y-m-d");
        $fileName = date("YmdHis")  . '-';
        $res = $disk->put($filePath , $file);


        return $this->getSuccess('success',['photo_url'=>$res]);;
        //$fileUrl = env('IMAGES_URL') . $filePath .'/'. $fileName;

        //return $this->getSuccess('success',['photo_url'=>$fileUrl]);
    }
}