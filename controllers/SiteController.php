<?php

namespace app\controllers;

use app\models\databaseModels\Meetup;
use app\models\databaseModels\User;
use app\models\forms\RegisterForm;
use app\models\search\MeetupSearch;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\forms\LoginForm;

class SiteController extends _MainController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Meetup::find()
            ->select("
                    meetup.id as id,
                    meetup.title as title,
                    avg(vote.value) as rating,
                    count(vote.value) as rates")
            ->leftJoin('vote', 'meetup.id = vote.meetup_id')
            ->groupBy('meetup.id');

        if (isset($_GET['search'])) {
            $query->where(['like', 'title', $_GET['search']]);
        }

        $meetupsDataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
                'defaultPageSize' => 10
            ],
            'sort' => [
                'attributes' => ['title', 'rating', 'rates'],
                'defaultOrder' => ['rating' => SORT_DESC],
            ],
        ]);

        return $this->render('index', [
            'meetupsDataProvider' => $meetupsDataProvider,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->email = $model->email;
            $user->firstname = $model->firstname;
            $user->lastname = $model->lastname;
            $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);
            $user->register_date = gmdate('Y-m-d H:i:s');
            if (!$user->save()) {
                throw new InternalErrorException();
            }

            // On login l'utilisateur directement
            $identityUser = \app\models\User::findOne(['id' => $user->id]);
            if (! is_null($identityUser)) {
                Yii::$app->user->login($identityUser);
            }
            return $this->goHome();
        }

        $model->password = '';
        $model->confirmPassword = '';
        return $this->render('register', [
            'model' => $model,
        ]);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionNotFound()
    {
        throw new NotFoundHttpException('Page not found.');
    }
}
