<?php

namespace frontend\controllers;

use frontend\resource\Comment;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class CommentController extends ActiveController
{
    public $modelClass = Comment::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];

        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }
    public function prepareDataProvider()
    {
        return new ActiveDataProvider([
            'query' => $this->modelClass::find()->andWhere(['post_id' => \Yii::$app->request->get('postId')])
        ]);
    }

    /**
     * @param string $action
     * @param Post $model
     * @param array $params
     */

     public function checkAccess($action, $model = null, $params = [])
     {
         if(in_array($action, ['update', 'delete']) && $model->created_by !== \Yii::$app->user->id){
             throw new ForbiddenHttpException("You don't have permission to change this record.");
         }
     }
}
