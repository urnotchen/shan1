<div class="content-wrapper" >
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
                        <button type="button" class="btn btn-primary btn-danger">分享</button>
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
$(".glyphicon-chevron-down").on("click",showDetails);
function showDetails(){
    window.open ('details.php','newwindow', 'height=100, width=400,top=0, left=0, toolbar=no, menubar=no,scrollbars=no, resizable=no,location=n o, status=no')
}
JS
);