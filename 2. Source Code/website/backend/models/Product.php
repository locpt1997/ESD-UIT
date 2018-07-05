<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $basePrice
 * @property double $weight
 * @property string $image
 * @property int $categoryid
 * @property int $onHand
 *
 * @property CartItem $cartItem
 * @property OrderDetail $orderDetail
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['description'], 'string'],
            [['basePrice', 'weight'], 'number'],
            [['categoryid', 'onHand'], 'required'],
            [['categoryid', 'onHand'], 'integer'],
            [['image'], 'string', 'max' => 255],
            [['categoryid'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['categoryid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Tên hàng hóa',
            'description' => 'Mô tả',
            'basePrice' => 'Giá',
            'weight' => 'Cân nặng',
            'image' => 'Hình ảnh',
            'categoryid' => 'Categoryid',
            'onHand' => 'On Hand',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCartItem()
    {
        return $this->hasOne(CartItem::className(), ['productid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderDetail()
    {
        return $this->hasOne(OrderDetail::className(), ['productid' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'categoryid']);
    }
}
