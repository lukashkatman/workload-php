<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\TaskUsers */

$this->title = 'Create Task Users';
$this->params['breadcrumbs'][] = ['label' => 'Task Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
