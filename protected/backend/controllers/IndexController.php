<?php

class IndexController extends CController {
    
        public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to access 'index' and 'view' actions.
                'actions' => array('login'),
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
