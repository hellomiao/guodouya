<?php
class PlantController extends Controller{
    public function actionIndex(){
        $this->render('index');
    }
    public function actionAdd(){
        if(isset($_POST['addForm'])){
            $plant=new Wiki();
            $plant->attributes=$_POST['addForm'];
            $plant->UserId=1;
            if($plant->validate()){
                if($plant->save()){
                    $pid=Yii::app()->getLastInsertId;
                    $this->redirect($this->createUrl("Plant/item/id/".$pid));
                }
            } 
        }
        $this->render('add');
    }
    
    public function actionItem(){
        if(isset($_GET['id'])){
            $id=(int)$_GET['id'];
            $info=Wiki::model()->findByPk($id);
            $pic=WikiImgs::model()->getPicByWid($id);
        }
    }
    
    
    
}
?>
