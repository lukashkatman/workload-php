<?php

namespace frontend\controllers;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use backend\models\TaskUsersSearch;
use backend\models\TaskUsers;
use yii\web\NotFoundHttpException;

class ProfileController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            //    'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['index','task','claim'],
                        'allow' => true,
                        'roles' => ['employee task'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    
     public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
//            'captcha' => [
//                'class' => 'yii\captcha\CaptchaAction',
//                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
//            ],
        ];
    }
    
    public function actionIndex()
    {
           // $user =   \Yii::$app->user;
           $searchModel = new TaskUsersSearch();
        $dataProvider = $searchModel->userTask(\Yii::$app->request->queryParams, TaskUsers::find()->where(['user_id'=> \Yii::$app->user->getId()]));
       
   
        return $this->render('index',[
      
           'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionTask($id)
    {
         $model = $this->findTaskModel($id);
   
           // custom validation
            $response = \Yii::$app->request;
            if($response->isAjax && $model->load($_POST)){
               \Yii::$app->response->format='json';
               return \yii\widgets\ActiveForm::validate($model);
            }
            
            // end custom validation

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('update',[
        'model' => $model,
         
          
        ]);
        }
       
    }
    
    public function actionClaim($id,$user)
    {
        $response = \Yii::$app->request;
            if($response->isAjax){
                // check wether user have already reward or not
                $check = $this->findTaskModel($id);
                //if not then add value 1 to reward column in task table
                
                if($check->task_reward ==0){
                    $check->task_reward = 1;
                    if($check->save()){
                        //use email funciton
                        
                        return "You will receive an email attaching the payslip from your manager";
                        
                    }
                    
                    
                }
                //else return message already rewarded. 
                else {
                    return "You have already claimed for the desired task";
                }
                
                
                
                               \Yii::$app->response->format='json';

             
            }
    }
    
    protected function findModel($id)
    {
        if (($model = TaskUsers::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
      
    protected function findTaskModel($id)
    {
        if (($model = \backend\models\Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
}
