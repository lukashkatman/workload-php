<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
?>


<div class="row">
    <div class="col-md-12">
        <h2>My Tasks</h2>
 <?php 
 //displaying the platform for an employee to update the task status
         Modal::begin([
            'header'=>'<h4>Update Task Status</h4>',
            'id'=>'modal',
            'size'=>'modal-lg',
         ]);

        echo "<div id='modalContent'></div>";
        Modal::end();
        ?>
        <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'project_id',
                    'value' => 'project.project_name'
                ],
                [
                    'attribute' => 'task_id',
                    'value' => 'task.task_name'
                ],
                'user_assigned_date',
              
                [
                    'attribute' => 'Status',
                    'value' => function($model) {
                        return $model->task->task_status."%";
                    },
                    'contentOptions' =>
                    function($model) {
                        switch ($model->task->task_status) {
                            case '25':
                                return [
                                    'class' => 'progress-bar',
                                    'role' => "prariaogressbar",
                                    ' aria-valuenow' => "25",
                                    'aria-valuemin' => "0",
                                    'aria-valuemax' => "100",
                                    '  style' => "width:25%; background-color: #ffc107; color:#000"
                                ];
                                break;
                            case '50':
                                return [
                                    'class' => 'progress-bar',
                                    'role' => "prariaogressbar",
                                    ' aria-valuenow' => "50",
                                    'aria-valuemin' => "0",
                                    'aria-valuemax' => "100",
                                    '  style' => "width:50%; background-color: #35ccbe; color:#000"
                                ];
                                break;
                            case '75':
                                return [
                                    'class' => 'progress-bar',
                                    'role' => "prariaogressbar",
                                    ' aria-valuenow' => "75",
                                    'aria-valuemin' => "0",
                                    'aria-valuemax' => "100",
                                    '  style' => "width:75% ; background-color: #88e08c; color:#000"
                                ];
                                break;
                            case '100':
                                return [
                                    'class' => 'progress-bar',
                                    'role' => "prariaogressbar",
                                    ' aria-valuenow' => "100",
                                    'aria-valuemin' => "0",
                                    'aria-valuemax' => "100",
                                    '  style' => "width:100% ; background-color:#4caf50; color:#000"
                                ];
                                break;
                            default :
                                return [
                                   
                                    'style' => "width:1px  ; background-color:#fff; color:#ff5722"
                                ];

                                break;
                        }
                    }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'contentOptions' => [],
                            'header' => 'Actions',
                            'template' => '{view}',
                            'buttons' => [

                                //view button
                                'view' => function ($url, $model) {
                                    return  
                     
                            Html::button('<span class="fa fa-search"></span>View',  [ 'value' =>  \yii\helpers\Url::toRoute(['profile/task','id'=>$model->task_id]), 'class' => 'btn btn-info btn-xs updateStatus'])
                            ;
                                },
                            
                                    ],
                                    'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'view') {
                                  
                  
 
                                    $url = \yii\helpers\Url::toRoute(['profile/task', 'id' => $model->task_id]);
                                
                     
 
                                    return $url;
                                }
                            }
                                ],
                            ],
                        ]);
                        ?>
    </div>
</div>

