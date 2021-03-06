<?php

class RegistrationAdminController extends Controller {

    public $defaultAction = 'registration';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
        );
    }

    /**
     * Registration user
     */
    public function actionRegistration() {
        Profile::$regMode = true;
        $model = new RegistrationForm;
        //$profile = new Profile;   
        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
           // echo UActiveForm::validate(array($model, $profile));
            Yii::app()->end();
        }

        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->profileUrl);
        } else {
            if (isset($_POST['RegistrationForm'] )) {
                $model->attributes = $_POST['RegistrationForm'];
                       

                if ($model->validate()) {
                    $soucePassword = $model->password;
                    $model->activkey = UserModule::encrypting(microtime() . $model->password);
                    $model->password = UserModule::encrypting($model->password);
                    $model->verifyPassword = UserModule::encrypting($model->verifyPassword);
                    $model->superuser = 1 ;
                    $model->status = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);
                    
                    $model->save(false);
                      



                        if (Yii::app()->controller->module->sendActivationMail) {


                            $activation_url = $this->createAbsoluteUrl('/user/activation/activation', array("activkey" => $model->activkey, "email" => $model->email));

                            Yii::import('ext.yii-mail.YiiMailMessage');
                            $message = new YiiMailMessage;
                            $message->setBody(
UserModule::t(                            
"This email has been sent from http://www.africapresslist.com/ <br /><br />
You have received this email because this email address
was used during registration for our site.
If you did not register at our site, please disregard this
email. You do not need to unsubscribe or take any further action. <br /><br />
-----------------------------------------------
Activation Instructions
------------------------------------------------ <br /><br />
We require that you 'validate' your registration to ensure that
the email address you entered was correct. This protects against
unwanted spam and malicious abuse .<br />
To activate your account, simply click on the following link: <br /><br />
{activation_url} <br /><br />
(Some email client users may need to copy and paste the link into your web
browser)<br />
<br /> Thank you for registering .", array('{activation_url}' => $activation_url))
//                                   UserModule::t("Please activate you account go to {activation_url}", array('{activation_url}' => $activation_url))
                                    , 'text/html');
                            $message->subject = UserModule::t("Registration at {site_name}", array('{site_name}' => Yii::app()->name));
                            $message->addTo($model->email);
                            $message->from = Yii::app()->params['adminEmail'];
                            Yii::app()->mail->send($message);


                            //UserModule::sendMail($user->email,$subject,$message);
//    UserModule::sendMail(
//            $model->email, 
//            UserModule::t("You registered from {site_name}", 
//            array('{site_name}' => Yii::app()->name)), 
//            UserModule::t("Please activate you account go to {activation_url}", 
//            array('{activation_url}' => $activation_url))
//        );
                        }

                        if ((Yii::app()->controller->module->loginNotActiv || (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false)) && Yii::app()->controller->module->autoLogin) {
                            $identity = new UserIdentity($model->username, $soucePassword);
                            $identity->authenticate();
                            Yii::app()->user->login($identity, 0);
                            $this->redirect(Yii::app()->controller->module->returnUrl);
                        } else {
                            if (!Yii::app()->controller->module->activeAfterRegister && !Yii::app()->controller->module->sendActivationMail) {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                            } elseif (Yii::app()->controller->module->activeAfterRegister && Yii::app()->controller->module->sendActivationMail == false) {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please {{login}}.", array('{{login}}' => CHtml::link(UserModule::t('Login'), Yii::app()->controller->module->loginUrl))));
                            } elseif (Yii::app()->controller->module->loginNotActiv) {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email or login."));
                            } else {
                                Yii::app()->user->setFlash('registration', UserModule::t("Thank you for your registration. Please check your email."));
                            }
                            $this->refresh();
                        }
                    }
                } 
            }
            $this->render('/admin/registration', array('model' => $model));
        }
    }
    
    
    
    


