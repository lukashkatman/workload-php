<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(["enableAjaxValidation"=>true]); ?>

  
  

    <?= $form->field($model, 'task_status')->dropDownList([ 0=>'0', 25 => '25', 50 => '50', 75 => '75', 100 => '100', ], ['prompt' => 'Please select the task status in percentage']) ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-primary']) ?>
        
    </div>

    <?php ActiveForm::end(); ?>

</div>
