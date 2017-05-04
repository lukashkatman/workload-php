<?php

namespace backend\models;

use Yii;
use common\models\User;
use backend\models\Task;

/**
 * This is the model class for table "task_users".
 *
 * @property integer $task_users_id
 * @property integer $project_id
 * @property integer $task_id
 * @property integer $user_id
 * @property string $user_assigned_date
 *
 * @property Project $project
 * @property User $taskUsers
 * @property Task $task
 */
class TaskUsers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'task_id', 'user_id', 'user_assigned_date'], 'required'],
            [['project_id', 'task_id', 'user_id'], 'integer'],
            [['user_assigned_date'], 'safe'],
            [['user_assigned_date'], 'checkdate'],
            ['user_id', 'checkuser'],
            ['user_id', 'checkquota'],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'project_id']],
            [['task_users_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['task_users_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'task_id']],
        ];
    }
    
    public function checkdate($attribute,$param) {
         $task = new Task();
     $task = $task->find()->where(["task_id"=>$this->task_id])->one();
     $taskCreatedDate = $task->task_created_date;
     $taskDeadLIne = $task->task_deadline;
   
       $userAssignedDate = date($this->user_assigned_date);
       
              

       
       if(strtotime($userAssignedDate) < strtotime($taskCreatedDate)){
          
            $this->addError($attribute,"User must be assigned between ".$taskCreatedDate ."-".$taskDeadLIne);
       }
          if (strtotime($userAssignedDate) > strtotime($taskDeadLIne)){     
              $this->addError($attribute,"User must be assigned between ".$taskCreatedDate ."-".$taskDeadLIne);
    }
    }
    
    public function checkuser($arg, $param) {
        //it prevents from adding same user on same task
        $user = new TaskUsers();
        $task = $this->task_id;
        $userID = $this->user_id;
        $user = $user->find()->where(["task_id"=>$task,"user_id"=>$userID])->all();
        if(empty($user)){
            $this->addError($arg,"This user has been already assigned");
            
        }
    
       
       
        
        
    }
    
    public function checkquota($arg,$param) {
        
         $task = new \backend\models\TaskUsers();
        $users = new \common\models\User();
         
        $count = 0;
        foreach($users->find()->all() as $user){
         $countUser = $task->find()->where(['task_id'=>$this->task_id,'user_id'=>$user->id])->one();
         if($countUser){
             $count++;
         }
        }
        
        $taskModel = new \backend\models\Task();
        $taskEmp = $taskModel->find()->where(['task_id'=>$this->task_id])->one()->task_employee_number;
        
        if($count >= $taskEmp){
            $this->addError($arg,"The quota for employee is full!");
        }
           

        
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_users_id' => 'Task Users ID',
            'project_id' => 'Project',
            'task_id' => 'Task',
            'user_id' => 'User',
            'user_assigned_date' => 'User Assigned Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'task_users_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Task::className(), ['task_id' => 'task_id']);
    }
}
