<?php

class RegistrationClientController extends Controller {

    public $defaultAction = 'registration';
    public static $id = null;

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
        $Client = new Client;
        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'registration-form') {
            // echo UActiveForm::validate(array($model, $profile));
            Yii::app()->end();
        }

        if (Yii::app()->user->id) {
            $this->redirect(Yii::app()->controller->module->profileUrl);
        } else {
            if (isset($_POST['RegistrationForm'], $_POST['Client'])) {
                $model->attributes = $_POST['RegistrationForm'];
                $model->dtype = "client";
                
                $Client->attributes = $_POST['Client'];
                $Client->porfile_address = $_POST['Client']['porfile_address'];
                $Client->porfile_address_nr = $_POST['Client']['porfile_address_nr'];
                $Client->porfile_address_addon = $_POST['Client']['porfile_address_addon'];
                Yii::app()->session['type'] = $_POST['Client']['credittype'];
                if ($model->validate() && $Client->validate()) {
                    $soucePassword = $model->password;
                    $model->activkey = UserModule::encrypting(microtime() . $model->password);
                    $model->password = UserModule::encrypting($model->password);
                    $model->verifyPassword = UserModule::encrypting($model->verifyPassword);
                    $model->superuser = 0;
                    $model->status = ((Yii::app()->controller->module->activeAfterRegister) ? User::STATUS_ACTIVE : User::STATUS_NOACTIVE);

                    if ($model->save(false)) {

                        $Client->user_id = $model->id;
                        //RegistrationClientController::$id =$model->id;
                        Yii::app()->session['id'] = $model->id;
                        $Client->user_email = $model->email;
                        $Client->user_pass = $model->password = UserModule::encrypting($model->password);
                        $Client->save(false);




                        if (Yii::app()->controller->module->sendActivationMail) {
                            $activation_url = $this->createAbsoluteUrl('/user/activation/activation', array("activkey" => $model->activkey, "email" => $model->email));
                            Yii::app()->session['activation_url'] = $activation_url;
                            Yii::import('ext.yii-mail.YiiMailMessage');
                            $message = new YiiMailMessage;
                            $message->setBody(
                                    UserModule::t("
                                        Hello<br /><br />
                                        Thanks for your interest in the Africa Press List and we are glad to welcome you!<br /><br />
This email has been sent from http://www.africapresslist.com/ <br /><br />
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
                                           <br /> Thank you for registering .<br />The Africa Press List- Team"
                                            , array('{activation_url}' => $activation_url))
                                    , 'text/html');
                            $message->subject = UserModule::t("Registration at {site_name}", array('{site_name}' => Yii::app()->name));
                            Yii::app()->session['subject'] = $message->subject;
                            $message->addTo($model->email);
                            Yii::app()->session['email'] = $model->email;
                            $message->from = Yii::app()->params['adminEmail'];
                            Yii::app()->session['form'] = Yii::app()->params['adminEmail'];


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
                                Yii::app()->user->setFlash('registration', UserModule::t("We have sent you an email to validate your email. When you click the url-link in the email you can complete the registration process and start with using the Africa Press List."));
                                if (Yii::app()->session['type'] == 2) {
///
                                    $user = Client::model()->findByPk(Yii::app()->session['id']);
                                    $credit = new Credit;
                                    $credit_package = new CreditPackage;
                                    $credit_user = new UserPackage;
                                    $credit->credit_show = 'N';
                                    $credit->credit_amount = NULL;
                                    $user->user_credits = $credit->credit_amount;
                                    $user->save(false);
                                    $credit->credit_price = 0;
                                    $credit->credit_duration = null;
                                    $credit->save(false);
                                    $credit_package->basic_credit_id = $credit->credit_id;
                                    $credit_package->save(false);
                                    $credit_user->user_id = Yii::app()->session['id']; //  hier muss der id zugewiesen  werden 
                                    $credit_user->credit_package_id = $credit_package->credit_package_id;
                                    $credit_user->utype_credits = $credit->credit_amount;
                                    $credit_user->save(false);
                                    $user->save(false);
                                    Yii::app()->mail->send($message);
                                    ////
                                } else {
                                    $this->actionBuy();
                                }
                            }
                            $this->refresh();
                        }
                    }
                } else
                    $Client->validate();
            }

            $this->render('/Client/registration', array('model' => $model, 'client' => $Client));
        }
    }

    /**
     * Performs the AJAX validation.
     * @param User $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'Client-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionBuy() {

        // set 
        if (Yii::app()->session['type'] == 0) {
            $paymentInfo['Order']['theTotal'] = 2450.00;
            $paymentInfo['Order']['description'] = "Pan African Account";
            $paymentInfo['Order']['quantity'] = '1';
        } else {
            $paymentInfo['Order']['theTotal'] = 350.00;
            $paymentInfo['Order']['description'] = "Starters Offer";
            $paymentInfo['Order']['quantity'] = '1';
        }
        // call paypal 
        $result = Yii::app()->Paypal->SetExpressCheckout($paymentInfo);
        //Detect Errors 
        if (!Yii::app()->Paypal->isCallSucceeded($result)) {
            
            if (Yii::app()->Paypal->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        } else {
            // send user to paypal 
            $token = urldecode($result["TOKEN"]);

            $payPalURL = Yii::app()->Paypal->paypalUrl . $token;
            $this->redirect($payPalURL);
        }
        return $token;
    }

    public function actionConfirm() {

        $user = Client::model()->findByPk(Yii::app()->session['id']);
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);
        $result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);
        $result['PAYERID'] = $payerId;
        $result['TOKEN'] = $token;
        if (Yii::app()->session['type'] == 0) {
            $result['ORDERTOTAL'] = 2450.00;
        } else {
            $result['ORDERTOTAL'] = 350.00;
        }



        //Detect errors 
        if (!Yii::app()->Paypal->isCallSucceeded($result)) {
            if (Yii::app()->Paypal->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        } else {

            $paymentResult = Yii::app()->Paypal->DoExpressCheckoutPayment($result);
            //Detect errors  
            if (!Yii::app()->Paypal->isCallSucceeded($paymentResult)) {
                if (Yii::app()->Paypal->apiLive === true) {
                    //Live mode basic error message
                    $error = 'We were unable to process your request. Please try again later';
                } else {
                    //Sandbox output the actual error message to dive in.
                    $error = $paymentResult['L_LONGMESSAGE0'];
                }
                echo $error;
                Yii::app()->end();
            } else {
                //payment was completed successfully
                //first purchase
                Yii::import('ext.yii-mail.YiiMailMessage');
                $message = new YiiMailMessage;
                $message->setBody(
                        UserModule::t("
                            Hello<br /><br />
                                        Thanks for your interest in the Africa Press List and we are glad to welcome you!<br /><br />
This email has been sent from http://www.africapresslist.com/ <br /><br />
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
                                           <br /> Thank you for registering .<br />The Africa Press List- Team"
                                , array('{activation_url}' => Yii::app()->session['activation_url']))
                        , 'text/html');
                $message->subject = Yii::app()->session['subject'];
                $message->addTo(Yii::app()->session['email']);

                $message->from = Yii::app()->session['form'];
                Yii::app()->session['form'] = Yii::app()->params['adminEmail'];

                Yii::app()->mail->send($message);
                $credit = new Credit;
                $credit_package = new CreditPackage;
                $credit_user = new UserPackage;
                $paypal_transactions = new PaypalTransactions;
                $paypal_transactions->pp_pay_type = $paymentResult['PAYMENTTYPE'];
                $paypal_transactions->pp_txn_type = $paymentResult['PAYMENTTYPE'];
                $paypal_transactions->pp_amount = $paymentResult['AMT'];
                $paypal_transactions->pp_tax = $paymentResult['TAXAMT'];
                $paypal_transactions->pp_pay_status = $paymentResult['PAYMENTSTATUS'];
                $paypal_transactions->pp_payer_email = $result['EMAIL'];
                $paypal_transactions->pp_payer_id = $result['PAYERID'];
                $paypal_transactions->pp_date = $paymentResult['ORDERTIME'];
                $paypal_transactions->pp_user_id = Yii::app()->session['id'];
                if (Yii::app()->session['type'] == 0) {
                    $paypal_transactions->pp_item = "Pan African Account";
                    $credit_package->package_title = 'Pan African Account';
                    $credit->credit_show = 'N';
                    $credit->credit_amount = 9000;
                    $credit->credit_price = 2450.00;
                    $credit->credit_duration = 365;
                    $credit->save(false);
                    $credit_package->basic_credit_id = $credit->credit_id;
                    $credit_package->save(false);
                    $credit_user->user_id = Yii::app()->session['id']; //  hier muss der id zugewiesen  werden 
                    $credit_user->credit_package_id = $credit_package->credit_package_id;
                    $credit_user->utype_credits = $credit->credit_amount;
                    $credit_user->save(false);
                    $paypal_transactions->save(false);
                    $credit_user->utype_credits = $credit->credit_amount;
                    $credit_user->utype_expires = date('Y-m-d H:i:s', strtotime('+1 years'));
                    $credit_user->save(false);
                    $user->user_credits = $credit->credit_amount;
                    $user->save(false);
                } else {
                    $paypal_transactions->pp_item = "Starters Offer ";
                    $credit_package->package_title = ' Starters Offer ';
                    $credit->credit_show = 'N';
                    $credit->credit_amount = 1000;
                    $credit->credit_price = 350.00;
                    $credit->credit_duration = null;
                    $credit->save(false);
                    $credit_package->basic_credit_id = $credit->credit_id;
                    $credit_package->save(false);
                    $credit_user->user_id = Yii::app()->session['id']; //  hier muss der id zugewiesen  werden 
                    $credit_user->credit_package_id = $credit_package->credit_package_id;
                    $credit_user->utype_credits = $credit->credit_amount;

                    $credit_user->save(false);
                    $paypal_transactions->save(false);
                    $user->user_credits = $credit->credit_amount;
                    $user->save(false);
                }

                $this->render('/Client/confirm');
            }
        }
    }

    public function actionCancel() {
        $id = null;
        $id = Yii::app()->session['id'];
        if ($id != null) {

            $user = User::model()->findByPk($id);
            $client = Client::model()->findByPk($id);
            $user->delete(false);
            $client->delete(false);
        }
        //The token of the cancelled payment typically used to cancel the payment within your application
        $token = $_GET['token'];

        $this->render('/Client/cancel');
    }

    public function actionDirectPayment() {
        $paymentInfo = array('Member' =>
            array(
                'first_name' => 'name_here',
                'last_name' => 'lastName_here',
                'billing_address' => 'address_here',
                'billing_address2' => 'address2_here',
                'billing_country' => 'country_here',
                'billing_city' => 'city_here',
                'billing_state' => 'state_here',
                'billing_zip' => 'zip_here'
            ),
            'CreditCard' =>
            array(
                'card_number' => 'number_here',
                'expiration_month' => 'month_here',
                'expiration_year' => 'year_here',
                'cv_code' => 'code_here'
            ),
            'Order' =>
            array('theTotal' => 1.00)
        );

        /*
         * On Success, $result contains [AMT] [CURRENCYCODE] [AVSCODE] [CVV2MATCH]  
         * [TRANSACTIONID] [TIMESTAMP] [CORRELATIONID] [ACK] [VERSION] [BUILD] 
         *  
         * On Fail, $ result contains [AMT] [CURRENCYCODE] [TIMESTAMP] [CORRELATIONID]  
         * [ACK] [VERSION] [BUILD] [L_ERRORCODE0] [L_SHORTMESSAGE0] [L_LONGMESSAGE0]  
         * [L_SEVERITYCODE0]  
         */

        $result = Yii::app()->Paypal->DoDirectPayment($paymentInfo);

        //Detect Errors 
        if (!Yii::app()->Paypal->isCallSucceeded($result)) {
            if (Yii::app()->Paypal->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
        } else {
            //Payment was completed successfully, do the rest of your stuff
        }

        Yii::app()->end();
    }

}
