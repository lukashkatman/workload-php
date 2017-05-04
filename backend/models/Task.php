<?php

namespace backend\models;

use Yii;
use backend\models\Project;

/**
 * This is the model class for table "task".
 *
 * @property integer $task_id
 * @property integer $project_id
 * @property string $task_name
 * @property string $task_detail
 * @property integer $task_employee_number
 * @property string $task_created_date
 * @property string $task_deadline
 * @property string $task_status
 *
 * @property Project $project
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'task';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_id', 'task_name', 'task_detail', 'task_employee_number','task_created_date', 'task_deadline', 'task_status'], 'required'],
            [['project_id', 'task_employee_number'], 'integer'],
            [['task_detail', 'task_status'], 'string'],
            [['task_created_date', 'task_deadline'], 'safe'],
        
            ['task_created_date','checkProjectDate'],
            [ 'task_deadline', 'checkDate'],
            [['task_name'], 'string', 'max' => 200],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'project_id']],
        ];
    }
    
     /*
    * Custom validation function -> checkDate
    */
    
   public function checkProjectDate($attribute,$param) {
       $project = new Project();
     $project = date($project->find()->where(["project_id"=>$this->project_id])->one()->project_created_date);
   
       $taskDate = date($this->task_created_date);
       if(strtotime($taskDate) < strtotime($project)){
            $this->addError($attribute,"Task must be started after project. The project starts at ".$project);
       }
//       
   }
   public function checkDate($attribute,$param) {
       $projectStart = date($this->task_created_date);
       $deadline = date($this->task_deadline);
       
       if(strtotime($projectStart) > strtotime($deadline)){
           $this->addError($attribute,"Deadline cannot be before starting of task. Task starts by ".$this->task_created_date);
       }
       
   }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'project_id' => 'Project Name',
            'task_name' => 'Task Name',
            'task_detail' => 'Task Detail',
            'task_employee_number' => 'Task Employee Number',
            'task_created_date' => 'Task Starting Date',
            'task_deadline' => 'Task Deadline',
            'task_status' => 'Task Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['project_id' => 'project_id'])->inverseOf('tasks');
    }
}
