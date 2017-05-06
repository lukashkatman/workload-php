<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Task */

$this->title = $model->task_name;
$this->params['breadcrumbs'][] = ['label' => 'Project', 'url' => ['project/index']];
$this->params['breadcrumbs'][] = $model->project->project_name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-view">

    <h1><?= Html::encode($this->title) ?></h1>

  

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           
           'project.project_name',
            'task_name',
            'task_detail:ntext',
            [
                'attribute'=>  'Total Employee Assigned',
                'value'=> $userAssigned.'/'.$model->task_employee_number
            ]
           ,
            'task_created_date',
            'task_deadline',
            [
                'attribute'=>'task_status',
                'value'=> $model->task_status.'% Complete'
            ],
            'task_reward'
           
        ],
    ]) ?>
     
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->task_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->task_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
