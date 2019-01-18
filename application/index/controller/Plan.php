<?php
namespace app\index\controller;

use think\Controller;


class Plan extends Controller{
    public function plan(){
        $member=db('ims_ewei_shop_member')->where("isagent=1 and agenttype=1")->select();
        foreach($member as $v){
            $agenttime=date('md',$v['agenttime']);
            $time=date('md',time());
            if($agenttime==$time && date('Y',$v['agenttime'])<date('Y',time())){
                db('ims_ewei_shop_member')->where("id={$v['id']}")->update(array( "credit3" => $v['credit4'] ));
            }
        }
        $members=db('ims_ewei_shop_member')->where("isagent=1 and agenttype=0")->select();
        foreach($members as $vs){
            if($vs['credit3']==0){
                // $data['isagent']=0;
                db('ims_ewei_shop_member')->where("id={$vs['id']}")->update(array( "isagent" => 0 ));
            }
        }
    }
}