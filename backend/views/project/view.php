<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->project_name;
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-6">
        <div class="project-view">

            <h1><?= Html::encode($this->title) ?></h1>



            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [

                    'project_name',
                    'project_detail:ntext',
                    [
                        'attribute' => 'project_created_date',
                        'value' => date_format(date_create($model->project_created_date), "Y-M-d") . " " . date_format(date_create($model->project_created_date), "l")
                    ],
                    [
                        'attribute' => 'project_deadline',
                        'value' => date_format(date_create($model->project_deadline), "Y-M-d") . " " . date_format(date_create($model->project_deadline), "l")
                    ],
                    [
                        'attribute' => 'Total Task',
                        'value' => $model->getTasks()->count()
                    ],
                    [
                        'attribute' => 'Task Completed',
                        'value' => $model->getTasks()->where(['task_status' => '100'])->count() . '/' . $model->getTasks()->count()
                    ],
                    
                ],
            ])
            ?>


            <p>
<?= Html::a('Update', ['update', 'id' => $model->project_id], ['class' => 'btn btn-primary']) ?>
                <?=
                Html::a('Delete', ['delete', 'id' => $model->project_id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ])
                ?>
            </p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="project-view">

            <h1>Tasks</h1>
            <table class="table table-hover">
                <tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Employees
                    </th>
                </tr>

                <?php
                foreach ($model->getTasks()->all() as $task) {
                    ?>
                    <tr>
                        <td>
                            <?= $task->task_name ?>
                        </td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="<?= $task->task_status ?>"
                                     aria-valuemin="0" aria-valuemax="100" style="width:<?= $task->task_status ?>%">
                                    <?php // echo $task->task_status.'%' ?>
                                </div>
                            </div>

                        </td>
                        <td>
                          <?= $task->task_employee_number ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>