<?php

/**
 * This is the model class for table "credit".
 *
 * The followings are the available columns in table 'credit':
 * @property integer $credit_id
 * @property string $credit_show
 * @property integer $credit_amount
 * @property string $credit_price
 * @property integer $credit_duration
 * @property string $credit_notes
 *
 * The followings are the available model relations:
 * @property CreditPackage[] $creditPackages
 * @property CreditPackage[] $creditPackages1
 * @property PackagedCredit[] $packagedCredits
 */
class Credit extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'credit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('credit_show, credit_amount, credit_price, credit_duration, credit_notes', 'required'),
			array('credit_amount, credit_duration', 'numerical', 'integerOnly'=>true),
			array('credit_show', 'length', 'max'=>1),
			array('credit_price', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('credit_id, credit_show, credit_amount, credit_price, credit_duration, credit_notes', 'safe', 'on'=>'search'),
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
			'creditPackages' => array(self::HAS_MANY, 'CreditPackage', 'extention_credit_id'),
			'creditPackages1' => array(self::HAS_MANY, 'CreditPackage', 'basic_credit_id'),
			'packagedCredits' => array(self::HAS_MANY, 'PackagedCredit', 'credit_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'credit_id' => 'Credit',
			'credit_show' => 'Credit Show',
			'credit_amount' => 'Credit Amount',
			'credit_price' => 'Credit Price',
			'credit_duration' => 'Credit Duration',
			'credit_notes' => 'Credit Notes',
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

		$criteria->compare('credit_id',$this->credit_id);
		$criteria->compare('credit_show',$this->credit_show,true);
		$criteria->compare('credit_amount',$this->credit_amount);
		$criteria->compare('credit_price',$this->credit_price,true);
		$criteria->compare('credit_duration',$this->credit_duration);
		$criteria->compare('credit_notes',$this->credit_notes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Credit the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
