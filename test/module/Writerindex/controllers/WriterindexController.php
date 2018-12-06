<?php
require_once(dirname(__FILE__)."/../../../../MVCframe/ControllerBase.php");
require_once(dirname(__FILE__)."/../../commons/table/Writerindextable.php");
class WriterindexController extends ControllerBase{
    //baseのrunないで呼ばれるアクションを記載していく
    public function WriterindexAction(){
        $table = new WriterindexTable();
        $info = $table->getAllRec();
        $this->view->assign('writers', $info);
    }
    public function WriterinsertAction(){
        $table = new WriterindexTable();
        $page='Location: /Main.php/Writerindex';
        $name=$phonetic_name=null;
        $name=$this->request->getPost('name');
        $phonetic_name=$this->request->getPost('phonetic_name');
        if( $name==null||$phonetic_name==null){
            header($page);
        }
        $res = $table->insertRec($name,$phonetic_name);
        header($page);
        
    }
    public function WriterdeleteAction(){
        $table = new WriterindexTable();
        if (null != $this->request->getParam('writer_id')) {
            $id = $this->request->getParam('writer_id');
        }
        $res = $table->deleteRec($id);
        $page='Location: /Main.php/Writerindex';
        header($page);
    }
}
?>