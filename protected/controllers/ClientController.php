<?php

class ClientController extends Controller {
//    public $layout = '//layouts/column1';
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout='//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {

        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'create','companyaccount'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('dashbord','increaseCredit','calculateprice','myfinancials', 'confirmbuycredits', 'cancelbuycredits', 'buycredits', 'cancel', 'confirm', 'buy', 'extendmembership', 'view', 'update', 'blacklist', 'blacklistchoice', 'allblacklistchoice', 'removeallblacklistchoice', 'removeblacklistchoice'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    public function actionBlacklist() {

        if (isset($_POST['client_id_black'])) {
            $blackclients = Contact::model()->findByPk(Yii::app()->user->id);
            $client_id = $_POST['client_id_black'];
            $blackclients->users = $client_id;
            $blackclients->save();
        }
        $blackclients = Contact::model()->findByPk(Yii::app()->user->id);
        $clients = Client::model()->findAll();
        //print_r($clients);
        $user = $blackclients->users;
        // print_r($user);
        $this->render('/Client/blacklist', array('clients' => $clients, 'user' => $user));
    }

    public function actionBlacklistchoice() {
        $source = $_GET['source'];
        $destination = $_GET['destination'];
        $tabsource = explode(',', $source);
        $tabdestination = explode(',', $destination);
        $tab = array_merge($tabsource, $tabdestination);
        $final = array_unique($tab);
        echo '<select size="15" multiple name="client_id_black[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">';
        foreach ($final as $value) {
            if ($value != '') {
                $element = Client::model()->FindByPk($value);
                $name = $element->porfile_name_first . ' ' . $element->porfile_name_last;
                echo ' <option  selected value ="' . $value . '" >' . $name . '</option>';
            }
        }
        echo '</select>';
    }

    public function actionAllblacklistchoice() {
        $source = $_GET['source'];
        $tabsource = explode(',', $source);
        //print_r($tabsource);
        echo '<select size="15" multiple name="client_id_black[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">';
        foreach ($tabsource as $value) {
            if ($value != '') {
                $element = Client::model()->FindByPk($value);
                $name = $element->porfile_name_first . ' ' . $element->porfile_name_last;
                echo ' <option selected   value ="' . $value . '" >' . $name . '</option>';
            }
        }
        echo '</select>';
    }

    public function actionRemoveallblacklistchoice() {
        echo '<select size="15" multiple name="client_id_black[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">';
        echo '</select>';
    }

    public function actionRemoveblacklistchoice() {
        $destination = $_GET['destination'];
        $tabdestination = explode(',', $destination);
        echo '<select size="15" multiple name="client_id_black[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">';
        foreach ($tabdestination as $value) {
            if ($value != '') {
                $element = Client::model()->FindByPk($value);
                $name = $element->porfile_name_first . ' ' . $element->porfile_name_last;
                echo ' <option  selected value ="' . $value . '" >' . $name . '</option>';
            }
        }
        echo '</select>';
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Client;


        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Client'])) {
            $model->attributes = $_POST['Client'];
            if ($model->save())

            // Uncomment the following line if AJAX validation is needed
                $this->performAjaxValidation($model);

            if (isset($_POST['Client'])) {
                $model->attributes = $_POST['Client'];
                if ($model->save())
                    $this->redirect(array('view', 'id' => $model->user_id));
            }

            $this->render('create', array(
                'model' => $model,
            ));
        }
    }

