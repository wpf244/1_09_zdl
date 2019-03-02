<?php
namespace app\index\controller;

use think\Controller;


class Index extends Controller
{
    public function _initialize()
    {
        $uid=input('uid');
        $uniacid=input('uniacid');
        if(empty($uid)){
           if(empty(session('uid'))){
               $this->redirect('http://zdl.dd371.com/app/index.php?i='.$uniacid.'&c=entry&m=ewei_shopv2&do=mobile&r=member');
           }
        }else{
            session("uid",$uid);
        }
    }
    public function lister()
    {
        $uid=session("uid");
        // dump($uid);die;
        $user=db("ims_snake_chatuser")->where("uid=$uid")->find();
        $more=input("more");
        $groupid=input('groupid');
        $group=db('ims_snake_chatgroup')->where("id=$groupid")->find();
        if($user){
            // $groupid=$user['groupid'];
            $count=db("ims_snake_chatuser")->where("groupid=$groupid")->count();
            if($count >= 500){
                $del=db("ims_snake_chatuser")->where("groupid=$groupid")->order("id asc")->limit(1)->find();
                if($del){
                    db("ims_snake_chatuser")->where("id={$del['id']}")->delete();
                }
            }
            if(empty($more)){
                $res=db("ims_snake_chatlog")->where("group_id=$groupid")->order("id desc")->limit("0,10")->select();
            }else{
                $res=db("ims_snake_chatlog")->where("group_id=$groupid")->order("id desc")->select();
            }
            
            foreach($res as $k => $v){
                $uids=$v['uids'];
                $uid_arr=explode(",",$uids);
                if(!\in_array($uid,$uid_arr)){
                    $uid_arr[]=$uid;
                    $str=implode(",",$uid_arr);
                    db("ims_snake_chatlog")->where("id={$v['id']}")->update(['uids'=>$str]);                    
                }
                $packet=$v['packet'];
                $packets=explode(",",$packet);
                if($v['status'] == 1){
                    $res[$k]['red']=1;
                }else{
                    if(\in_array($uid,$packets)){
                        $res[$k]['red']=1;
                    } else{
                        $res[$k]['red']=0;
                    }
                }
              
            }
            $last_names = array_column($res,'id');
            array_multisort($last_names,SORT_ASC,$res);
            $this->assign('group',$group);
            $this->assign("res",$res);
            $this->assign("uid",$uid);
            $this->assign("user",json_encode($user));
    
            $cou=db("ims_snake_chatuser")->where("groupid=$groupid")->count();
            $this->assign("cou",$cou);

            $this->assign("groupid",$groupid);
    
            return $this->fetch();
        }
        else{
            alerts("还没有加入群聊","http://zdl.dd371.com/app/index.php?i=".$uniacid."&c=entry&m=ewei_shopv2&do=mobile&r=member");
        }
    
    }
    public function index(){
        $uid=session('uid');
        // $uid=123;

        
        $group=db('ims_snake_chatuser')->where("uid=$uid")->select();
        foreach($group as &$v){
            $gid=$v['groupid'];
            $groupname=db('ims_snake_chatgroup')->where("id=$gid")->find();
            $v['groupname']=$groupname['groupname'];
            $v['gid']=$groupname['id'];
            $v['time']=date('Y-m-d H:i:s',$v['time']);

            $re=db("ims_snake_chatlog")->where("!FIND_IN_SET($uid,uids)")->where("group_id",$gid)->select();
            if($re){
                $v['hong']=1;
            }else{
                $v['hong']=0;
            }
        }
        $this->assign('list',$group);
        return $this->fetch();
    }
    public function getinfo()
    {
        $id=input('id');
        $re=db("ims_snake_chatlog")->where("id=$id")->find();
        if($re){
            echo json_encode($re);
        }else{
            echo '0';
        }
    }
    public function saveinfo()
    {
        $uid=session("uid");
        $user=db("ims_snake_chatuser")->where("uid=$uid")->find();
        $data['content']=input('content');
        $data['fromid']=$uid;
        $data['fromname']=$user['nickname'];
        $data['fromavatar']=$user['avatar'];
        $data['group_id']=input('groupid');
        $data['timeline']=time();
        $arr[]=$uid;
        $atr=\implode(",",$arr);
      //  var_dump($atr);exit;
        $data['uids']=$atr;
        $re=db("ims_snake_chatlog")->insert($data);
        if($re){
            echo '1';
        }else{
            echo '0';
        }
    }
    public function getNewsInfo()
    {
        $uid=session("uid");
        $map='FIND_IN_SET("$uid",uids)';
        $res=db("ims_snake_chatlog")->where("!FIND_IN_SET($uid,uids)")->order("id asc")->select();  
        if($res){
            foreach($res as $k => $v){
                $uids=$v['uids'];
                $uid_arr=explode(",",$uids);
                if(!\in_array($uid,$uid_arr)){
                    $uid_arr[]=$uid;
                    $str=implode(",",$uid_arr);
                    db("ims_snake_chatlog")->where("id={$v['id']}")->update(['uids'=>$str]);                    
                } 
            }
            echo json_encode($res);
        }else{
            echo '0';
        }
    }
    //红包
    public function packets()
    {
        $id=input('id');
        $re=db("ims_snake_chatlog")->where("id=$id")->find();
        $uid=session('uid');
        $user=db("ims_snake_chatuser")->where("uid=$uid")->find();
        if($re){
            if($re['status'] == 0){
                $packet=db("ims_snake_packet")->where("log_id=$id")->find();
                if($packet){
                    $rep=db("ims_snake_packet")->where("log_id=$id and uid=$uid")->find();
                    if($rep){
                        $uids=$re['packet'];
                        $uid_arr=explode(",",$uids);
                        if(!\in_array($uid,$uid_arr)){
                            $uid_arr[]=$uid;
                            $str=implode(",",$uid_arr);
                            db("ims_snake_chatlog")->where("id=$id")->update(['packet'=>$str]);                    
                        }
                        
                        $this->redirect("packet",array('id'=>$id));
                    }else{
                        $rea=db("ims_snake_packet")->where("log_id=$id and status=0")->order("id asc")->find();
                        if($rea){
                            $datas['uid']=$uid;
                            $datas['nickname']=$user['nickname'];
                            $datas['avatar']=$user['avatar'];
                            $datas['time']=time();
                            $datas['status']=1;
                            db("ims_snake_packet")->where("id={$rea['id']}")->update($datas);

                            $uids=$re['packet'];
                            $uid_arr=explode(",",$uids);
                            if(!\in_array($uid,$uid_arr)){
                                $uid_arr[]=$uid;
                                $str=implode(",",$uid_arr);
                                db("ims_snake_chatlog")->where("id=$id")->update(['packet'=>$str]);                    
                            }
                            //用户增加余额
                            $member=db("ims_ewei_shop_member")->where("id=$uid")->find();
                            if($member['uid']==0){
                                db("ims_ewei_shop_member")->where("id=$uid")->setInc("credit2",$rea['money']);
                            }else{
                                $member_id=$member['uid'];
                                db('ims_mc_members')->where('uid',$member_id)->setInc("credit2",$rea['money']);
                            }

                            $this->redirect("packet",array('id'=>$id));
                        }else{
                            $this->redirect("packet",array('id'=>$id)); 
                        }
                    }
                }else{                    
                    
                    $money = $re['money'];
                    $num = $re['number'];
                    $arr = $this->open_red($money,$num);
                    foreach($arr as $k => $v){
                        $data=array();
                        $data['log_id']=$id;
                        
                        if($k === 0){
                            $data['uid']=$uid;
                            $data['nickname']=$user['nickname'];
                            $data['avatar']=$user['avatar'];
                            $data['money']=$v;
                            $data['time']=time();
                            $data['status']=1;

                            //用户增加余额
                            $member=db("ims_ewei_shop_member")->where("id=$uid")->find();
                            if($member['uid']==0){
                                db("ims_ewei_shop_member")->where("id=$uid")->setInc("credit2",$v);
                            }else{
                                $member_id=$member['uid'];
                                db('ims_mc_members')->where('uid',$member_id)->setInc("credit2",$v);
                            }
                            
                        }else{
                            $data['money']=$v;
                        }
                       
                        db("ims_snake_packet")->insert($data);
                        
                    }
                    $uids=$re['packet'];
                    $uid_arr=explode(",",$uids);
                    if(!\in_array($uid,$uid_arr)){
                        $uid_arr[]=$uid;
                        $str=implode(",",$uid_arr);
                        db("ims_snake_chatlog")->where("id=$id")->update(['packet'=>$str]);                    
                    }
                 
                    $this->redirect("packet",array('id'=>$id));
               } 
              
            }else{
                
                $this->redirect("packet",array('id'=>$id));
            }
        }else{
            $this->redirect("index");
        }
    }
    public function packet()
    {
        $uid=session("uid");
        $id=input('id');
        $chatlog=db("ims_snake_chatlog")->where("id=$id")->find();
        if($chatlog){
            $num=$chatlog['number'];
            $cou=db("ims_snake_packet")->where("log_id=$id and status=1")->count();
            if($cou == $num){
                if($chatlog['status'] == 0){
                    db("ims_snake_chatlog")->where("id=$id")->setField("status",1);  
                }
            }
            $rep=db("ims_snake_packet")->where("log_id=$id and uid=$uid")->find();
            $this->assign("rep",$rep);

            $res=db("ims_snake_packet")->where("log_id=$id and status=1")->select();
            $this->assign("res",$res);

            $this->assign("chatlog",$chatlog);
            $this->assign("cou",$cou);
          

            return $this->fetch();
        }else{
            $this->redirect("index");
        }
        
    }
    // public function open_reds()
    // {
    //     $re=$this->open_red("0.3",1);
    //     var_dump($re);
    // }
    public function open_red($total, $num) {
        $min=0.01;//每个人最少能收到0.5元
        $sub_arr = [];

        $mins=0.5;
      
        for ($i=1;$i<$num;$i++)
        {
            $safe_total=($total-($num-$i)*$min)/($num-$i);//随机安全上限
        //   var_dump($safe_total);exit;
            $money=mt_rand($min*100,$safe_total*100)/100;
            while ($money < $mins){
                $money=mt_rand($min*100,$safe_total*100)/100;
            }
            $total=$total-$money;
            //echo '第'.$i.'个红包：领'.$money.' 元，余额：'.$total.' 元 <br/>';
            $sub_arr[] = $money;
        }
        //echo '00第'.$num.'个红包：'.$total.' 元，余额：0 元';
        array_push($sub_arr, $total);
     
        return $sub_arr;
    }
   

    


}