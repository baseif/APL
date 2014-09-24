<?php

/**
 * This is the model class for table "list".
 *
 * The followings are the available columns in table 'list':
 * @property integer $list_id
 * @property integer $list_user
 * @property string $list_name
 * @property string $ist_notes
 * @property integer $list_added
 * @property integer $list_modified
 *
 * The followings are the available model relations:
 * @property CreditHistory[] $creditHistories
 * @property User $listUser
 * @property Contact[] $contacts
 * @property Press[] $presses
 */
class ListContact extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'list';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('list_user, list_name, list_added', 'required'),
            array('list_user, list_added, list_modified', 'numerical', 'integerOnly' => true),
            array('list_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('list_id, list_user, list_name, ist_notes, list_added, list_modified', 'safe', 'on' => 'search'),
           // array('list_name', 'unique'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'creditHistories' => array(self::HAS_MANY, 'CreditHistory', 'ch_target_id'),
            'listUser' => array(self::BELONGS_TO, 'User', 'list_user'),
            'contacts' => array(self::MANY_MANY, 'Contact', 'list_contact(list_id, contact_id)'),
            'presses' => array(self::HAS_MANY, 'Press', 'list_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'list_id' => 'List',
            'list_user' => 'List User',
            'list_name' => 'List Name',
            'ist_notes' => 'Ist Notes',
            'list_added' => 'List Added',
            'list_modified' => 'List Modified',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('list_id', $this->list_id);
        $criteria->compare('list_user', $this->list_user);
        $criteria->compare('list_name', $this->list_name, true);
        $criteria->compare('ist_notes', $this->ist_notes, true);
        $criteria->compare('list_added', $this->list_added);
        $criteria->compare('list_modified', $this->list_modified);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return ListContact the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function behaviors() {
        return array(
            'activerecord-relation' => array(
                'class' => 'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior',
            ),
        );
    }
    
    public function SearchFilter(){
       
            if(isset($_POST['BusinessCategory'])){
                $cat_id = $_POST['BusinessCategory'];
             }
            else{
                $category = BusinessCategory::model()->findAll();
                foreach($category as $cat){
                    $cat_id[] = $cat->cat_id;
                }
            }
                $chainecat = '(';
                $i=1;
                foreach($cat_id as $value){
                    $chainecat.=$value;
                    if($i<count($cat_id)){
                        $chainecat.=',';
                    }
                    $i++;
                }
                $chainecat .= ')';
                
            $fromcategory = ',contact_category';
            $wherecategory = '  and contact_category.contact_id=contact.contact_id 
                                and contact_category.cat_id in '.$chainecat;
            
           
            
   
            if(isset($_POST['IsoLanguage'])){
                
                $lang_iso = $_POST['IsoLanguage'];
             }
            else{
                $language = IsoLanguage::model()->findAll();
                foreach($language as $lan){
                    $lang_iso[] = $lan->lang_iso;
                }
            }
                $chainelanguage = '(';
                $i=1;
                foreach($lang_iso as $value){
                    $chainelanguage.="'".$value."'";
                    if($i<count($lang_iso)){
                        $chainelanguage.=',';
                    }
                    $i++;
                }
                $chainelanguage .= ')';
                
                
                
                $fromlang = ',contact_language';
                $wherelang = " and contact_language.contact_id=contact.contact_id
                               and contact_language.lang_iso in ".$chainelanguage;
                
                
                
                
         
            if(isset($_POST['Channel'])){
                
                $channel = $_POST['Channel'];
             }
            else{
                $allchannel = Channel::model()->findAll();
                foreach($allchannel as $ch){
                    $channel[] = $ch->channel_id;
                }
            }
                $chainechannel = '(';
                $i=1;
                foreach($channel as $value){
                    $chainechannel.=$value;
                    if($i<count($channel)){
                        $chainechannel.=',';
                    }
                    $i++;
                }
                $chainechannel .= ')';
                
                
                
                $fromchannel = ',role_channel';
                $wherechannel = " and role_channel.contact_id=contact.contact_id
                               and role_channel.channel_id in ".$chainechannel;
                
            
                
                
         
            if(isset($_POST['GeoRegion'])){
                    $region = $_POST['GeoRegion'];
                }
                else{
                    $tabregion = GeoRegion::model()->GeoRegionAfrica();
                foreach($tabregion as $reg){
                    $region[] = $reg->geo_region_id;
                }
                }
                
                 $chaineregion = '(';
                $i=1;
                foreach($region as $value){
                    $chaineregion.=$value;
                    if($i<count($region)){
                        $chaineregion.=',';
                    }
                    $i++;
                }
                $chaineregion .= ')';
                
                
                $fromregion = ',contact_geo_coverage, iso_country';
                $whereregion = " and iso_country.geo_region_id in ".$chaineregion."
                               and contact_geo_coverage.geo_country_id=iso_country.country_iso
                               and contact.contact_id = contact_geo_coverage.contact_id";
                
            
            
            $client = Client::model()->findByPk(Yii::app()->user->id);
            $contacts = $client->contacts;
            $notin = '';
            if(count($contacts)>0){
                $chaine='(';
                $i=1;

                foreach($contacts as $value){
                  $chaine .=$value->contact_id;
                  if($i<count($contacts)){
                      $chaine.=',';
                  }
                  $i++;
                }
                $chaine.=')';
                $notin = "and contact.contact_id not in $chaine";
            }
            
            $sql = "select distinct(contact.contact_id), contact_name_last, contact_name_first  from contact 
                    $fromcategory $fromlang $fromregion $fromchannel 
                    where contact.status = 1
                    $notin
                    $wherecategory
                    $wherelang 
                    $whereregion
                    $wherechannel
                    ";
           // echo $sql;
            
           $tab = Yii::app()->db->createCommand($sql)->queryAll();
           
           return $tab;
    }
    public function FindALLWithBlackList(){
        $client = Client::model()->findByPk(Yii::app()->user->id);
        $contacts = $client->contacts;
        $notin = '';
            if(count($contacts)>0){
                $chaine='(';
                $i=1;

                foreach($contacts as $value){
                  $chaine .=$value->contact_id;
                  if($i<count($contacts)){
                      $chaine.=',';
                  }
                  $i++;
                }
                $chaine.=')';
                $notin = "where contact.contact_id not in $chaine";
            }
            
        $sql = "select * from contact $notin";
        $req = Yii::app()->db->createCommand($sql)->queryAll();
        return $req;
    }
}
