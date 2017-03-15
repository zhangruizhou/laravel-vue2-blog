<?php
/**
 * Created by PhpStorm.
 * User: zhangruizhou
 * Date: 2017/3/15
 * Time: 下午2:32
 */
namespace App\Repositories;

class BaseRepository
{
    /**
     * @param $status
     * @param $message
     * @param array $data
     * @return array
     */
    public function getResult($status, $message, $data=[])
    {
        return ['status'=>$status, 'message'=>$message, 'data'=>$data];
    }

    public function getSuccess($message, $data)
    {
        return $this->getResult(1, $message, $data);
    }

    public function getError($message){
        return $this->getResult(0, $message, []);
    }
}