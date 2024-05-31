<?php
/**
 * User: TheCodeholic
 * Date: 8/11/2019
 * Time: 12:52 PM
 */

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;

use app\models\User; // Adjust the namespace as necessary

/**
 * Class SignupForm
 *
 * @author Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package app\models
 */
class SignupForm extends Model
{
    public $username;
    public $password;
    public $password_repeat;

    public function rules()
    {
        return [
            [['username', 'password', 'password_repeat'], 'required'],
            ['username', 'string', 'min' => 4, 'max' => 16],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],

            ['password', 'string', 'min' => 8, 'tooShort' => 'Password should contain at least 8 characters.'],
            ['password', 'match', 'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\W).*$/', 'message' => 'Password must contain at least one special character, one uppercase letter, and one lowercase letter.'],
            
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message'=>'Password doesn\'t matched']
        ];
    }

    public function signup()
    {
        if(!$this->validate()){
            return null;
        }
        // Assuming User model is in the same namespace, otherwise adjust the namespace
        $user = new User();
        $user->username = $this->username;
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->access_token = Yii::$app->security->generateRandomString();
        $user->password = Yii::$app->security->generatePasswordHash($this->password);

        if ($user->save()) {
            return true;
        }
        else{
            Yii::error("User was not saved: " . VarDumper::dumpAsString($user->errors));
        }

        return false;
    }

}