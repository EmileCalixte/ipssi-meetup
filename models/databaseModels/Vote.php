<?php

namespace app\models\databaseModels;

use Yii;

/**
 * This is the model class for table "vote".
 *
 * @property int $id
 * @property int $meetup_id
 * @property int $voter_id
 * @property int $value
 *
 * @property Meetup $meetup
 * @property User $voter
 */
class Vote extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vote';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['meetup_id', 'voter_id', 'value'], 'required'],
            [['meetup_id', 'voter_id', 'value'], 'integer'],
            [['meetup_id', 'voter_id'], 'unique', 'targetAttribute' => ['meetup_id', 'voter_id']],
            [['meetup_id'], 'exist', 'skipOnError' => true, 'targetClass' => Meetup::className(), 'targetAttribute' => ['meetup_id' => 'id']],
            [['voter_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['voter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meetup_id' => 'Meetup ID',
            'voter_id' => 'Voter ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetup()
    {
        return $this->hasOne(Meetup::className(), ['id' => 'meetup_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoter()
    {
        return $this->hasOne(User::className(), ['id' => 'voter_id']);
    }
}
