

<?php

use yii\helpers\Html;

\app\assets\AppAsset::register($this);

\dmstr\web\AdminLteAsset::register($this);

?>    <?php $this->beginPage() ?>


<style>
    html{
        height: 100%;
    }
    body{
        height: 100%;
    }

    .wrapper{
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .content-wrapper{
        /*position: absolute;*/
        overflow-y: auto;
        flex-shrink: 1;
        flex-grow: 1;
    }

    .footer{
        height: 100px;
        width: 100%;
        text-align: center;
        color: white;
        background-color: #E6454A;
    }


</style>


<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


<?php $this->beginBody() ?>

<div class="wrapper">
    <div class="content-wrapper sd" >
        <form>
            <input type="hidden" id="share_title" value=<?php echo $share_title?> />
            <input type="hidden" id="share_img" value=<?php echo $share_img?> />
            <input type="hidden" id="token" value=<?php echo $token?> />
            <input type="hidden" id="app_id" value=<?php echo $app_id?> />
            <input type="hidden" id="timestamp" value=<?php echo $timestamp?> />
            <input type="hidden" id="nonceStr" value=<?php echo $nonceStr?> />
            <input type="hidden" id="signature" value=<?php echo $signature?> />
            <input type="hidden" id="jsapi_ticket" value=<?php echo $jsapi_ticket?> />
        </form>
        <div class="col-md-6"style="background-color: #f4f5fb;padding: 0px;height: 100%">
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
                                <h4><b><?php echo $now_money ?>元</b></h4>
                                <button  id="share" type="button" class="btn btn-primary btn-danger">分享</button>
                                <button   type="button" class="btn btn-primary btn-danger donate">捐款</button></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="info-box " >
                <span class="info-box-icon" style="background-color: white">
              <img src="/img/gongyi_bg.jpg">
          </span>
                <div class="info-box-content">
                    <h4><?php echo $title;?></h4>
                    <h5><?php echo $sub_title;?></h5>
                    <span id="show_details"><span>查看详情&nbsp;<span class="glyphicon glyphicon-chevron-down"></span></span></span>
                </div>
            </div>



            <div class = "box">
                <div class="box-header with-border">
                    <h3 class="box-title">共<?php echo $count ?>人参与</h3>
                    <div class="box-body">
                        <ul class="products-list product-list-in-box">
                            <?php
                            if($donations) {
                                foreach ($donations as $donation) {
                                    echo "
                                    <li class= item id=item_$donation->id>
                                        <div class= 'product-img'>
                                            <img src = {$donation->user->img_url} class='direct-chat-img' alt='User Image' >
                                        </div>
                                        <div class=' product-info' >
                                            <span class= 'product-title' >{$donation->user->nickname}</span>
                                            <span class='pull-right'>￥{$donation->money}</span></a>
                                            <span class='product-description'>
                                              ";echo \Yii::$app->timeFormatter->humanReadable3($donation->created_at);echo"
                                            </span>
                                        </div>
                                    </li>";
                                }
                                echo "<span project_id ={$donation->product_id} donation_id={$donation->id}  id='more_info'>查看更多 &nbsp;<span class='glyphicon glyphicon-chevron-down'></span></span>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="navbar-fixed-bottom">
        <div class="container">
            <div class="raw" style="background-color:white;text-align:center;">
                <button class="btn btn-danger btn-lg donate" style="width: 75%;margin: auto">捐款</button>
            </div>
        </div>
    </footer>
</div>

<?php
\yii\bootstrap\Modal::begin([

    'id'=>'modal_add_donation',
    'size'=>'modal-sm',
]);
echo '<div id="modal_add_donation_area"> </div>';
\yii\bootstrap\Modal::end()?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

<?php
$this->registerJs(<<<JS

function getUrlParam(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
    var r = window.location.search.substr(1).match(reg);  //匹配目标参数
    if (r != null) return decodeURI(r[2]); return null; //返回参数值
}

$("#show_details").on("click",showDetails);
function showDetails(){
    window.open ('details.php','newwindow', 'height=100, width=400,top=0, left=0, toolbar=no, menubar=no,scrollbars=no, resizable=no,location=n o, status=no')
};
$("#more_info").on("click",moreInfo);
function moreInfo(){
    donation_id = $(this).attr("donation_id");
    var project_id = $(this).attr("project_id");
     $.ajax({
        url:"get-donations?donation_id="+donation_id+"&project_id="+project_id,
        type:"get",
        
        success : function(data) {
            for(i = 0;i<data.length;i++){
                console.log(data);
                $("#more_info").attr('donation_id',data[i]['id']);
                $("#more_info").before("<li class=item id=item_"+data[i]['id']+"><div class= 'product-img'><img src = "+data[i]['img_url']+" class='direct-chat-img' alt='User Image' ></div><div class=' product-info' ><span class= 'product-title' >"+data[i]['nickname']+"</span><span class='pull-right'>￥"+data[i]['money']+"</span></a> <span class='product-description'>"+data[i]['created_at']+"</span> </div> </li>");
                donation_id = data[i]['id'];
            }
        

        }
    });
   
   };
$(".donate").on('click',donate);
function donate(){
    var token =getUrlParam('token');
    var project_id = getUrlParam('id');
    $("#modal_add_donation_area").load("/index/quick-donate?token="+token+"&project_id="+project_id);
    $("#modal_add_donation").modal();
}
JS
);
$this->registerJs(<<<JS

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
