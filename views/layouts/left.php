<aside class="main-sidebar">
    <div class="sidebar-block"></div>
    <section class="sidebar">

        <?= \app\common\helpers\Nav::widget([
            'encodeLabels' => false,
            'options' => ['class' => 'sidebar-menu'],
            'items' => \Yii::$app->sidebarItems->getItems()
        ]); ?>

    </section>

</aside>