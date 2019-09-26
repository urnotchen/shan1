<?php
use yii\widgets\Breadcrumbs;
use dmstr\widgets\Alert;
use yii\helpers\Html;

?>
<div class="content-wrapper">
    <div class="container"  style="padding: 0px ;">
        <section class="content-header container" style="max-width: 1350px;">

            <h1>
                <?= $this->title; ?>
            </h1>

        </section>

        <section class="content  container " style="max-width: 1350px;">
            <?= Alert::widget(); ?>
            <?= $content ?>
        </section>

    </div>
</div>
<!--<footer class="footer" style="position:absolute;bottom:0">-->
</br/><br/>
<footer class="footer" style="margin-left: 0;position:absolute;bottom:0;width:100%;background-color: #ECF0F5">

    <p class="pull-left">© 雪光 2019</p>
    <p class="pull-left">
        <a href='http://www.miibeian.gov.cn' target='_blank'>粤 </a>
    </p>

</footer>
