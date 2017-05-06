<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="project-form">

    <?php $form = ActiveForm::begin(["enableAjaxValidation"=>true]); ?>

    <?= $form->field($model, 'project_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'project_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'project_created_date')->widget(
    DatePicker::className(), [
      'value' => date('Y-m-d'),
	'options' => ['placeholder' => 'Select date ...'],
	'pluginOptions' => [
		'format' => 'yyyy-m-d',
		'todayHighlight' => true
	]
]);?>
   
    <?= $form->field($model, 'project_deadline')->widget(
    DatePicker::className(), [
      'value' => date('Y-m-d'),
	'options' => ['placeholder' => 'Select date ...'],
	'pluginOptions' => [
		'format' => 'yyyy-m-d',
		'todayHighlight' => true
	]
]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
