<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Task */

$this->title = 'Create Task';
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


<?php
$script = <<< JS
        $(document).ready(function()
        {
            $(".field-taskCreated").hide();  //JavaScript part to react the page according to user's activity
           $(".field-taskDeadLine").hide(); 
         });
           
   
   
         

        
        $('#projectID').change
            (
                function() {
                    var project = $('#projectID option:selected').val();
                    if($.isNumeric(project))
                        {
                            $(".field-taskCreated").fadeIn();
                   $(".field-taskDeadLine").fadeIn(); 

                        }
                    if(!$.isNumeric(project))
                        {
                            $(".field-taskCreated").fadeOut();
                   $(".field-taskDeadLine").fadeOut(); 

                        }
                }
            );
      
        
      
JS;
$this->registerJs($script);
?>
