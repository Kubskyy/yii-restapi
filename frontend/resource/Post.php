<?php

namespace frontend\resource;

class Post extends \common\models\Post
{
    public function fields()
    {
        return ['id', 'title', 'body', 'created_at'];
    }
}
