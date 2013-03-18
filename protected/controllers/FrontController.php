<?php

class FrontController extends Controller {

    public function actionIndex() {
        $this->layout = "loginLayout";
        $this->render("index");
    }

    public function actionLogin() {
        $this->layout = "loginLayout";
        $this->render("login");
   
    }

    public function actionAjaxLogin() {
        $User = new User('login');
        if (isset($_POST['LoginForm'])) {
            $User->attributes = $_POST['LoginForm'];
           
              if ($User->validate()&&$User->login()) {
                 echo 'ok';
            }else{
                echo 'false';
            }
        }
    }
    
     public function actionAjaxRegister() {
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new User('register');
        $user->NickName = $nickname;
        $user->Email = $email;
        $user->PassWord = $user->hashPassword($password);
        if ($user->validate()&&$user->save()) {
            $rs = $user->ActiveMailSend($user->ID);
            $Users = new User('login');
            $Users->Email = $email;
            $Users->PassWord = $password;
            if($Users->login()){
                 echo 'ok';
            }
          
        }
    }
    
    public function actionActive() {
        if (isset($_GET['p'])) {
            $array = explode('.', base64_decode($_GET['p']));
            $email = $array[0] . '.' . $array[1];

            $User = User::model()->find("Email='{$email}'");
            $checkCode = md5($email . '+' . $User->PassWord);
            if ($array['2'] === $checkCode) {
                $result = User::model()->activeUser($User->ID);
                if ($result) {
                    $this->redirect($this->createUrl("login"));
                }
            }
        }
    }
    
        public function actionAjaxCheckEmail() {
        $email = $_POST['email'];
        $sql = "select ID from {{users}} where Email='{$email}'";
        $result = Yii::app()->db->createCommand($sql)->queryRow();
        if ($result) {
            echo '电子邮箱已存在!';
        } else {
            echo 'ok';
        }
    }

}

