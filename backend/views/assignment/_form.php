<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Project;
use backend\models\Task;
use common\models\User;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\TaskUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'task_users_id')->textInput() ?>

    <?= $form->field($model,'project_id')->dropDownList(
        ArrayHelper::map(Project::find()->select(['project_id','project_name'])->all(), 'project_id', 'project_name'),
            ['prompt'=>"Select Project",
            'onchange'=>'
                 $.post("index.php?r=assignment/lists&id='.'"+$(this).val(), function (data){
                     $("select#taskusers-task_id").html(data);  
});'
                ]); //taskusers-task_id obtained by inspecting on web browser id need # and if it is class then use "." without semicolon, attributes no thing ?>
    
   

    <?= $form->field($model,'task_id')->dropDownList(
        ArrayHelper::map(Task::find()->select(['task_id','task_name'])->all(), 'task_id', 'task_name'),
            ['prompt'=>"Select Task"
            
                ]);?>

    <?= $form->field($model,'user_id')->dropDownList(
        ArrayHelper::map(User::find()->select(['id','username'])->all(), 'id', 'username'),
            ['prompt'=>"Select User"
            
                ]);?>

     <?= $form->field($model, 'user_assigned_date')->widget(
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
