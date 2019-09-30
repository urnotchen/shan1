<?php

use kartik\daterange\DateRangePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sub_title')->textInput(['maxlength' => true]) ?>
    <img src=<?php echo $model->img_url ?> id="img_show" style="width: 100px;height: 100px;"alt='封面待上传'>

    <input class="inputfile" id="pro-img_url" type="file">

    <?= $form->field($model, 'img_url')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'receiver')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expect_money')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time_range')->widget(
        DateRangePicker::className(),
        [
            'options' => ['style' => 'height:34px; !important;', 'placeholder' => '筛选'],
            'pluginOptions'=>[
                'locale'=>[
                    'format'=>'Y-MM-DD',
                    'separator'=>' - ',
                ],
                'opens'=>'right'
            ]
        ]
    ); ?>

    <?= $form->field($model, 'content')->widget(\xj\ueditor\Ueditor::className(), [
        'style' => 'width:840px;height:600px',
        'renderTag' => true,
        'readyEvent' => 'console.log("ready")',
        'jsOptions' => [
            'serverUrl' => yii\helpers\Url::to(['upload']),
            'autoHeightEnabled' => false,
            'autoFloatEnable' => true,
            'elementPathEnabled' => false,
            'saveInterval' => 60 * 60 * 24 * 7,
            'toolbars' => [[
                'fullscreen', 'undo', 'redo', '|',
                'bold', 'italic', 'underline', '|', 'removeformat', 'formatmatch', 'blockquote', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', '|',
                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                'customstyle', 'paragraph', 'fontsize', '|',
                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|',
                'link', 'unlink', '|',
                'simpleupload', 'insertimage', '|', 'insertvideo', 'music', 'attachment', 'drafts'
            ]],
            'wordCount' => false,
            'iframeCssUrl' => '/css/ueditor.css',
            'initialStyle' => 'p{line-height:1.6em;font-family:微软雅黑,Microsoft YaHei;font-size:16px}',
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$this->registerJs(<<<JS
$(".inputfile").change(function(){

         
        
         var data = new FormData();
        data.append("myfile", document.getElementById("pro-img_url").files[0]);
         //为FormData对象添加数据
        console.log(data);
        
         $.ajax({
             url:'upload-img',
             type:'POST',
             data:data,
             cache: false,
             contentType: false,        //不可缺参数
             processData: false,        //不可缺参数
             success:function(data){
                $("#img_show").attr("src", data['show_url']);
                $("#project-img_url").val(data['base_url']);
            },
             error:function(){
                 alert('上传出错');
                 //$(".loading").hide();    //加载失败移除加载图片
             }
         });
         });


JS
);