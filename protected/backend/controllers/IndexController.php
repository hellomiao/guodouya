<?php

class IndexController extends CController {

    public function actionIndex() {
        echo 1;
    }

    public function actionLogin() {
        $manager = new Managers('login');
        if (isset($_POST['LoginForm'])) {
            $manager->attributes = $_POST['LoginForm'];
            if ($manager->validate('login') && $manager->login()) {
                $manager = Managers::model()->find('UserName=:username', array(':username' => $manager->UserName));
                $manager->LastLoginTime = date("Y-m-d H:i:s",time());
                $manager->save();
                $this->redirect('index');
            }
        }
        $this->renderPartial("login",array('manager'=>$manager));
    }

}
