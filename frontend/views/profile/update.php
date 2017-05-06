<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TaskUsers */


$this->title = $model->task_name;
$this->params['breadcrumbs'][] = ['label' => 'Profile', 'url' => ['profile/index']];
$this->params['breadcrumbs'][] = $model->project->project_name;
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-users-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <p><?= $model->task_detail ?></p>
    <table class="table table-striped">
        <tr>
            <th>Created On</th>
            <th>Deadline</th>
            <th>Total Days</th>
               <?=
            
        ($model->task_status==100) ?  "<th>Reward</th>":"";
        ?>
        </tr>
        <tr>
            <td>
                <?= date_format(date_create($model->task_created_date), "Y-M-d") . " " . date_format(date_create($model->task_created_date), "l") ?>
            </td>
            <td>
                <?= date_format(date_create($model->task_deadline), "Y-M-d") . " " . date_format(date_create($model->task_deadline), "l") ?>
            </td>
            <td>
                <?php
                $taskStartTimeStamp = strtotime($model->task_created_date);
                $taskEndTimeStamp = strtotime($model->task_deadline);


                $timeDiff = abs($taskEndTimeStamp - $taskStartTimeStamp);



                $totalDays = $timeDiff / 86400;  // 86400 seconds in one day
//get the remaining days
// and you might want to convert to integer
                echo intval($totalDays);
                ?>
            </td>
            <?=
            
        ($model->task_status==100) ?  "<td>".Html::Button('Claim Reward', [ 'value'=> \yii\helpers\Url::toRoute(['profile/claim', 'id' => $model->task_id,'user'=>\Yii::$app->user->getId()]), 'class' => 'btn btn-success','id'=>'getReward'])."</td>":"";
        ?>
        </tr>
    </table>


                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>

</div>
<script>
 $('#getReward').click(function(){
     var data = $(this).attr("value");
     
     
     $.ajax({
          url: data,
          type: 'post',
          
          success: function (response) {
             alert(response)
          }
     });
     
    });
</script>