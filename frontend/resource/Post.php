<?php

namespace frontend\resource;

class Post extends \common\models\Post
{
    public function extraFields()
    {
        return ['comments', 'createdBy'];
    }

}
