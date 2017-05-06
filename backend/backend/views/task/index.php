<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SearchTask */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tasks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a('Create Task', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>  
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            switch ($model->task_status) {
//                case '25':
//                    return [ 'style' => "background-color: #ffc107",];
//                    break;
//                 case '50':
//                    return [ 'style' => "background-color: #35ccbe",];
//                    break;
//                 case '75':
//                    return [ 'style' => "background-color: #88e08c",];
//                    break;
//                case '100':
//                  return [ 'style' => "background-color: #4caf50",];
//                    break;
//                default :
//                 return [ 'style' => "background-color: #ff5722",];
//
//                    break;
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'project_id',
                'value' => 'project.project_name'
            ],
            'task_name',
            'task_detail:ntext',
            'task_employee_number',
            // 'task_created_date',
            // 'task_deadline',
            [
                'attribute' => 'task_status',
                'value' => 'task_status',
                'contentOptions' =>
                function($model) {
             switch ($model->task_status) {
                case '25':
                    return  [
                    'class' => 'progress-bar',
                    'role' => "prariaogressbar",
                    ' aria-valuenow' => "25",
                    'aria-valuemin' => "0",
                    'aria-valuemax' => "100",
                    '  style' => "width:25%; background-color: #ffc107"
                ];
                    break;
                 case '50':
                     return  [
                    'class' => 'progress-bar',
                    'role' => "prariaogressbar",
                    ' aria-valuenow' => "50",
                    'aria-valuemin' => "0",
                    'aria-valuemax' => "100",
                    '  style' => "width:50%; background-color: #35ccbe"
                ];
                    break;
                 case '75':
                    return  [
                    'class' => 'progress-bar',
                    'role' => "prariaogressbar",
                    ' aria-valuenow' => "75",
                    'aria-valuemin' => "0",
                    'aria-valuemax' => "100",
                    '  style' => "width:75% ; background-color: #88e08c"
                ];
                    break;
                case '100':
                 return  [
                    'class' => 'progress-bar',
                    'role' => "prariaogressbar",
                    ' aria-valuenow' => "100",
                    'aria-valuemin' => "0",
                    'aria-valuemax' => "100",
                    '  style' => "width:100% ; background-color:#4caf50"
                ];
                    break;
                default :
                 return  [
                    'class' => 'progress-bar',
                    'role' => "prariaogressbar",
                    ' aria-valuenow' => "0",
                    'aria-valuemin' => "0",
                    'aria-valuemax' => "100",
                    '  style' => "width:0%  ; background-color:#ff5722"
                ];

                    break;
            }  
                }
               
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
