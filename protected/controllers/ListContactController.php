<?php

class ListContactController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //public $layout = 'main';

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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('admin', 'create', 'update', 'delete', 'deletelist','deleteall','listupdate','addcontact','addallcontact','removecontact','removeallcontact'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array(''),
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

        $list = ListContact::model()->findByPk($id);
        $contact = $list->contacts;
        $this->render('view', array(
            'model' => $this->loadModel($id),
            'contact' => $contact,
        ));
    }
    
    
    public function actionListupdate(){
        echo ' <select size="15" multiple name="contact_id_of_list[]" onchange="Remove_Removeall()" class="form-control " id="tagUpdate">';
        $idlist = $_GET['namelist'];
        $list = ListContact::model()->findByPk($idlist);
        
        $contact = $list->contacts;
    foreach($contact as $value){
        if($value!=''){
        $name = $value->contact_name_first.' '.$value->contact_name_last;
        echo ' <option  selected value ="' . $value->contact_id . '" >' . $name . '</option>';
        }
        
    }
    echo '</select>';
    }
    
    
    
    
    
    public function actionAddcontact()
 {
    $source = $_GET['source'];
    $destination= $_GET['destination'];
    $tabsource = explode(',',$source);
    $tabdestination = explode(',',$destination);
    $tab = array_merge($tabsource,$tabdestination);
    $final = array_unique($tab);
    echo '<select size="15" multiple name="contact_id_of_list[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">';
    foreach($final as $value){
        if($value!=''){
            $element = Contact::model()->FindByPk($value);
        $name = $element->contact_name_first.' '.$element->contact_name_last;
        echo ' <option  selected value ="' . $value . '" >' . $name . '</option>';
        }
        
    }
    echo '</select>';
 }

 
 
 public function actionAddallcontact(){
     $source = $_POST['source'];
     $tabsource = explode(',',$source);
     //print_r($tabsource);
      echo '<select size="15" multiple name="contact_id_of_list[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">';
    foreach($tabsource as $value){
        if($value!=''){
            $element = Contact::model()->FindByPk($value);
            $name = $element->contact_name_first.' '.$element->contact_name_last;
            echo ' <option selected   value ="' . $value . '" >' . $name . '</option>';
        }
        
    }
    echo '</select>';
 }
 
 
 public function actionRemoveallcontact(){
      echo '<select size="15" multiple name="contact_id_of_list[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">';
    echo '</select>';
 }
 
 
 public function actionRemovecontact()
 {
    $destination= $_GET['destination'];
    $tabdestination = explode(',',$destination);
    echo '<select size="15" multiple name="contact_id_of_list[]" class="form-control" onchange="Remove_Removeall()" id="tagUpdate">';
    foreach($tabdestination as $value){
        if($value!=''){
            $element = Contact::model()->FindByPk($value);
            $name = $element->contact_name_first.' '.$element->contact_name_last;
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
        $model = new ListContact;


      
         if(isset($_POST['yt0'])){
            
            $req = ListContact::model()->SearchFilter();
           
        }
        else{
            $req = ListContact::model()->FindALLWithBlackList();
            
        }
        
        require_once 'protected/models/technique.php';
            $technique = new Technique(); 
            $contact = $technique->arrayToObject($req);
        

        if (isset($_POST['ListContact'])) {

            if (isset($_POST['yt1'])) {
                $model->attributes = $_POST['ListContact'];

                if ($model->save()) {
                    $contact = ListContact::model()->findByPk($model->list_id);
                    $contacts_id = $_POST['contact_id'];
                    $contact->contacts = $contacts_id;
                    $contact->save();
                    $this->redirect(array('view', 'id' => $model->list_id));
                }
            }
            
           if( isset($_POST['yt2'])) {
               $list_id = $_POST['ListContact']['list_id'];
                $contact = ListContact::model()->findByPk($list_id);
                    $contacts_id = $_POST['contact_id_of_list'];
                    $contact->contacts = $contacts_id;
                    $contact->save();
                $this->redirect(array('view', 'id' => $list_id));
            }
        }
        
        
        $categories = new BusinessCategory;
        $isolanguages = new IsoLanguage;
        $georegion = new GeoRegion;
        
        $listcontact = ListContact::model()->findAll();
        $this->render('create', array(
            'model' => $model, 'contact' => $contact, 'listcontact' => $listcontact, 'categories' => $categories,
            'isolanguages' => $isolanguages, 'georegion' => $georegion
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['ListContact'])) {
            $model->attributes = $_POST['ListContact'];
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->list_id));
        }

        $this->render('update', array(
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

    public function actionDeletelist($id) {
        $this->loadModel($id)->delete();

        $this->redirect(Yii::app()->request->baseUrl . '/index.php/listContact/index');
    }
    
    public function actionDeleteall($id) {
        $contact = $_POST['contact_id'];
        
        $listcontact = ListContact::model()->findByPk($id);
        $contactsdb = $listcontact->contacts;
        
         foreach ($contactsdb as $value){
             $tab[] = $value->contact_id;
         }
        
        foreach ($contact as $contact_id){
           
            if(($key = array_search($contact_id, $tab)) !== false) {
               unset($tab[$key]);
            } 
        }
        $listcontact->contacts = $tab;
        $listcontact->save();
        $this->redirect(Yii::app()->request->baseUrl . '/index.php/listContact/view/'.$id);
    }
    
    /**
     * Lists all models.
     */
    public function actionIndex() {
            
        
            $user = Client::model()->findByPk(Yii::app()->user->id);
            $list = $user->lists;
     

        $this->render('index', array(
            'list' => $list,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new ListContact('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['ListContact']))
            $model->attributes = $_GET['ListContact'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return ListContact the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = ListContact::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param ListContact $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'list-contact-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
