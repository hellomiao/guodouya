<?php
class PlantController extends Controller{
    /*
     * 百科首页
     */
    public function actionIndex(){
        $this->render('index');
    }
    /*
     * 添加百科
     */
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
    /*
     * 百科单页
     */
    public function actionItem(){
        if(isset($_GET['id'])){
            $id=(int)$_GET['id'];
            $info=Wiki::model()->findByPk($id);
            $pic=WikiImgs::model()->getPicByWid($id);
            print_r($pic);
            exit;
            $this->render('item');
        }
    }
    
    
    
}
?>
