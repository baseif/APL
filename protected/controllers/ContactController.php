<?php

class ContactController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout = '//layouts/column2';

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
                'actions' => array('admin','dashbord', 'index', 'create','update','session','companylist','pressview', 'pressreleases'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('view','deleteall'),
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
    
     public function actionPressreleases() {
//             $contact = Contact::model()->findByPk(Yii::app()->user->id);
//             $lists_contacts = $contact->lists;
//             $i=1;
//             foreach($lists_contacts as $list){
//                 
//              
//                 $presses= $list->presses;
//             
//             }
        $contact_id = Yii::app()->user->id;
        $criteria = new CDbCriteria;
        $criteria->condition = '(contact_id=:contact_id  )';
        $criteria->params = array(':contact_id' => $contact_id);
        $criteria->order = 'press_date DESC';
        $presses = PressJournalist::model()->findAll($criteria);
        $this->render('pressreleases', array(
            'presses' => $presses,
        ));
    }
    
    
     public function actionPressview($id) {
        $press_id = $id;
        $contact_id = Yii::app()->user->id;
        $Criteria = new CDbCriteria();
        $Criteria->condition = "press_id = $id AND contact_id = $contact_id";
        $model = PressJournalist::model()->find($Criteria);
        $this->render('pressview', array('press' => $model));
    }
    
    
     public function actionCompanylist() {
//          $this->widget('booster.widgets.TbSelect2', array(
//                                'htmlOptions' => array(
//            'multiple' => 'multiple',
//        ),
//        'asDropDownList' => true,
//        'model' => $company,
//        'attribute' => 'comp_id',
//
//        'options' => array(
//            'placeholder' => $model->getAttributeLabel('comp_name'),
//            'width' => '48.5%',
//            'class' => 'col-sm-3',
//            'allowClear' => true,
//
//        ),
//        'data' => CHtml::listData(Company::model()->findAll(), 'comp_id', 'comp_name'
//        ),
//    ));
    
         //echo 'aaa';
         $company = new Company;
         $this->renderPartial('_company', array('company'=>$company)); 
         
    }

    public function actionSession()
	{
                Yii::app()->session['type'] = $_POST['type'];
	
	}
    
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Contact;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Contact'])) {
            $model->attributes = $_POST['Contact'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->contact_id));
        }
        
        
        
        $this->render('create', array(
            'model' => $model
        ));
    }
    
    public function actionDashbord() {
        
       
          $model = Contact::model()->findByPk(Yii::app()->user->id);
        
        
        $this->render('dashbord', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate() {
        
         $categories = new BusinessCategory;
                $iso_language = new IsoLanguage;
                $company = new Company;
                $channel = new Channel;
                $function = new Functions;

         $model = Contact::model()->findByPk(Yii::app()->user->id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Contact'])){
                    
                    $contact_id = Yii::app()->user->id;
                    
                    ContactGeoCoverage::model()->deleteGeoCoverage($model->contact_id);
                        ContactFunction::model()->deleteFunction($model->contact_id);
                        RoleChannel::model()->deleteChannel($model->contact_id);
                    
			$model->attributes=$_POST['Contact'];
                       
                        if(isset($_POST['businessCategory'])){
                            $categories_id = $_POST['businessCategory'];
                            $model->businessCategories = $categories_id;
                        }
                      
                        if(isset($_POST['isoLanguage'])){
                            $lang_iso = $_POST['isoLanguage'];
                            $model->isoLanguages = $lang_iso;
                        }
                        
                        
                        if(empty($_POST['Company']) && empty($_POST['companyfield'])){
                            $id_company = 1;
                        }
                        else{
                            if(!empty($_POST['Company'])){
                                $id_company = $_POST['Company'];
                            }
                            else{
                                $company->comp_name = $_POST['companyfield'];
                                $company->save(false);
                                $id_company = $company->comp_id;
                            }
                        }
                        
                        if(isset($_POST['Function'])){
                            $functions = $_POST['Function'];
                             foreach($functions as $f){
                                        $fun = new ContactFunction;
                                        $fun->contact = $contact_id;
                                        $fun->company = $id_company;
                                        $fun->function = $f;
                                        $fun->save();                                   

                                    }
                        }
                        
                        if(isset($_POST['Channel'])){
                            $channels = $_POST['Channel'];
                             foreach($channels as $ch){
                                        $rolechannel = new RoleChannel;
                                        $rolechannel->contact = $contact_id;
                                        $rolechannel->company = 1;
                                        $rolechannel->channel = $ch;
                                        $rolechannel->save();                                   

                                    }
                        }
                        
                        $countries = $_POST['country'];
                        foreach($countries as $c){
                            $cgc = new ContactGeoCoverage;
                            $cgc->contact = $contact_id;
                            $cgc->company = 1;
                            $cgc->geoCountry = $c;
                            $cgc->save();                                   
                        }
                        
                        
			if($model->save()){
                          $this->redirect(array('dashbord','id'=>$model->contact_id));  
                        }
      
		}

                $contact_id = Yii::app()->user->id;
                $companyselected = ContactFunction::model()->findAllBySql("select distinct(company_id) from contact_function where contact_id = $contact_id and company_id <> 1");
                $functionselected = ContactFunction::model()->findAllBySql("select function_id from contact_function where contact_id = $contact_id ");
                $channelselected = RoleChannel::model()->findAllBySql("select channel_id from role_channel where contact_id = $contact_id ");
                $countiesselected = ContactGeoCoverage::model()->findAllBySql("select * from contact_geo_coverage where contact_id =  $contact_id");
                //print_r($countiesselected);
                $this->render('update', array(
            'model' => $model, 'categories'=>$categories, 'iso_language'=>$iso_language, 'countiesselected'=>$countiesselected,
                     'company'=>$company,'companyselected'=>$companyselected, 
                     'channel'=>$channel, 'channelselected'=>$channelselected, 
                     'function'=>$function, 'functionselected'=>$functionselected
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
        $dataProvider = new CActiveDataProvider('Contact');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Contact('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Contact']))
            $model->attributes = $_GET['Contact'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Contact the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Contact::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Contact $model the model to be validated
     */
    protected function performAjaxValidation($model) {

        // ajax validator
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'contact-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
