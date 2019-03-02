<?php
namespace app\index\controller;

use think\Controller;


class User extends Controller
{
    function userlist(){
        $user=db('ims_ewei_shop_member')->paginate(20);
        foreach($user as $k=>$v){
            $uniacid=$v['uniacid'];
            $uniac=db('ims_account_wechats')->where("uniacid=$uniacid")->value('name');
            $v['uniac']=$uniac;
            $user[$k]=$v;
        }
        $this->assign('user',$user);
        return $this->fetch();
    }
}