    public function actionDashbord() {
        $model = Client::model()->findByPk(Yii::app()->user->id);
        $user_package = UserPackage::model()->findByPk(Yii::app()->user->id);
      
        $credit_package = $user_package->creditPackage;
        
        $date = time();
        $days = null;
        $date_expires =  strtotime($user_package->utype_expires);       
        if ($user_package->utype_expires != null) {
            $date_left = $date_expires - $date;
            $days = floor($date_left/(60*60*24));
        }
        $credit_historys = $model->creditHistories;
        $credit_used = 0;
        foreach ($credit_historys as $credit_history) {
            $credit_used = $credit_used + $credit_history->ch_amount;
        }
        $this->render('/Client/dashbord', array(
            'model' => $model, 'credit_used' => $credit_used, 'credit_package' => $credit_package, 'date_left' => $days,'user_package'=>$user_package
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate() {
        $model = Client::model()->findByPk(Yii::app()->user->id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Client'])) {
            $model->attributes = $_POST['Client'];
            $model->porfile_address = $_POST['Client']['porfile_address'];
            $model->porfile_address_nr = $_POST['Client']['porfile_address_nr'];
            $model->porfile_address_addon = $_POST['Client']['porfile_address_addon'];
            if ($model->save())                    
               $this->redirect(array('dashbord', 'id' => $model->user_id));
        }

        $this->render('/Client/update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        $this->loadModel($id)->delete();

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Client('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Client']))
            $model->attributes = $_GET['Client'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Client::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
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

    public function ActionExtendMembership() {
        Yii::app()->session['id'] = Yii::app()->user->id;
        $user = Client::model()->findByPk(Yii::app()->user->id);
        $user_package = UserPackage::model()->findByPk(Yii::app()->user->id);
        $credit_package = $user_package->creditPackage;
        $user_credit = $credit_package->basicCredit;
        $credit_amount = $user_credit->credit_amount;
        Yii::app()->session['credit_amount'] = $credit_amount;

        if (Yii::app()->session['credit_amount'] != NULL) {
            $this->actionBuy();
        } else {
            $this->render('/Client/extendmembership');
        }
    }

    public function actionBuy() {

        // set 
        if (Yii::app()->session['credit_amount'] == 9000) {
            $paymentInfo['Order']['theTotal'] = 2450.00;
            $paymentInfo['Order']['description'] = "Pan African Account";
            $paymentInfo['Order']['quantity'] = '1';
        } else {
            $paymentInfo['Order']['theTotal'] = 350.00;
            $paymentInfo['Order']['description'] = "Starters Offer";
            $paymentInfo['Order']['quantity'] = '1';
        }
        // call paypal 
        $result = Yii::app()->PaypalExt->SetExpressCheckout($paymentInfo);
        //Detect Errors 
        if (!Yii::app()->PaypalExt->isCallSucceeded($result)) {
            if (Yii::app()->PaypalExt->apiLive === true) {
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

            $payPalURL = Yii::app()->PaypalExt->paypalUrl . $token;
            $this->redirect($payPalURL);
        }
        return $token;
    }

    public function actionConfirm() {
        $user = Client::model()->findByPk(Yii::app()->user->id);
        $user_package = UserPackage::model()->findByPk(Yii::app()->user->id);
        $credit_package = $user_package->creditPackage;
        $credit = new Credit;


        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);
        $result = Yii::app()->PaypalExt->GetExpressCheckoutDetails($token);
        $result['PAYERID'] = $payerId;
        $result['TOKEN'] = $token;
        if (Yii::app()->session['credit_amount'] == 9000) {
            $result['ORDERTOTAL'] = 2450.00;
        } else {
            $result['ORDERTOTAL'] = 350.00;
        }



        //Detect errors 
        if (!Yii::app()->PaypalExt->isCallSucceeded($result)) {
            if (Yii::app()->PaypalExt->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        } else {

            $paymentResult = Yii::app()->PaypalExt->DoExpressCheckoutPayment($result);
            //Detect errors  
            if (!Yii::app()->PaypalExt->isCallSucceeded($paymentResult)) {
                if (Yii::app()->PaypalExt->apiLive === true) {
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
                //etention purchase

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
                if (Yii::app()->session['credit_amount'] == 9000) {

                    $credit->credit_show = 'N';
                    $credit->credit_amount = 9000;
                    $credit->credit_price = 2450.00;
                    $credit->credit_duration = 365;
                    $credit->save(false);
                    $credit_package->extention_credit_id = $credit->credit_id;
                    $credit_package->save(false);

                    $user_package->utype_credits = $user_package->utype_credits + $credit->credit_amount;

                    $format = strtotime($user_package->utype_expires);
                    $month = date('m', $format);
                    $day = date('d', $format);
                    $time = date('H:i:s', $format);
                    $year = date('Y', $format);

                    $year = $year + 1;

                    $date = $year . '-' . $month . '-' . $day . ' ' . $time;

                    $user_package->utype_expires = $date;


                    $user_package->save(false);
                    $paypal_transactions->save(false);
                } else {
                    $credit->credit_show = 'N';
                    $credit->credit_amount = 1000;
                    $credit->credit_price = 350.00;
                    $credit->credit_duration = null;
                    $credit->save(false);
                    $credit_package->extention_credit_id = $credit->credit_id;
                    $credit_package->save(false);
                    $user_package->utype_credits = $user_package->utype_credits + $credit->credit_amount;
                    $user_package->save(false);
                    $paypal_transactions->save(false);
                }
                $this->render('/Client/confirm');
            }
        }
    }

    public function actionCancel() {

        //The token of the cancelled payment typically used to cancel the payment within your application
        $token = $_GET['token'];

        $this->render('/Client/cancel');
    }

    public function actionMyFinancials() {
        $press_user = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = 'ch_user=:press_user';
        $criteria->params = array(':press_user' => $press_user);
        $criteria->order = 'ch_date DESC';
        $credit_historys = CreditHistory::model()->findAll($criteria);
        $this->render('/Client/myfinancials', array(
            'credit_historys' => $credit_historys,
        ));
    }
    
     public function actionIncreaseCredit() {
         if (isset($_POST['credit'])){
         Yii::app()->session['credit_price'] = $_POST['credit_price'];
         Yii::app()->session['credit'] = $_POST['credit'];
         
         $this->redirect('buycredits');
         }
        $this->render('/Client/increasecredit', array(
            
        ));
    }

    public function actionBuyCredits() {
       
        // set      
        $paymentInfo['Order']['theTotal'] = Yii::app()->session['credit_price'];
        $paymentInfo['Order']['description'] = "Basic Package x " . Yii::app()->session['credit'].'credits';
        $paymentInfo['Order']['quantity'] = '1';
        // call paypal 
        $result = Yii::app()->PaypalCredits->SetExpressCheckout($paymentInfo);
        //Detect Errors 
        if (!Yii::app()->PaypalCredits->isCallSucceeded($result)) {
            if (Yii::app()->PaypalCredits->apiLive === true) {
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

            $payPalURL = Yii::app()->PaypalCredits->paypalUrl . $token;
            $this->redirect($payPalURL);
        }
        return $token;
    }

    public function actionConfirmBuyCredits() {
        $user_package = UserPackage::model()->findByPk(Yii::app()->user->id);
        $token = trim($_GET['token']);
        $payerId = trim($_GET['PayerID']);
        $result = Yii::app()->PaypalCredits->GetExpressCheckoutDetails($token);
        $result['PAYERID'] = $payerId;
        $result['TOKEN'] = $token;
        $result['ORDERTOTAL'] = Yii::app()->session['credit_price'];
        //Detect errors 
        if (!Yii::app()->PaypalCredits->isCallSucceeded($result)) {
            if (Yii::app()->PaypalCredits->apiLive === true) {
                //Live mode basic error message
                $error = 'We were unable to process your request. Please try again later';
            } else {
                //Sandbox output the actual error message to dive in.
                $error = $result['L_LONGMESSAGE0'];
            }
            echo $error;
            Yii::app()->end();
        } else {

            $paymentResult = Yii::app()->PaypalCredits->DoExpressCheckoutPayment($result);
            //Detect errors  
            if (!Yii::app()->PaypalCredits->isCallSucceeded($paymentResult)) {
                if (Yii::app()->PaypalCredits->apiLive === true) {
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
                //etention purchase
                $paypal_transactions = new PaypalTransactions;
                $paypal_transactions->pp_pay_type = $paymentResult['PAYMENTTYPE'];
                $paypal_transactions->pp_txn_type = $paymentResult['PAYMENTTYPE'];
                $paypal_transactions->pp_amount = $paymentResult['AMT'];
                $paypal_transactions->pp_tax = $paymentResult['TAXAMT'];
                $paypal_transactions->pp_pay_status = $paymentResult['PAYMENTSTATUS'];
                $paypal_transactions->pp_payer_email = $result['EMAIL'];
                $paypal_transactions->pp_payer_id = $result['PAYERID'];
                $paypal_transactions->pp_date = $paymentResult['ORDERTIME'];
                $paypal_transactions->pp_user_id = Yii::app()->user->id;
                if ($user_package->utype_credits == NULL) {
                    $user_package->utype_credits = Yii::app()->session['credit'];
                } else {
                    $user_package->utype_credits = $user_package->utype_credits + Yii::app()->session['credit'];
                }
                $user_package->save(false);
                $paypal_transactions->save(false);


                $this->render('/Client/confirmbuycredits');
            }
        }
    }

    public function actionCancelBuyCredits() {

        //The token of the cancelled payment typically used to cancel the payment within your application
        $token = $_GET['token'];

        $this->render('/Client/cancelbuycredits');
    }

   

    
    
    public function  actionCalculateprice(){
        $credit = $_GET['credit'];
        if($credit<1000){
            $price = $credit * 0.45;
            $dollar = $credit * 0.61;
        }
        elseif($credit>=1000 && $credit<2500){
            $price = $credit * 0.4;
            $dollar = $credit * 0.54;
        }
        elseif($credit>=2500 && $credit<5000){
            $price = $credit * 0.35;
            $dollar = $credit * 0.47;
        }
        elseif($credit>=5000 && $credit<10000){
            $price = $credit * 0.3;
            $dollar = $credit * 0.41;
        }
        else{
            $price = $credit * 0.25;
            $dollar = $credit * 0.34;
        }
        echo '<input type="hidden" name="credit_price" id="pricevalue" value="'.$price.'" />';
        echo $price.' € <br />';
        echo $dollar.' $';
        
    }
    
    
    
     public function  actionCompanyaccount(){
        
         $country = IsoCountry::model()->findByPk($_POST['id_country']);
        if($country->geo_region_id == 11 or $country->geo_region_id == 12)
         echo '<div class="form-group">
             <label for="Client_porfile_camp_account" class="col-sm-3 control-label">Company VAT Number</label>
             <div class="col-sm-5 col-sm-9">
             <input type="text" maxlength="255" id="Client_porfile_camp_account" name="Client[porfile_camp_account]" placeholder="Company VAT Number" class="form-control">
             <div style="display:none" id="Client_porfile_camp_account_em_" class="help-block error">
             </div></div></div>';
         
        
    }

}
