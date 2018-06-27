<?php
namespace frontend\models;

use yii\base\Model;

class AddCustomerInformationForm extends Model
{
    public $name;
    public $email;
    public $gender;
    public $birthDate;
    public $contactNumber;
    public $address;
    public $locationName;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
}