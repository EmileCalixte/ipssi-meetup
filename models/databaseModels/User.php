<?php

namespace app\models\databaseModels;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $email
 * @property string $password_hash
 * @property string $firstname
 * @property string $lastname
 * @property string $register_date
 * @property bool $is_admin
 *
 * @property Meetup[] $meetups
 * @property Vote[] $votes
 * @property Meetup[] $meetups0
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password_hash', 'firstname', 'lastname', 'register_date'], 'required'],
            [['register_date'], 'safe'],
            [['is_admin'], 'boolean'],
            [['email'], 'string', 'max' => 254],
            [['password_hash'], 'string', 'max' => 10000],
            [['firstname', 'lastname'], 'string', 'max' => 32],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password_hash' => 'Password Hash',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'register_date' => 'Register Date',
            'is_admin' => 'Is Admin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetups()
    {
        return $this->hasMany(Meetup::className(), ['creator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::className(), ['voter_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetups0()
    {
        return $this->hasMany(Meetup::className(), ['id' => 'meetup_id'])->viaTable('vote', ['voter_id' => 'id']);
    }
}
