<?php
namespace frontend\controllers;

use common\api\actions\GalleryActions;
use common\api\actions\RoomsActions;
use common\controllers\YourHomeController;
use frontend\models\OrderForm;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\FileHelper;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

class SiteController extends YourHomeController {

    /*public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }*/

    public function actions() {
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

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionRooms() {
        $this->layout = 'room';
        $this->view->params['header_image'] = 'header_rooms.jpg';

        $model = new OrderForm();
        $model->start_date = date('m/d/Y', time());
        $model->end_date = date('m/d/Y', strtotime('+1 days'));

        return $this->render('rooms', [
            'rooms' => RoomsActions::getRooms(),
            'model' => $model
        ]);
    }

    public function actionServices() {
        $this->layout = 'side';
        $this->view->params['header_image'] = 'header_services.jpg';

        return $this->render('services');
    }

    public function actionGallery() {
        $this->layout = 'side';

        return $this->render('gallery', [
            'images' => GalleryActions::getGalleryImages()
        ]);
    }

    public function actionContact() {
        $this->layout = 'side';
        $this->view->params['header_image'] = 'header_contact.jpg';

        return $this->render('contact');
    }

    public function actionChangeLanguage($lang) {
        \Yii::$app->session->set('lang', $lang);
        $this->redirect(\Yii::$app->request->referrer);
    }







    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
