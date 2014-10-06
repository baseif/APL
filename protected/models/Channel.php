<?php

/**
 * This is the model class for table "channel".
 *
 * The followings are the available columns in table 'channel':
 * @property integer $channel_id
 * @property string $channel_title
 * @property string $channel_category
 *
 * The followings are the available model relations:
 * @property ChannelTranslation $channelTranslation
 * @property RoleChannel[] $roleChannels
 */
class Channel extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'channel';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('channel_title', 'required'),
			array('channel_title', 'length', 'max'=>255),
			array('channel_category', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('channel_id, channel_title, channel_category', 'safe', 'on'=>'search'),
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
			'channelTranslation' => array(self::HAS_ONE, 'ChannelTranslation', 'channel_id'),
			'roleChannels' => array(self::HAS_MANY, 'RoleChannel', 'channel_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'channel_id' => 'Media Types',
			'channel_title' => 'Media Types',
			'channel_category' => 'Media Types',
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

		$criteria->compare('channel_id',$this->channel_id);
		$criteria->compare('channel_title',$this->channel_title,true);
		$criteria->compare('channel_category',$this->channel_category,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Channel the static model class
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
}
