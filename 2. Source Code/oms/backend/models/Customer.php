<?php

namespace backend\models;

use Yii;
use common\models\User;
/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property int $gender
 * @property string $birthday
 * @property string $email
 * @property string $contact_number
 * @property string $address
 * @property string $location_name
 * @property int $userid
 *
 * @property Cart $cart
 * @property User $user
 * @property Order $order
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['gender', 'userid'], 'integer'],
            [['birthday'], 'safe'],
            [['code', 'name', 'email', 'contact_number', 'address', 'location_name'], 'string', 'max' => 255],
            [['code'], 'unique'],
            [['email'], 'unique'],
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
            'code' => 'Code',
            'name' => 'Name',
            'gender' => 'Gender',
            'birthday' => 'Birthday',
            'email' => 'Email',
            'contact_number' => 'Contact Number',
            'address' => 'Address',
            'location_name' => 'Location Name',
            'userid' => 'Userid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCart()
    {
        return $this->hasOne(Cart::className(), ['customerid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['customerid' => 'id']);
    }
}
