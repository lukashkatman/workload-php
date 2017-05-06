<?php

namespace backend\models;

use Yii;

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
 * @property integer $task_reward
 *
 * @property Project $project
 * @property TaskUsers[] $taskUsers
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
            [['project_id', 'task_name', 'task_detail', 'task_employee_number', 'task_created_date', 'task_deadline', 'task_status'], 'required'],
            [['project_id', 'task_employee_number', 'task_reward'], 'integer'],
            [['task_detail', 'task_status'], 'string'],
            [['task_created_date', 'task_deadline'], 'safe'],
            [['task_name'], 'string', 'max' => 200],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'project_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'task_id' => 'Task ID',
            'project_id' => 'Project ID',
            'task_name' => 'Task Name',
            'task_detail' => 'Task Detail',
            'task_employee_number' => 'Task Employee Number',
            'task_created_date' => 'Task Created Date',
            'task_deadline' => 'Task Deadline',
            'task_status' => 'Task Status',
            'task_reward' => 'Task Reward',
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
        return $this->hasMany(TaskUsers::className(), ['task_id' => 'task_id']);
    }
}
