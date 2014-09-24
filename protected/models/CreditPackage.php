<?php

/**
 * This is the model class for table "credit_package".
 *
 * The followings are the available columns in table 'credit_package':
 * @property integer $credit_package_id
 * @property integer $basic_credit_id
 * @property integer $extention_credit_id
 * @property string $package_title
 * @property integer $package_rank
 *
 * The followings are the available model relations:
 * @property Credit $extentionCredit
 * @property Credit $basicCredit
 * @property PackagedCredit $packagedCredit
 * @property UserPackage[] $userPackages
 */
class CreditPackage extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'credit_package';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('basic_credit_id, extention_credit_id, package_title, package_rank', 'required'),
			array('basic_credit_id, extention_credit_id, package_rank', 'numerical', 'integerOnly'=>true),
			array('package_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('credit_package_id, basic_credit_id, extention_credit_id, package_title, package_rank', 'safe', 'on'=>'search'),
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
			'extentionCredit' => array(self::BELONGS_TO, 'Credit', 'extention_credit_id'),
			'basicCredit' => array(self::BELONGS_TO, 'Credit', 'basic_credit_id'),
			'packagedCredit' => array(self::HAS_ONE, 'PackagedCredit', 'credit_package_id'),
			'userPackages' => array(self::HAS_MANY, 'UserPackage', 'credit_package_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'credit_package_id' => 'Credit Package',
			'basic_credit_id' => 'Basic Credit',
			'extention_credit_id' => 'Extention Credit',
			'package_title' => 'Package Title',
			'package_rank' => 'Package Rank',
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

		$criteria->compare('credit_package_id',$this->credit_package_id);
		$criteria->compare('basic_credit_id',$this->basic_credit_id);
		$criteria->compare('extention_credit_id',$this->extention_credit_id);
		$criteria->compare('package_title',$this->package_title,true);
		$criteria->compare('package_rank',$this->package_rank);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CreditPackage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
