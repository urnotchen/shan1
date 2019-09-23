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


