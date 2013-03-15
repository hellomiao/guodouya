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

}

