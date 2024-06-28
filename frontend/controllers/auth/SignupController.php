<?php

namespace frontend\controllers\auth;

use shop\forms\auth\SignupForm;
use shop\services\auth\SignupServices;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SignupController extends Controller
{
    private SignupServices $signupServices;

    public function __construct($id, $module, SignupServices $signupServices, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->signupServices = $signupServices;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
        ];
    }

    public function actionSignup()
    {
        $form = new SignupForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $user = $this->signupServices->signup($form);
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
//              if (Yii::$app->getUser()->login($user)) {
//                  return $this->goHome();
//              }
        }

        return $this->render('signup', [
            'model' => $form,
        ]);
    }

}