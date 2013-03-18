<?php

class IndexController extends CController{
    public function actionIndex(){
        echo 1;
    }
    
    public function actionLogin()
    {
        $this->renderPartial("login");
    }
}
