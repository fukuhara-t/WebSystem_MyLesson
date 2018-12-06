<?php
require_once(dirname(__FILE__)."/../../../../MVCframe/ControllerBase.php");
require_once(dirname(__FILE__)."/../../commons/table/Writerindextable.php");
class WriterupdateController extends ControllerBase{
    //baseのrunないで呼ばれるアクションを記載していく
    public function WriterupdateAction(){
        $table= new Writerindextable();
        $id = 0;

        if (null != $this->request->getParam('writer_id')) {
            $id = $this->request->getParam('writer_id');
        }
        $Writers = $table->getByIdRec($id);
        $this->view->assign('writers', $Writers);
    }
    public function WriterchangeAction(){
        $table= new Writerindextable();
        $name=$phonetic_name;
        $id=0;
        if (null != $this->request->getParam('writer_id')) {
            $id = $this->request->getParam('writer_id');
        }
        $page=sprintf('Location: /Main.php/Writerupdate/writer_id=%s/',$id);
        $name=$this->request->getPost('name');
        $phonetic_name=$this->request->getPost('phonetic_name');
        if( $name==null||$phonetic_name==null){
            $page=sprintf('Location: /Main.php/Writerupdate/writer_id=%s/',$id);
        }
    
        $Writer = $table->getUpdateByIdRec($id,$name,$phonetic_name);
        header($page);
        exit();
    }
    
}
?>