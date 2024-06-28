<?php

namespace frontend\controllers;

use Psy\Exception\RuntimeException;
use shop\forms\auth\LoginForm;
use shop\forms\auth\PasswordResetRequestForm;
use shop\forms\auth\ResendVerificationEmailForm;
use shop\forms\auth\ResetPasswordForm;
use shop\forms\auth\SignupForm;
use shop\forms\ContactForm;
use shop\services\auth\AuthService;
use shop\services\auth\PasswordResetService;
use shop\services\auth\SignupServices;
use shop\services\contact\ContactService;
use Yii;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    private ContactService $contactService;

    public function __construct($id, $module, ContactService $contactService,  $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->contactService = $contactService;
    }


    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }


    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionContact()
    {
        $form = new ContactForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $this->contactService->sendEmail($form);
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } catch (RuntimeException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', 'There was an error sending your message. ' . $e->getMessages());
            }
            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $form,
        ]);
    }


    public function actionAbout()
    {
        return $this->render('about');
    }






}
