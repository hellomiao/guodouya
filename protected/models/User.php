<?php

class User extends CActiveRecord {

    /**
     * The followings are the available columns in table 'tbl_user':
     * @var integer $id
     * @var string $username
     * @var string $password
     * @var string $email
     * @var string $profile
     */
    public $_identity;

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{users}}';
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
            array('Email,PassWord', 'required', 'on' => 'login'),
            array('Email,NickName,PassWord', 'required', 'on' => 'register'),
            array('Email', 'length', 'max' => 128),
            array('Email', 'email'),
            array('NickName', 'length', 'min' => 3, 'max' => 10),
            array('NickName', 'in', 'not' => true, 'range' =>$word),
            array('Picture,Money,LastLogin,CreateTime,ActiveFlag', 'safe'),
        );
    }

    public function login() {

        if ($this->_identity === null) {

            $this->_identity = new UserIdentity($this->Email, $this->PassWord);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            //$duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days

            Yii::app()->user->login($this->_identity, 3600 * 4);
            return true;
        }
        else
            return false;
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        return crypt($password, $this->PassWord) === $this->PassWord;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @return string hash
     */
    public function hashPassword($password) {
        return crypt($password, $this->generateSalt());
    }

    /**
     * Generates a salt that can be used to generate a password hash.
     *
     * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
     * requires, for the Blowfish hash algorithm, a salt string in a specific format:
     *  - "$2a$"
     *  - a two digit cost parameter
     *  - "$"
     *  - 22 characters from the alphabet "./0-9A-Za-z".
     *
     * @param int cost parameter for Blowfish hash algorithm
     * @return string the salt
     */
    protected function generateSalt($cost = 10) {
        if (!is_numeric($cost) || $cost < 4 || $cost > 31) {
            throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
        }
        // Get some pseudo-random data from mt_rand().
        $rand = '';
        for ($i = 0; $i < 8; ++$i)
            $rand.=pack('S', mt_rand(0, 0xffff));
        // Add the microtime for a little more entropy.
        $rand.=microtime();
        // Mix the bits cryptographically.
        $rand = sha1($rand, true);
        // Form the prefix that specifies hash algorithm type and cost parameter.
        $salt = '$2a$' . str_pad((int) $cost, 2, '0', STR_PAD_RIGHT) . '$';
        // Append the random salt string in the required base64 format.
        $salt.=strtr(substr(base64_encode($rand), 0, 22), array('+' => '.'));
        return $salt;
    }

    //激活发送邮件操作
    public function ActiveMailSend($uid) {
        $user = User::model()->findByPk($uid);
        $tomail = $user->Email;
        $frommail = Yii::app()->params['MailUser'];
        $fromname = Yii::app()->params['EmailName'];
        $subject = "系统激活邮件";
        $x = md5($user->Email . '+' . $user->PassWord);
        $string = base64_encode($user->Email . "." . $x);
        $url = Yii::app()->params['Domain'] . '/user/Active?p=' . $string;
        $content = "账号激活程序，请点此" . '< a href=' . $url . '>' . $url . '</a> 激活' . ",或者将以下内容复制到地址栏中打开！";
        $sendEmail = Utils::sendmail($frommail, $fromname, $tomail, $subject, $content, NULL, NULL);
        if ($sendEmail) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //激活操作;
    public function activeUser($uid) {
        $sql = "update {{users}} set ActiveFlag=1 where UID={$uid}";
        $result = Yii::app()->db->createCommand($sql)->query();
        if ($result) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //获取头像
    public function getPicture($uid, $type = "small") {
        $user = User::model()->findByPk($uid);
        if ($user->Picture) {
            $picture = $user->Picture;
            if ($type == 'big') {
                $arr = explode(".", $picture);
                $type = trim(strtolower(end($arr)));
                $big = $arr[0] . '_big.' . $type;
                return Yii::app()->baseUrl . $big;
            } else {
                return Yii::app()->baseUrl . $picture;
            }
        } else {
            return Yii::app()->baseUrl . '/files/picture/default.jpg';
        }
    }

}