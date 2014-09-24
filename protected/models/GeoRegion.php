<?php

/**
 * This is the model class for table "geo_region".
 *
 * The followings are the available columns in table 'geo_region':
 * @property integer $geo_region_id
 * @property string $region_name
 *
 * The followings are the available model relations:
 * @property Company[] $companies
 * @property GeoCluster[] $geoClusters
 * @property IsoCountry[] $isoCountries
 */
class GeoRegion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'geo_region';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('region_name', 'required'),
			array('region_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('geo_region_id, region_name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'companies' => array(self::HAS_MANY, 'Company', 'comp_pub_region'),
			'geoClusters' => array(self::MANY_MANY, 'GeoCluster', 'geo_region_cluster(geo_region_id, geo_cluster_id)'),
			'isoCountries' => array(self::HAS_MANY, 'IsoCountry', 'geo_region_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'geo_region_id' => 'Geo Region',
			'region_name' => 'Region Name',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('geo_region_id',$this->geo_region_id);
		$criteria->compare('region_name',$this->region_name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function GeoRegionAfrica()
	{
             $georegion = GeoRegion::model()->findAllBySql('select * from geo_region where geo_region_id in(1,2,3,4,5)'); 
            return $georegion;
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GeoRegion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
