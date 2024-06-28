<?php

namespace frontend\controllers\auth;

use shop\forms\auth\ResendVerificationEmailForm;
use shop\services\auth\PasswordResetService;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class ResendController extends Controller
{
    private PasswordResetService $passwordResetService;

    public function __construct($id, $module, PasswordResetService $passwordResetService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->passwordResetService = $passwordResetService;
    }

    public function actionResendVerificationEmail()
    {
        $form = new ResendVerificationEmailForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            if ($this->passwordResetService->resendVerifyEmail($form)) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
            }
        }

        return $this->render('resendVerificationEmail', [
            'model' => $form
        ]);
    }

    public function actionVerifyEmail($token)
    {
        try {
            $this->passwordResetService->validateVerificationToken($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $this->passwordResetService->verifyEmail($token)) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }
}