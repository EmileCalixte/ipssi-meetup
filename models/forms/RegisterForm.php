<?php
/**
 * Created by PhpStorm.
 * User: emilecalixte
 * Date: 2019-03-13
 * Time: 09:58
 */

namespace app\models\forms;

use yii\base\Model;
use app\models\User;

class RegisterForm extends Model
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $confirmPassword;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // required fields
            [[
                'firstname',
                'lastname',
                'email',
                'password',
                'confirmPassword'], 'required', 'message' => 'This field is required'],
            // email must be a valid email
            ['email', 'email'],
            // check if email doesn't exist by validateEmail()
            ['email', 'validateEmail'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // password and confirmPassword must match
            ['confirmPassword', 'compare', 'compareAttribute' => 'password', 'message' => 'Password and password confirmation fields don\'t match.'],
            // first name and last name length
            [['firstname', 'lastname'], 'string', 'max' => 32],
        ];
    }

    /**
     * Check that the email doesn't exist.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        $user = User::findOne(['email' => $this->email]);
        if (!is_null($user)) {
            $this->addError($attribute, 'This email address is already used.');
        }
    }

    /**
     * Validates the password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (strlen($this->password) < 8) {
            $this->addError($attribute, 'Password must be at least 8 characters long.');
        }
//        if(!(preg_match('/[A-Za-z]/', $this->password) && preg_match('/\\d/', $this->password))) {
//            $this->addError($attribute, 'Password must contain letters and digits.');
//        }
    }
}
