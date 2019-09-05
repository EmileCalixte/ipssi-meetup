<?php

namespace app\models\databaseModels;

use Yii;

/**
 * This is the model class for table "meetup".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $creator_id
 *
 * @property User $creator
 * @property Vote[] $votes
 * @property User[] $voters
 */
class Meetup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'meetup';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['creator_id'], 'integer'],
            [['title'], 'string', 'max' => 40],
            [['description'], 'string', 'max' => 500],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'creator_id' => 'Creator ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVotes()
    {
        return $this->hasMany(Vote::className(), ['meetup_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVoters()
    {
        return $this->hasMany(User::className(), ['id' => 'voter_id'])->viaTable('vote', ['meetup_id' => 'id']);
    }
}
