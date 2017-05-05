<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TaskUsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'task_users_id') ?>

    <?= $form->field($model, 'project_id') ?>

    <?= $form->field($model, 'task_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_assigned_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
