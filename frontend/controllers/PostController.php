<?php

namespace frontend\controllers;

use frontend\resource\Post;
use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;
use yii\web\ForbiddenHttpException;

class PostController extends ActiveController
{
    public $modelClass = Post::class;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator']['only'] = ['create', 'update', 'delete'];
        $behaviors['authenticator']['authMethods'] = [
            HttpBearerAuth::class
        ];

        return $behaviors;
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
