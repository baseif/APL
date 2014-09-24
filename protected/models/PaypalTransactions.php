<?php

/**
 * This is the model class for table "paypal_transactions".
 *
 * The followings are the available columns in table 'paypal_transactions':
 * @property integer $pp_id
 * @property string $pp_pay_type
 * @property string $pp_txn_type
 * @property string $pp_txn_id
 * @property string $pp_amount
 * @property string $pp_tax
 * @property string $pp_pay_status
 * @property string $pp_payer_email
 * @property string $pp_payer_id
 * @property string $pp_date
 * @property integer $pp_user_id
 * @property string $pp_item
 * @property string $pp_text
 *
 * The followings are the available model relations:
 * @property User $ppUser
 */
class PaypalTransactions extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'paypal_transactions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pp_pay_type, pp_txn_type, pp_txn_id, pp_amount, pp_tax, pp_pay_status, pp_payer_email, pp_payer_id, pp_date, pp_user_id, pp_item', 'required'),
			array('pp_user_id', 'numerical', 'integerOnly'=>true),
			array('pp_pay_type, pp_txn_type, pp_txn_id, pp_pay_status, pp_payer_email, pp_payer_id, pp_item', 'length', 'max'=>255),
			array('pp_amount, pp_tax', 'length', 'max'=>10),
			array('pp_text', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('pp_id, pp_pay_type, pp_txn_type, pp_txn_id, pp_amount, pp_tax, pp_pay_status, pp_payer_email, pp_payer_id, pp_date, pp_user_id, pp_item, pp_text', 'safe', 'on'=>'search'),
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
			'ppUser' => array(self::BELONGS_TO, 'User', 'pp_user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'pp_id' => 'Pp',
			'pp_pay_type' => 'Pp Pay Type',
			'pp_txn_type' => 'Pp Txn Type',
			'pp_txn_id' => 'Pp Txn',
			'pp_amount' => 'Pp Amount',
			'pp_tax' => 'Pp Tax',
			'pp_pay_status' => 'Pp Pay Status',
			'pp_payer_email' => 'Pp Payer Email',
			'pp_payer_id' => 'Pp Payer',
			'pp_date' => 'Pp Date',
			'pp_user_id' => 'Pp User',
			'pp_item' => 'Pp Item',
			'pp_text' => 'Pp Text',
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

		$criteria->compare('pp_id',$this->pp_id);
		$criteria->compare('pp_pay_type',$this->pp_pay_type,true);
		$criteria->compare('pp_txn_type',$this->pp_txn_type,true);
		$criteria->compare('pp_txn_id',$this->pp_txn_id,true);
		$criteria->compare('pp_amount',$this->pp_amount,true);
		$criteria->compare('pp_tax',$this->pp_tax,true);
		$criteria->compare('pp_pay_status',$this->pp_pay_status,true);
		$criteria->compare('pp_payer_email',$this->pp_payer_email,true);
		$criteria->compare('pp_payer_id',$this->pp_payer_id,true);
		$criteria->compare('pp_date',$this->pp_date,true);
		$criteria->compare('pp_user_id',$this->pp_user_id);
		$criteria->compare('pp_item',$this->pp_item,true);
		$criteria->compare('pp_text',$this->pp_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PaypalTransactions the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
