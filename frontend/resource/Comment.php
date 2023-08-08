<?php

namespace frontend\resource;

class Comment extends \common\models\Comment
{
    public function extraFields()
    {
        return ['posts'];
    }
    public function getPost()
    {
        return $this->hasOne(Post::class, ['id'=>'post_id']);
    }
}