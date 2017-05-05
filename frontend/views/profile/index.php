<?php
/* @var $this yii\web\View */
?>
<h1>profile/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>

<div class="row">
    <div class="col-md-12">
        <h2>My  Tasks</h2>
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>DeadLine</th>
                <th>Assigned  Date</th>
                <th>Update Status </th>
            </tr>
            <?php
            foreach ($taskUser as $getTask):
                echo "<tr>";
                echo "<td>"
                . $getTask->task->task_name
                . "</td>"
                . "<td>";
                ?>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="<?= $getTask->task->task_status ?>"
                         aria-valuemin="0" aria-valuemax="100" style="width:<?= $getTask->task->task_status ?>%; 
                         background-color:  <?php
                         switch ($getTask->task->task_status) {
                             case 25:
                                 echo '#e01f1f';
                                 break;
                             case 50:
                                 echo '#a3c510';
                                 break;
                             case 75:
                                 echo '#11e8c8';
                                 break;
                             case 100:
                                 echo '#1aea61';
                                 break;
                             default :
                                 echo '#000';
                                 break;
                         }
                         ?>

                         ;color:#000  ">
                         <?php echo $getTask->task->task_status . '%' ?>
                    </div>
                </div>
                <?php
                echo "</td>"
                . "<td>"
                . $getTask->task->task_created_date
                . "</td>"
                . "<td>"
                . $getTask->task->task_deadline
                . "</td>"
                . "<td>"
                . $getTask->user_assigned_date
                . "</td>";
                ?>
                <td>
                   
                    <button type="button" class="btn btn-primary" onclick="status('status<?= $getTask->task->task_id?>',<?= Yii::$app->user->getId()?>,<?= $getTask->task->task_id ?>,<?= $getTask->task->task_status ?>)"  >Update Status</button>
                <!-- Model for status change -->
<div class="modal fade status<?= $getTask->task->task_id?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
     <?= $getTask->task->task_name?>
        
        <br/>
        <?php
                        if($getTask->task->task_status!=100){
                            
                        
                            ?>
                    <select id="status<?= $getTask->task->task_id?>"  >
                       
                        <option value="0" > 0 </option>
                        <option value="25" > 25% </option>
                        <option value="50" > 50% </option>
                        <option value="75"> 75% </option>
                        <option value="100"> 100% </option>
                     



                    </select>
                      <?php
                        } 
                        else{
                            echo  '<a class="btn btn-success" id="claim">Claim</a>';
                        }
                        
                        ?>
    </div>
  </div>
</div>

                </td>
                <?php
                echo "</tr>";
            endforeach;
            ?>
        </table>
    </div>
</div>


<script>
    function status(model,userID,taskID,taskStatus){
        //alert(taskID+" "+userID+" "+model);
        $('.'+model).modal('show');
       }
    </script>
<?php
$script = <<< JS
     
   function status(userID,taskID,taskStatus){
        alert(taskID+" "+userID);
       }
         

        
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
