<?php

namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    // public $id;
    // public $username;
    // public $password;
    // public $authKey;
    // public $accessToken;


    public static function tableName(){
        return 'user';
    }

    public function rules(){
        return [
            [['username','password','auth_key', 'access_token'],'required'],
            ['username', 'string', 'max'=>55],
            ['username','unique'],

            ['password','string','min'=>8, 'max'=> 255],
        ];
    }

    public function attributeLabels(){
        return [
            'id'=> 'ID',
            'username'=> 'Username',
            'password'=> 'Password',
            'auth_key' => 'Auth Key',
            'access_token'=> 'Access Token',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id'=> $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token'=> $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return self::find()->where(['username'=> $username])->one();
        // return User::find()->where(['username'=> $username])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }
}
