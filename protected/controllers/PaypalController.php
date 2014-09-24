<?php

class PaypalController extends Controller {

    public function actionBuy() {

        // set 
        $paymentInfo['Order']['theTotal'] = 50.00;
        $paymentInfo['Order']['description'] = "Some payment description here";
        $paymentInfo['Order']['quantity'] = '1';

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
    }

    public function actionConfirm() {
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);



        $result = Yii::app()->Paypal->GetExpressCheckoutDetails($token);

        $result['PAYERID'] = $payerId;
        $result['TOKEN'] = $token;
        $result['ORDERTOTAL'] = 50.00;

 
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
               // $user = Client::model()->findByPk(Yii::app()->user->id);
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
                $paypal_transactions->pp_user_id = 46;
                $paypal_transactions->pp_item = "full package";
                $credit_package->package_title = 'full package';
                $credit->credit_show = 'N';
                $credit->credit_amount = 47;
                //$user->user_credits = $credit->credit_amount;
                //$user->save(false);
                $credit->credit_price = 1.950;
                $credit->credit_duration = 365;
                $credit->save(false);
                $credit_package->basic_credit_id = $credit->credit_id;
                $credit_package->save(false);
                $credit_user->user_id = 46; //  hier muss der id zugewiesen  werden 
                $credit_user->credit_package_id = $credit_package->credit_package_id;
                $credit_user->utype_credits = $credit->credit_amount;
                $credit_user->save(false);
                  $paypal_transactions->save(false);
                $this->render('confirm');
            }
        }
    }

    public function actionCancel() {
        //The token of the cancelled payment typically used to cancel the payment within your application
        $token = $_GET['token'];

        $this->render('cancel');
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
