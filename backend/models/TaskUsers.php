<?php

namespace backend\models;

use Yii;
use common\models\User;

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
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'project_id']],
            [['task_users_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['task_users_id' => 'id']],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Task::className(), 'targetAttribute' => ['task_id' => 'task_id']],
        ];
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
