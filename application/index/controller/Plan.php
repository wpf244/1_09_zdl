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

    function chan(){
        $data['uniacid']=5;
        // $res=db('ims_ewei_shop_member')->where("uniacid=2")->update($data);
        // $res1=db('ims_mc_members')->where("uniacid=2")->update($data);
        // $res=db('ims_ewei_shop_member_level')->where('uniacid=2')->update($data);
        // $res=db('ims_mc_mapping_fans')->where('uniacid=2')->update($data);
        dump($res);
    }
}