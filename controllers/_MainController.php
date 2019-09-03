<?php


namespace app\controllers;


use Yii;
use yii\web\Controller;

class _MainController extends Controller
{
    public function init()
    {
        $this->removeTrailingSlash();
        parent::init();
    }

    public function beforeAction($action)
    {
        $this->redirectToLoginIfAnonymousNotallowed();

        return parent::beforeAction($action);
    }

    private function redirectToLoginIfAnonymousNotallowed() {
        $actionPath = $this->id . '/' . $this->action->id;

        $anonymousAuthorizedActions = [
            'site/index',
            'site/login',
            'site/register',
            'site/error',
        ];

        if(Yii::$app->user->isGuest) {
            if(!in_array($actionPath, $anonymousAuthorizedActions)) {
                header('location: /login');
                die;
            }
        }
    }

    private function removeTrailingSlash()
    {
        if(Yii::$app->request->url !== '/') {
            $exploded = explode('?', Yii::$app->request->url);
            $url = array_shift($exploded);
            $trimedUrl = rtrim($url, '/');
            if(empty($trimedUrl)) $trimedUrl = '/';
            if($trimedUrl !== $url) {
                $queryString = implode('?', $exploded);
                if(!empty($queryString)) $queryString = '?' . $queryString;
                header('location: ' . $trimedUrl . $queryString);
                die;
            }
        }
    }
}