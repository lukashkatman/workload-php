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

    <?= $form->field($model,'project_id')->dropDownList(
        ArrayHelper::map(Project::find()->select(['project_id','project_name'])->all(), 'project_id', 'project_name'),
            ['prompt'=>"Select Project"]
            )?>
    
    

    <?= $form->field($model, 'task_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'task_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'task_employee_number')->textInput() ?>

    <?= $form->field($model, 'task_created_date')->widget(
    DatePicker::className(), [
      'value' => date('Y-m-d'),
	'options' => ['placeholder' => 'Select date ...'],
	'pluginOptions' => [
		'format' => 'yyyy-m-d',
		'todayHighlight' => true
	]
]);?>
   
   
<?= $form->field($model, 'task_deadline')->widget(
    DatePicker::className(), [
      'value' => date('Y-m-d'),
	'options' => ['placeholder' => 'Select date ...'],
	'pluginOptions' => [
		'format' => 'yyyy-m-d',
		'todayHighlight' => true
	]
]);?>

  

    <?= $form->field($model, 'task_status')->dropDownList([ 0=>'0', 25 => '25', 50 => '50', 75 => '75', 100 => '100', ], ['prompt' => 'Please select the task status in percentage']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
