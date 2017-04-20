<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Comment]].
 *
 * @see Comment
 */
class CommentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * With blog_id condition
     * @param $blog_id
     * @return $this
     */
    public function withBlogId($blog_id)
    {
        $this->andWhere(
            'blg_comment.blog_id = :blog_id',
            [
                ':blog' => $blog_id
            ]
        );
        return $this;
    }
    /**
     * @inheritdoc
     * @return Comment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Comment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
