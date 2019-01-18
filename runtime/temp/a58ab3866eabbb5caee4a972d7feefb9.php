<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"D:\www\1_09_zdl\public/../application/index\view\index\packet.html";i:1547448484;}*/ ?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<title>红包详情</title>
<link rel="stylesheet" type="text/css" href="/static/home/css/chat.css" />
<script src="/static/home/js/jquery.min.js"></script>
</head>

<body>

<section class="webkit_box">
  <div class="top_box red">
    <a class="top_back" href="<?php echo url('Index/index'); ?>">&lt;</a>
    <div class="top_txt">红包详情</div>
  </div>
  <section class="webkit_content">
    <div class="hongbao_detail">
      <div class="hongbao_box">
        <img class="hongbao_thumb" src="<?php echo $chatlog['fromavatar']; ?>" />
        <div class="hongbao_nickname"><?php echo $chatlog['fromname']; ?></div>
        <p class="hongbao_tips">恭喜发财，大吉大利！</p>
       <?php if(!(empty($rep) || (($rep instanceof \think\Collection || $rep instanceof \think\Paginator ) && $rep->isEmpty()))): ?> 
        <div class="hongbao_sum">
          <span class="hongbao_jine"><?php echo $rep['money']; ?></span>
          <span class="hongbao_cell">元</span>
        </div>
        <a class="hongbao_where" href="#">已存入余额</a>
        <?php endif; ?>
      </div>
      
      <div class="hongbao_record">
        <p class="hongbao_status"><?php echo $cou; ?>/<?php echo $chatlog['number']; ?>红包共<?php echo $chatlog['money']; ?>元，</p>
        <ul class="hongbao_list">
         <?php if(is_array($res) || $res instanceof \think\Collection || $res instanceof \think\Paginator): $i = 0; $__LIST__ = $res;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
          <li class="hongbao_item">
            <div class="hongbao_infor">
              <img class="hongbao_person" src="<?php echo $v['avatar']; ?>"/>
              <div class="hongbao_ren">
                <div class="hongbao_who"><?php echo $v['nickname']; ?></div>
                <p class="hongbao_time">
                  <?php echo date("m-d H:i",$v['time']); ?>
                </p>
              </div>
            </div>
            <div class="hongbao_qian">
              <p class="hongbao_money"><?php echo $v['money']; ?>元</p>
            </div>
          </li>
         <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
      </div>
    </div>

  </section>

</section>

</body>

</html>