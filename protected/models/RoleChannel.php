<?php

/**
 * This is the model class for table "role_channel".
 *
 * The followings are the available columns in table 'role_channel':
 * @property integer $company_id
 * @property integer $contact_id
 * @property integer $channel_id
 *
 * The followings are the available model relations:
 * @property Company $company
 * @property Contact $contact
 * @property Channel $channel
 */
class RoleChannel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'role_channel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('company_id, contact_id, channel_id', 'required'),
			array('company_id, contact_id, channel_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('company_id, contact_id, channel_id', 'safe', 'on'=>'search'),
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
			'company' => array(self::BELONGS_TO, 'Company', 'company_id'),
			'contact' => array(self::BELONGS_TO, 'Contact', 'contact_id'),
			'channel' => array(self::BELONGS_TO, 'Channel', 'channel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'company_id' => 'Company',
			'contact_id' => 'Contact',
			'channel_id' => 'Channel',
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

		$criteria->compare('company_id',$this->company_id);
		$criteria->compare('contact_id',$this->contact_id);
		$criteria->compare('channel_id',$this->channel_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RoleChannel the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function behaviors() {
        return array(
            'activerecord-relation' => array(
                'class' => 'ext.yiiext.behaviors.activerecord-relation.EActiveRecordRelationBehavior',
            ),
        );
        }
        
        public function deleteChannel($id) {
        $this->model()->deleteAllByAttributes(array('contact_id'=>$id));
        
    }
}
