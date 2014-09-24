<?php

/**
 * This is the model class for table "credit_history".
 *
 * The followings are the available columns in table 'credit_history':
 * @property string $ch_id
 * @property integer $ch_user
 * @property string $ch_type
 * @property integer $ch_amount
 * @property integer $ch_target_id
 * @property string $ch_notes
 * @property string $ch_date
 *
 * The followings are the available model relations:
 * @property List $chTarget
 * @property User $chUser
 */
class CreditHistory extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'credit_history';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ch_user, ch_type, ch_amount, ch_target_id, ch_date', 'required'),
			array('ch_user, ch_amount, ch_target_id', 'numerical', 'integerOnly'=>true),
			array('ch_type, ch_notes', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ch_id, ch_user, ch_type, ch_amount, ch_target_id, ch_notes, ch_date', 'safe', 'on'=>'search'),
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
			'listcontact' => array(self::BELONGS_TO, 'ListContact', 'ch_target_id'),
			'user' => array(self::BELONGS_TO, 'Client', 'ch_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ch_id' => 'Ch',
			'ch_user' => 'Ch User',
			'ch_type' => 'Ch Type',
			'ch_amount' => 'Ch Amount',
			'ch_target_id' => 'Ch Target',
			'ch_notes' => 'Ch Notes',
			'ch_date' => 'Ch Date',
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

		$criteria->compare('ch_id',$this->ch_id,true);
		$criteria->compare('ch_user',$this->ch_user);
		$criteria->compare('ch_type',$this->ch_type,true);
		$criteria->compare('ch_amount',$this->ch_amount);
		$criteria->compare('ch_target_id',$this->ch_target_id);
		$criteria->compare('ch_notes',$this->ch_notes,true);
		$criteria->compare('ch_date',$this->ch_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CreditHistory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
