<?php

namespace backend\controllers;

use Yii;
use backend\models\Task;
use backend\models\SearchTask;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTask();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)    
    { 
        //fetch the data of users and check if they are assigned to the task or not, as a result provides the number of user who are 
        //assigned to the task
        $task = new \backend\models\TaskUsers();
        $users = new \common\models\User();
         
        $count = 0;
        foreach($users->find()->all() as $user){
         $countUser = $task->find()->where(['task_id'=>$id,'user_id'=>$user->id])->one();
         if(!empty($countUser)){
             $count++;
         }
        }
        
       
        
       // $countUser = $task->find()->where(['task_id'=>$id]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'userAssigned' =>$count      //this here saves the number of users
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();
        
         $response = Yii::$app->request;
            if($response->isAjax && $model->load($_POST)){
              Yii::$app->response->format='json';
               return \yii\widgets\ActiveForm::validate($model);
            }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->task_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
         $response = Yii::$app->request;
            if($response->isAjax && $model->load($_POST)){
              Yii::$app->response->format='json';
               return \yii\widgets\ActiveForm::validate($model);
            }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->task_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
