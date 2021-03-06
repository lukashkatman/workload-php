<?php

namespace backend\controllers;

use Yii;
use backend\models\TaskUsers;
use backend\models\Task;
use backend\models\TaskUsersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AssignmentController implements the CRUD actions for TaskUsers model.
 */
class AssignmentController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
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
     * Lists all TaskUsers models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new TaskUsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TaskUsers model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TaskUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new TaskUsers();
        
        $response = Yii::$app->request;
            if($response->isAjax && $model->load($_POST)){
              Yii::$app->response->format='json';
               return \yii\widgets\ActiveForm::validate($model);
            }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->task_users_id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing TaskUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        
        $response = Yii::$app->request;
            if($response->isAjax && $model->load($_POST)){
              Yii::$app->response->format='json';
               return \yii\widgets\ActiveForm::validate($model);
            }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->task_users_id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TaskUsers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
 //function to call ajax request to fetch task from project--very very very important
    public function actionLists($id) {
        $count = Task::find()
                ->where(['project_id' => $id])
                ->count();

        $tasks = Task::find()
                ->where(['project_id' => $id])
                ->all();

        if ($count > 0) {
            foreach ($tasks as $task) {
              echo "<option value='" . $task->task_id . "'>" . $task->task_name . "</option>";
                    

                
            }
        } else {
            echo "<option>-</option>";
        }

    }/**
         * Finds the TaskUsers model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return TaskUsers the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id) {
            if (($model = TaskUsers::findOne($id)) !== null) {
                return $model;
            } else {
                throw new NotFoundHttpException('The requested page does not exist.');
            }
        }

    }
    