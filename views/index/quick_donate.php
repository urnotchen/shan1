<?php

use app\common\widgets\BoxWidget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
    <div class="">
        <span class="lead">爱心捐助 -</span>
        <?php BoxWidget::begin(['bodyClass' => 'box-body no_padding_left']);?>

        <?php $form = ActiveForm::begin(['id' => 'contract_form']); ?>
        <?= $form->field($model,'product_id')->hiddenInput(['value' =>$project_id])->label(false);?>
        <?= $form->field($model, 'money',['options' =>['style' => ['margin-left' =>'0px','width' => '80%','float' => 'left']]])->textInput(['maxlength' => true,'style' => ['margin-left' =>'0px','width' => '100%']])->label('金额') ?> &nbsp;&nbsp;
        <?= $form->field($model, 'comment',['options' =>['style' => ['margin-left' =>'0px','width' => '80%','float' => 'left']]])->textInput(['maxlength' => true,'style' => ['margin-left' =>'0px','width' => '100%']])->label('留言') ?> &nbsp;&nbsp;
        <?= $form->field($model, 'user_id')->hiddenInput(['value' => $user_id])->label(false); ?>

        <?= Html::submitButton('提交', ['id' => 'submit_evaluate','class' => 'btn btn-primary pull-right' ,'style' => ['float' => 'left']]) ?>


        <?php ActiveForm::end(); ?>
        <?php BoxWidget::end();?>
        <?php



        ?>

    </div>

<?php
$this->registerCss(<<<Css
.no_padding_left{
    padding-left: 0px;
}
Css
);

$this->registerJs(<<<Js

// $("#submit_evaluate").on('click',submitEvaluate);
// function submitEvaluate(){
//       $.ajax({
//                 type: "post",
//                 url:'/index/quick-donate',
//                 data:$('#contract_form').serialize(),// 你的formid
//                 success: function(data) {
//                     $("#modal_evaluate").modal('hide');
//                 }
//             });
// }
$(".delete_evaluate").on('click',deleteEvaluate);
function deleteEvaluate(){
    if(confirm('确认删除')){
    var id = $(this).attr('data-key');
    $.post({
        url : '/check/evaluate/delete-evaluate',
        data:{id:id},
        success:function(){
            $("#modal_evaluate").modal('hide');
            return true;
        }
    });
    }
}
Js
);
?>