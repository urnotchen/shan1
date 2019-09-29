<?php $this->beginPage() ?>
<?php $this->beginBody() ; ?>
<style type="text/css">
    body{
         background-color: pink;
    }
</style>
<!--<body background="../img/aixin_bg.jpg" style="background-size: cover">-->
<div class="wrapper">
<div class="col-md-4" style="margin-top: 50%">
    <div class="box box-widget widget-user-2" >
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-white">
            <div class="widget-user-image">

                <img class="img-circle" src = <?php echo $img_url?> alt="User Avatar">
            </div>
            <!-- /.widget-user-image -->
            <span  >&nbsp; </span>
            <h3 class="widget-user-username">&nbsp;<?php echo $nickname?></h3>
<!--            <h5 class="widget-user-desc">&nbsp; </h5>-->
        </div>
        <div class="box-footer no-padding">
            <ul class="nav nav-stacked">
                <li style="padding: 15px">
                    <h3>感谢你助力【<?php echo $project_name ?>】</h3>
                    <h3>此次捐出<span  style="color: red"><?php echo $money?></span>元</h3>
                    </li>

                    </ul>
            </div>
        </div>
</div>
<footer class="navbar-fixed-bottom">
    <div class="container">
        <div class="raw" style="padding: 5%">
            <button class="btn btn-danger btn-lg" style="width: 45%">分享给好友</button>
            <a href=show-certificate?token=<?php echo $token?>&tradeno=<?php echo $tradeno?>><button class="btn  btn-lg "style="width: 45%;float: right">查看捐赠证书</button></a>
            </div>
    </div>
</footer>

<?php $this->endBody() ?></body></html><?php $this->endPage() ?>
<?php
$this->registerJs(<<<JS

        var app_id = $("#app_id").val();
        var signature = $("#signature").val();
        var timestamp = $("#timestamp").val();
        var nonceStr = $("#nonceStr").val();

        wx.config({
        debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
appId: app_id, // 必填，公众号的唯一标识
timestamp: timestamp, // 必填，生成签名的时间戳
nonceStr: nonceStr, // 必填，生成签名的随机串
signature : signature,
jsApiList: ['updateTimelineShareData','updateAppMessageShareData','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone'] // 必填，需要使用的JS接口列表
});
wx.ready(function () {      //需在用户可能点击分享按钮前就先调用
var share_img = $("#share_img").val();
var share_title = $("#share_title").val();
wx.updateTimelineShareData({
title: share_title, // 分享标题
link: window.location.href, // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
imgUrl: share_img, // 分享图标
success: function () {
// 设置成功
console.log('设置成功123');
}
});

});

$("#share").on('click',share);
function share(){

}
JS
);

