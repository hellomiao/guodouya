<?php

class UserController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to access 'index' and 'view' actions.
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated users to access all actions
                'users' => array('@'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionSetting() {
         $user = User::model()->findByPk(Yii::app()->user->id);
         $this->pageTitle = "设置";
         $data=array(
            'user'=>$user,
        );
        $this->render("setting",$data);
    }
    


    public function actionAjaxSetting() {
        $uid = Yii::app()->user->id;
        $nickname = $_POST['nickname'];
        $oldpwd = $_POST['oldpwd'];
        $newpwd = $_POST['newpwd'];
        $user = User::model()->findByPk($uid);
        $userx = User::model()->findByPk($uid);
        if ($nickname && $nickname != $user->NickName) {
            $user->NickName = $nickname;
        }
        if ($oldpwd && $newpwd) {
            $_oldpwd = $user->hashPassword($oldpwd);
            if ($user->PassWord == $_oldpwd) {
                $_newpwd = $user->hashPassword($newpwd);
                $user->PassWord = $_newpwd;
            } else {
                echo '1';
            }
        }

        $src_file = $_POST['imgpath'];
        if ($src_file!='') {
            $IoHandler = new IoHandler();
            if (!Utils::is_image($src_file)) {
                $IoHandler->DeleteFile($src_file);
                Utils::js_alert_output("请上传正确的图片文件");
            }
            $image_path = './files/picture/' . Utils::face_path($uid);
            //echo  $image_path;
            if (!is_dir($image_path)) {
                $IoHandler->MakeDir($image_path);
            }
            $dst_file = $image_path . $uid . '.jpg';
            $big_dst_file = $image_path .$uid .'_big.jpg';
            $avatar = '/files/picture/' . Utils::face_path($uid) . $uid . '.jpg';
            $make_result1 = Utils::my_image_resize($src_file, $dst_file, 128, 128);
            $make_result2 = Utils::my_image_resize($src_file, $big_dst_file, 160, 200);
            $user->Picture = $avatar;
            $IoHandler->DeleteFile($src_file);

        }

        if (($nickname && $nickname != $userx->NickName) || ($oldpwd && $newpwd)||$src_file!='') {
            if ($user->save()) {
                echo '2';
            }
        } else {
            echo '3';
        }
    }
    
        public function actionAjaxUpload() {
      
        $field = 'face';
        $arr=explode(".", $_FILES[$field]['name']);
        $IoHandler = new IoHandler();
        $type = trim(strtolower(end($arr)));
        if ($type != 'gif' && $type != 'jpg' && $type != 'png') {
            Utils::js_alert_output('图片格式不对');
        }
        
        $image_name = substr(md5($_FILES[$field]['name']), -10) . ".{$type}";
        //$image_name_ = 's'.substr(md5($_FILES[$field]['name']),-10).".{$type}";
        $image_path = './files/temp_imgs/' . $image_name{0} . '/';
        $image_file = $image_path . $image_name;
        $image_file_ = '/files/temp_imgs/' . $image_name{0} . '/' . $image_name;
        if (!is_dir($image_path)) {
            $IoHandler->MakeDir($image_path);
        }
  
        $UploadHandler = new UploadHandler($_FILES, $image_path, $field, true, true, 500, 400);
        $UploadHandler->setMaxSize(2048);
        $UploadHandler->setNewName($image_name);
        $result = $UploadHandler->doUpload();
   
        if ($result) {
            $result = Utils::is_image($image_file);
        }
       $make_result1 = Utils::my_image_resize($image_file, $image_file, 256, 256);
        if (!$result) {
            $IoHandler->RemoveDir($image_path);
            Utils::js_alert_output('图片上载失败');
        }

        $up_image_path = Yii::app()->request->baseUrl . $image_file_;
        //$up_image_path_  =PicDomain.substr($up_image_path ,1);
        //Utils::js_alert_output($up_image_path_);
      
        echo "<script language='Javascript'>";
        echo "parent.document.getElementById('face_form').style.display='block';";
        //echo "parent.document.getElementById('cropbox').src='';";
        echo "parent.document.getElementById('crop_preview').src='{$up_image_path}';";
        echo "parent.document.getElementById('img_path').value='{$image_file}';";
        echo "</script>";
    }
    
       

}
