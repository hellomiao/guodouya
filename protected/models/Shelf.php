<?php

/**
 * This is the model class for table "{{shelf}}".
 *
 * The followings are the available columns in table '{{shelf}}':
 * @property integer $ID
 * @property integer $Uid
 * @property string $Name
 * @property string $Route
 * @property string $Info
 * @property integer $Status
 * @property string $CreateTime
 */
class Shelf extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Shelf the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{shelf}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $arr = Yii::app()->params['Word'];
        $word = $arr[0];
        return array(
            array('Name, Route, Info', 'required', "on" => "create"),
            array('Uid, Status', 'numerical', 'integerOnly' => true),
            array('Name', 'length', 'min' => 5, 'max' => 20),
            array('Route', 'length', 'min' => 3, 'max' => 30),
            array('Route', 'in', 'not' => true, 'range' =>$word),
            array('Info', 'length', 'min' => 5, 'max' => 200),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, Uid,Status, CreateTime', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'Uid' => 'Uid',
            'Name' => 'Name',
            'Route' => 'Route',
            'Info' => 'Info',
            'Status' => 'Status',
            'CreateTime' => 'Create Time',
        );
    }

}