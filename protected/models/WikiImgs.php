<?php

class WikiImgs extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $profile
	 */
        public $_identity;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return '{{wiki_imgs}}';
	}


	public function rules()
	{
		return array(
                        array('Wid,UserId','required'),
			array('Wid,UserId,Title,Icon,CreateTime', 'safe'),
		);
	}
        /*
         * 获取详细页面的图片五张
         */
        public function getPicByWid($wid){
            $sql="SELECT Icon FROM {{wiki_imgs}} WHERE Wid={$wid} ORDER BY CreateTime DESC LIMIT 5";
            $result=  Yii::app()->db->createCommand($sql)->queryAll();
            return $result;
        }

   
	
	
}