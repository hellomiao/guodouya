<?php

/**
 * This is the model class for table "{{shelf_guestbook}}".
 *
 * The followings are the available columns in table '{{shelf_guestbook}}':
 * @property integer $ID
 * @property integer $Sid
 * @property integer $UserId
 * @property integer $Pid
 * @property string $Content
 * @property string $CreateTime
 */
class ShelfGuestbook extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ShelfGuestbook the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{shelf_guestbook}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Content', 'required'),
			array('Sid, UserId, Pid', 'numerical', 'integerOnly'=>true),
			array('Content', 'length', 'max'=>500),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, Sid, UserId, Pid, Content, CreateTime', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'Sid' => 'Sid',
			'UserId' => 'User',
			'Pid' => 'Pid',
			'Content' => 'Content',
			'CreateTime' => 'Create Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('Sid',$this->Sid);
		$criteria->compare('UserId',$this->UserId);
		$criteria->compare('Pid',$this->Pid);
		$criteria->compare('Content',$this->Content,true);
		$criteria->compare('CreateTime',$this->CreateTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}