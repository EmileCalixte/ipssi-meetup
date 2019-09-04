<?php

namespace app\models\search;

use app\models\databaseModels\Meetup;
use yii\data\ActiveDataProvider;

class MeetupSearch extends Meetup
{
    /**
     * @inheritdoc
     */
    public $title;

    public function rules()
    {
        return [
            ['title', 'safe']
        ];
    }

    public function search($params)
    {
        $query = Meetup::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['title']]
        ]);

        $this->load($params);
        if(!$this->validate()) {
            return $dataProvider;
        }

        $query->where(['like', 'title', $this->title]);

        return $dataProvider;
    }
}