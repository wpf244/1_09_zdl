<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"D:\www\1_09_zdl\public/../application/index\view\index\index.html";i:1547016436;}*/ ?>
<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
<title>我的群聊</title>
<link rel="stylesheet" type="text/css" href="/static/home/css/chat.css"/>
<script src="/static/home/js/jquery.min.js"></script>
</head>

<body>
<section class="webkit_box">
  <div class="top_box">
    <a class="top_back" href="javascript:history.back(-1)">&lt;</a>
    <div class="top_txt">即时聊天（<span class="person_sum">6</span>）</div>
  </div>
  <section class="webkit_content">
    <div class="chat_box">
      <div class="packet_node">
        <div class="packet_wrap">
          <div class="packet_get">
            <p class="packet_time">
              昨天 17：52
            </p>
          </div>
        </div>
      </div>
      <div class="chat_item">
        <img class="chat_thumb" src="https://weixin.1919.cn/b2c1919/static/img/memmber.71d04ab.png" />
        <div class="chat_wrap">
          <span class="chat_txt">消息内容消息内容消息消息内容消息内容消息消息内容消息内容消息</span>
        </div>
      </div>
      <div class="chat_item">
        <img class="chat_thumb" src="https://weixin.1919.cn/b2c1919/static/img/memmber.71d04ab.png" />
        <div class="chat_wrap">
          <div class="packet_box">
            <div class="packet_top">
              <img class="packet_icon" src="/static/home/img/hongbao.png" />
              <div class="packet_txt">
                <div class="packet_tips">恭喜发财，大吉大利！</div>
                <div class="packet_status">查看红包</div>
              </div>
            </div>
            <div class="packet_name">即时红包</div>
          </div>
        </div>
      </div>
      <!-- <div class="packet_node">
        <div class="packet_wrap">
          <div class="packet_get">
            <img class="packet_pic" src="/static/home/img/hongbao.png" />
            <p class="packet_who">
              某某某领取了<span class="packet_color">红包</span>
            </p>
          </div>
        </div>

        <div class="packet_wrap">
          <div class="packet_get">
            <img class="packet_pic" src="/static/home/img/hongbao.png" />
            <p class="packet_who">
              某某某领取了<span class="packet_color">红包</span>，红包已领完
            </p>
          </div>
        </div>
      </div> -->

      <div class="chat_cell">
        <div class="chat_wrap">
          <span class="chat_txt">消息内容</span>
        </div>
        <img class="chat_thumb" src="https://weixin.1919.cn/b2c1919/static/img/memmber.71d04ab.png" />
      </div>
    </div>
  </section>
  <div class="chat_enter">
    <input class="chat_msg" id="chat_msg" type="text" />
    <button class="chat_post" id="chat_post">发送</button>
  </div>
</section>

<!--弹出框-->
<div class="model_box">
  <div class="model_show">
    <img class="model_thumb" src="https://weixin.1919.cn/b2c1919/static/img/memmber.71d04ab.png" />
    <div class="model_nickname">昵称昵称</div>
    <p class="model_tips">恭喜发财，大吉大利！</p>
    <a class="model_open" href="packet.html">開</a>
  </div>
  <div class="model_close">X</div>
</div>

<!--蒙版背景-->
<div class="common_bg"></div>

<script>
function deleteHtmlTag(str) {
  str = str.replace(/<[^>]+>|&[^>]+;/g, "").trim(); //去掉所有的html标签和&nbsp;之类的特殊符合
  return str;
}

$(function() {
  //聊天功能js
  var chat_txt = $('.chat_txt'),
    chat_box = $('.chat_box'),
    chat_msg = $('#chat_msg'),
    chat_post = $('#chat_post'),
    char_item = null
    
  chat_post.click(function() {
    
    //判断输入内容是否为空
    if(deleteHtmlTag(chat_msg.val()).trim() === '') {
      alert('请输入聊天内容')
      return false
    } else {
      char_item = `<div class="chat_cell"><div class="chat_wrap"><span class="chat_txt">${deleteHtmlTag(chat_msg.val())}</span></div><img class="chat_thumb" src="https://weixin.1919.cn/b2c1919/static/img/memmber.71d04ab.png" /></div>`
      chat_box.append(char_item)
      //清空输入框
      chat_msg.val('')
      //固定视角到最新消息
      chat_box.scrollTop(chat_box[0].scrollHeight)
    }
  })

  //按回车键触发发送事件
  chat_msg.keyup(function(event) {
    //判断键值为回车
    if(event.keyCode == 13) {
      chat_post.trigger('click')
    }

  })
  
  //关闭模态窗
  function modelClose(){
    $('.common_bg').removeClass('show')
    $('.model_box').removeClass('show')
  }
  
  //红包功能js
  var packet_top = $('.packet_top'),
      common_bg = $('.common_bg'),
      model_box = $('.model_box'),
      model_close = $('.model_close')
  
  packet_top.click(function(){
    var _this = $(this)
    
    common_bg.addClass('show')
    model_box.addClass('show')
    
    //领取红包之后的样式
    _this.addClass('get')
    _this.find('.packet_icon').attr('src','/static/home/img/open_hongbao.png')
    _this.find('.packet_status').html('红包已被领取')
    
  })
  
  common_bg.click(function(){
    modelClose()
  })
  model_close.click(function(){
    modelClose()
  })
  
})
</script>

</body>

</html>