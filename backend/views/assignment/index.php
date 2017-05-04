<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TaskUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Task Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Task Users', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'task_users_id',
            [
                'attribute'=>'project_id',
                'value'=>'project.project_name'
            ],
         
           [
                'attribute'=>'task_id',
                'value'=>'task.task_name'
            ],
             [
                'attribute'=>'user_id',
                'value'=>'taskUsers.username'
            ],
            'user_assigned_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
