<?php

namespace backend\models;

use Yii;
use common\models\User;
use common\models\WebClient;
use yii\db\Query;
/**
 * This is the model class for table "admin".
 *
 * @property int $id
 * @property string $client_id
 * @property string $client_secret
 * @property string $access_token
 * @property int $userid
 *
 * @property User $user
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userid'], 'integer'],
            [['client_id', 'client_secret'], 'string', 'max' => 255],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'client_secret' => 'Client Secret',
            'access_token' => 'Access Token',
            'userid' => 'Userid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    public function getAccessToken()
    {
        return Admin::find()->select('access_token')->where(['userid' => Yii::$app->user->id])->one()->access_token;
    }
}
