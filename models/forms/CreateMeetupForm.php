<?php

namespace app\models\forms;

use yii\base\Model;

class CreateMeetupForm extends Model
{
    public $title;
    public $description;

    public function rules()
    {
        return [
            [['title', 'description'], 'required', 'message' => 'This field is required'],
            ['title',  'string', 'max' => 40],
            ['description', 'string', 'max' => 500]
        ];
    }
}
