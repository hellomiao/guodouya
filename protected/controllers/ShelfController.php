<?php

class ShelfController extends CController {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
            array('allow', // allow all users to access 'index' and 'view' actions.
                'actions' => array(),
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
        if (isset($_GET['route'])) {
            $route = $_GET['route'];
            $shelf = Shelf::model()->find("Route=:route", array("route" => $route));
            $uid = $shelf->Uid;
            $user = User::model()->findByPk($uid);
        } else {
            $this->pageTitle = "我的花架";
            $uid = Yii::app()->user->id;
            $user = User::model()->findByPk($uid);
            $shelf = Shelf::model()->find("Uid=:uid", array("uid" => $uid));
        }
        $bookCount = ShelfGuestbook::model()->count("Sid=:sid",array("sid"=>$shelf->ID));
        $bigPicture = User::model()->getPicture($uid, "big");
        $params = array(
            "picture" => $bigPicture,
            "shelf" => $shelf,
            "user" => $user,
            'bookCount'=>$bookCount,
        );
        $this->render("index", $params);
    }

    public function actionCreate() {
        $this->pageTitle = "创建花架";
        $shelfMe = Shelf::model()->exists("Uid=:uid", array("uid" => Yii::app()->user->id));
        if ($shelfMe) {
            $this->redirect("index");
        }
        $this->render("create");
    }

    public function actionAjaxCreate() {
        $shelf = new Shelf('create');
        $shelf->Name = $_POST['name'];
        $shelf->Route = $_POST['route'];
        $shelf->Info = $_POST['info'];
        $shelf->Uid = Yii::app()->user->id;
        if ($shelf->validate() && $shelf->save()) {
            echo 'ok';
        }
    }

    public function actionAjaxAddGuestBook() {
        $guestBook = new ShelfGuestbook();
        $guestBook->Sid = $_POST['sid'];
        $guestBook->UserId = Yii::app()->user->id;
        $guestBook->Pid = $_POST['pid'];
        $guestBook->Content = $_POST['content'];
        if ($guestBook->validate() && $guestBook->save()) {
            echo $guestBook->ID;
        }
    }

    public function actionAjaxGuestBookList() {
        $type=isset($_GET['type'])?$_GET['type']:"more";
        $criteria = new CDbCriteria();
        $criteria->order = "CreateTime desc";
        $count = ShelfGuestbook::model()->count($criteria);
        $pages = new CPagination($count);
        if($type=='one'){
            $pages->pageSize = 1;
        }else{
            $pages->pageSize = 3; 
        }
        $pages->applyLimit($criteria);
        $models = ShelfGuestbook::model()->findAll($criteria);
        $this->renderPartial("ajaxGuestBookList",array("models"=>$models,"pages"=>$pages,"type"=>$type));
    }

}