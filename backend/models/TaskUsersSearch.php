<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\TaskUsers;

/**
 * TaskUsersSearch represents the model behind the search form about `backend\models\TaskUsers`.
 */
class TaskUsersSearch extends TaskUsers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           
            [['user_assigned_date','task_id', 'user_id','project_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TaskUsers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
            
        $query->joinWith(['task','project','user']);
        // grid filtering conditions
        $query->andFilterWhere([
            'task_users_id' => $this->task_users_id,
           
            
           
        ]);

        $query->andFilterWhere(['like', 'project.project_name', $this->project_id])
                ->andFilterWhere(['like', 'task.task_name', $this->task_id])
                ->andFilterWhere(['like', 'user_assigned_date', $this->user_assigned_date])
                ->andFilterWhere(['like', 'user.username', $this->user_id]);
        
        return $dataProvider;
    }
}
