

<div class="content-wrapper" >
    <form>
        <input type="hidden" id="app_id" value=<?php echo $app_id?> />
        <input type="hidden" id="timestamp" value=<?php echo $timestamp?> />
        <input type="hidden" id="nonceStr" value=<?php echo $nonceStr?> />
        <input type="hidden" id="signature" value=<?php echo $signature?> />
        <input type="hidden" id="jsapi_ticket" value=<?php echo $jsapi_ticket?> />
    </form>
<div class="col-md-6"style="background-color: #f4f5fb;padding: 0px">
    <!-- Widget: user widget style 1 -->
    <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-black" style="background: url('/img/gongyi_bg.jpg') center center;">

        </div>
        <div class="widget-user-image">
            <img class="img-circle" src="/img/avatar.jpg" alt="User Avatar">
        </div>
        <div class="box-footer">
            <div class="row">

                <!-- /.col -->
                <div class=" border-right">
                    <div class="description-block">
                        <h3 >齐齐哈尔慈善总会</h3><br/>
                        <h4 class="description-text">邀您一起做公益</h4>
                        <h5>“每个人做一点点，世界就会改变很多”</h5><br/>
                        <h5>已筹到</h5>
                        <h4><b>¥3,934.3</b></h4>
                        <button  id="share" type="button" class="btn btn-primary btn-danger">分享</button>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.widget-user -->
<!--    <section class="row">asdad-->
<!--    </section>-->
    <div class="info-box ">
<!--        style="display: block;float: left;height: 90px;width:90px;background-color: white;line-height: 0px"-->
      <span class="info-box-icon" style="background-color: white">
          <img src="/img/gongyi_bg.jpg">
      </span>
      <div class="info-box-content">
          <h4>孩儿们的温暖我包了</h4>
          <h5>壹基金温暖包，给孩子一个温暖的冬天。</h5>
          <span>查看详情&nbsp;<span class="glyphicon glyphicon-chevron-down"></span></span>
      </div>
    </div>


    <div class = "box">
        <div class="box-header with-border">
            <h3 class="box-title">2个团队</h3>
            <div class="box-body">
                <ul class="products-list product-list-in-box">
<!--                    todo 循环-->
                    <li class="item">
                        <div class="product-img">
                            <img src="/img/avatar.jpg" class=" direct-chat-img" alt="User Image" >
                        </div>
                        <div class="product-info">
                            <span class="product-title">大爱龙江</span>
                            <span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
                            <span class="product-description">
                                  ¥1,269.48 &nbsp;&nbsp;50人次
                                </span>
                        </div>
                    </li>

                    <li class="item">
                        <div class="product-img">
                            <img src="/img/avatar.jpg" class=" direct-chat-img" alt="User Image" >
                        </div>
                        <div class="product-info">
                            <span class="product-title">齐齐哈尔慈善总会</span>
                            <span class="glyphicon glyphicon-chevron-right pull-right"></span></a>
                            <span class="product-description">
                                  ¥1,269.48 &nbsp;&nbsp;220人次
                            </span>
                        </div>
                    </li>
                </ul>
                <button type="button" class="btn btn-primary btn-danger center-block" >组队</button>
            </div>
        </div>
    </div>


    <div class = "box">
        <div class="box-header with-border">
            <h3 class="box-title">共70人参与</h3>
            <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <li class="item">
                        <div class="product-img">
                            <img src="/img/avatar.jpg" class=" direct-chat-img" alt="User Image" >
                        </div>
                        <div class="product-info">
                            <span class="product-title">匿名</span>
                                <span class=" pull-right">￥180</span></a>
                            <span class="product-description">
                                  14小时前
                                </span>
                        </div>
                    </li>
                    <!-- /.item -->
                    <li class="item">
                        <div class="product-img">
                            <img src="/img/avatar.jpg" class=" direct-chat-img" alt="User Image" >
                        </div>
                        <div class="product-info">
                            <span class="product-title">热心肠</span>
                            <span class=" pull-right">￥1</span></a>
                            <span class="product-description">
                                  1天前
                                </span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
</div>


<?php

$this->registerJs(<<<JS
console.log(location.href.split('#')[0]);
    var app_id = $("#app_id").val();
    var signature = $("#signature").val();
    var timestamp = $("#timestamp").val();
    var nonceStr = $("#nonceStr").val();
 
    wx.config({
        debug: true, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
        appId: app_id, // 必填，公众号的唯一标识
        timestamp: timestamp, // 必填，生成签名的时间戳
        nonceStr: nonceStr, // 必填，生成签名的随机串
        signature : signature,
        jsApiList: ['updateTimelineShareData','updateAppMessageShareData','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone'] // 必填，需要使用的JS接口列表
    });
    wx.ready(function () {      //需在用户可能点击分享按钮前就先调用
    wx.updateTimelineShareData({ 
        title: '分享abc', // 分享标题
        link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: 'http://mmbiz.qpic.cn/mmbiz_jpg/qCbSKFcQyqJ1PcvFlAvIYGib1RvoEEbaESyAV3ibseWrsOjoBoxOdeScNwz0QcAgWD12HSeFV5VT6vovibmCunKLw/0', // 分享图标
        success: function () {
          // 设置成功
          console.log('设置成功123');
        }
    });
    wx.updateAppMessageShareData({ 
        title: '分享给朋友abc', // 分享标题
        desc: '这个是一个测试分享', // 分享描述
        link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: 'http://mmbiz.qpic.cn/mmbiz_jpg/qCbSKFcQyqJ1PcvFlAvIYGib1RvoEEbaESyAV3ibseWrsOjoBoxOdeScNwz0QcAgWD12HSeFV5VT6vovibmCunKLw/0', // 分享图标
        success: function () {
          alert('分享朋友成功');
        }
        
});
    });
    
$("#share").on('click',share);
function share(){
 wx.updateAppMessageShareData({ 
        title: '你好分享', // 分享标题
        desc: '测试分享描述', // 分享描述
        link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
        imgUrl: 'http://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIYAEcqeJicLMH67P1Jibu3TKWIqyW6OGNHoicywiaciccLL9roojDVN5wFAd7QBXpntzg0YuAQ4AhoNCg/132', // 分享图标
        success: function () {
          // 设置成功
        }});
}
JS
);
$this->registerJs(<<<JS
$(".glyphicon-chevron-down").on("click",showDetails);
function showDetails(){
    window.open ('details.php','newwindow', 'height=100, width=400,top=0, left=0, toolbar=no, menubar=no,scrollbars=no, resizable=no,location=n o, status=no')
}
JS
);