<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "blg_comment".
 *
 * @property integer $id
 * @property integer $blog_id
 * @property integer $user_id
 * @property string $comment
 * @property string $create_date
 *
 * @property BlgBlog $blog
 * @property BlgUser $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * Validatation constants
     */
    const MAX_COMMENT_LENGTH = 255;

    public $user_name;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blg_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['comment'], 'required'],
//            [['blog_id', 'user_id'], 'integer'],
//            [['create_date'], 'safe'],
//            [['comment'], 'string', 'max' => self::MAX_COMMENT_LENGTH],
//            [['blog_id'], 'exist', 'skipOnError' => true, 'targetClass' => Blog::className(), 'targetAttribute' => ['blog_id' => 'id']],
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['comment'], 'required'],
            [['user_id', 'blog_id'], 'integer'],
            ['user_id', 'exist',
                'targetClass' => User::className(),
                'targetAttribute' => 'id'],
            ['blog_id', 'exist',
                'targetClass' => Blog::className(),
                'targetAttribute' => 'id'],
            [['create_date'], 'safe'],
            [['comment'], 'string', 'max' => self::MAX_COMMENT_LENGTH]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'blog_id' => 'Блог',
            'user_name' => 'Пользователь',
            'comment' => 'Комментарий',
            'create_date' => 'Дата создания',
        ];
    }

    /**
     * Before sav event handler
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->user_id = Yii::$app->user->id;
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlog()
    {
        return $this->hasOne(Blog::className(), ['id' => 'blog_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return CommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
    }
}
