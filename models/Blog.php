<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "blg_blog".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $description
 * @property string $image
 * @property string $article
 * @property string $create_date
 *
 * @property User $user
 * @property Comments[] $comments
 */
class Blog extends \yii\db\ActiveRecord
{
    /**
     * Validate constants
     */
    const DESCRIPTION_MAX_LENGTH = 255;
    const ARTICLE_MAX_LENGTH = 65000;

    public $imageFile;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blg_blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'description', 'article'], 'required'],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'on' => 'create'],
            [['user_id'], 'integer'],
            [['article'], 'string', 'max' => self::ARTICLE_MAX_LENGTH],
            [['create_date'], 'safe'],
            [['description', 'image'], 'string', 'max' => self::DESCRIPTION_MAX_LENGTH],
            [['user_id'], 'exist', 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => 'Пользователь',
            'description' => 'Описание',
            'article' => 'Статья',
            'create_date' => 'Дата создания',
        ];
    }

    /**
     * Before save event handler
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
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::className(), ['blog_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return BlogQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BlogQuery(get_called_class());
    }

    /**
     * @param $model
     * @param $post
     * @return bool
     */
    public static function saveImageAndModel($model, $post)
    {
        if ($model->load($post))
        {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile->baseName)
            {
                $model->image = 'images/'.md5($model->imageFile->baseName . time()) . '.' . $model->imageFile->extension;
                file_put_contents(Yii::getAlias('@app/web/' . $model->image), file_get_contents($model->imageFile->tempName));
            }
            return ($model->validate() && $model->save());
        }
        return false;
    }
}
