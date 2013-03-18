<?php

/**
 * This is the model class for table "{{managers}}".
 *
 * The followings are the available columns in table '{{managers}}':
 * @property integer $ID
 * @property string $UserName
 * @property string $PassWord
 * @property string $CreateTime
 */
class Managers extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Managers the static model class
     */
    public $rememberMe;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{managers}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('UserName, PassWord', 'required','on'=>'login'),
            array('UserName', 'length', 'max' => 45),
            array('PassWord', 'length', 'max' => 35),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, UserName, PassWord, CreateTime', 'safe', 'on' => 'search'),
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
            'UserName' => 'User Name',
            'PassWord' => 'Pass Word',
            'CreateTime' => 'Create Time',
        );
    }

    public function authenticate($attribute, $params) {

        $this->_identity = new UserIdentity($this->username, $this->password);
        if (!$this->_identity->authenticate())
            $this->addError('password', '错误的用户名或密码');
    }

    public function login() {

        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
            Yii::app()->user->login($this->_identity,  $duration);
            return true;
        }
        else
            return false;
    }

    public function validatePassword($password) {

        //return $password===$this->Password;
        return $this->hashPassword($password) === $this->password;
    }

    public function hashPassword($password) {
        return substr(md5($password), 8, 16);
    }

}