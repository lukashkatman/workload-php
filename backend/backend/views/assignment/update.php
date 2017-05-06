<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TaskUsers */

$this->title = 'Update Task Users: ' . $model->task_users_id;
$this->params['breadcrumbs'][] = ['label' => 'Task Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task_users_id, 'url' => ['view', 'id' => $model->task_users_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="task-users-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
