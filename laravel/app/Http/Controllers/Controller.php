<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
