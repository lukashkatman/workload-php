<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property integer $project_id
 * @property string $project_name
 * @property string $project_detail
 * @property string $project_created_date
 * @property string $project_deadline
 *
 * @property Task[] $tasks
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['project_name', 'project_detail','project_created_date', 'project_deadline'], 'required'],
            [['project_detail'], 'string'],
            [['project_created_date', 'project_deadline'], 'safe'],
            [['project_created_date', 'project_deadline'], 'checkDate'],
            [['project_name'], 'string', 'max' => 50],
        ];
    }
    
   /*
    * Custom validation function -> checkDate
    */
   public function checkDate($attribute,$param) {
       $projectStart = date($this->project_created_date);
       $deadline = date($this->project_deadline);
       
       if(strtotime($projectStart) > strtotime($deadline)){
           $this->addError($attribute,"Project must be started before deadline. The deadline of the project ".$this->project_deadline);
       }
       
   }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'project_id' => 'Project ID',
            'project_name' => 'Project Name',
            'project_detail' => 'Project Detail',
            'project_created_date' => 'Project Starting Date',
            'project_deadline' => 'Project Deadline',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Task::className(), ['project_id' => 'project_id']);
    }
}
