<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $customerid
 * @property string $purchaseDate
 * @property int $status
 * @property string $description
 * @property int $total
 * @property int $usingCod
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Customer $customer
 * @property OrderDetail[] $orderDetails
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customerid', 'created_at', 'updated_at'], 'required'],
            [['customerid', 'status', 'total', 'usingCod', 'created_at', 'updated_at'], 'integer'],
            [['purchaseDate'], 'safe'],
            [['description'], 'string', 'max' => 255],
            [['customerid'], 'unique'],
            [['customerid'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customerid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'customerid' => 'Customerid',
            'purchaseDate' => 'Purchase Date',
            'status' => 'Status',
            'description' => 'Description',
            'total' => 'Total',
            'usingCod' => 'Using Cod',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customerid']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetails()
    {
        return $this->hasMany(OrderDetail::className(), ['orderid' => 'id']);
    }
}
