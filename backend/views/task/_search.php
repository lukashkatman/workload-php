<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SearchTask */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'task_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'task_name') ?>

    <?= $form->field($model, 'task_detail') ?>

    <?= $form->field($model, 'task_employee_number') ?>

    <?php // echo $form->field($model, 'task_created_date') ?>

    <?php // echo $form->field($model, 'task_deadline') ?>

    <?php // echo $form->field($model, 'task_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
