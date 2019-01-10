<?php
namespace app\index\controller;

use think\Controller;


class Index extends Controller
{
    public function _initialize()
    {
        $uid=input('uid');
        $uid=1;
        if(empty($uid)){
           if(empty(session('uid'))){
               $this->redirect('http://zdl.dd371.com/app/index.php?i=2&c=entry&m=ewei_shopv2&do=mobile&r=member');
           }
        }else{
            session("uid",$uid);
        }
    }
    public function index()
    {
        $res=db("");
        return $this->fetch();
    }
}