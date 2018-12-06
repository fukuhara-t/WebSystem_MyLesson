<?php
require_once(dirname(__FILE__)."/../../../../MVCframe/ControllerBase.php");
require_once(dirname(__FILE__)."/../../commons/table/Writerindextable.php");
class WriterinfoController extends ControllerBase{
    //baseのrunないで呼ばれるアクションを記載していく
    public function WriterinfoAction(){
        $Writer_table= new Writerindextable();
        $id = 1;

        if (null != $this->request->getParam('writer_id')) {
            $id = $this->request->getParam('writer_id');
        }
        $Writer = $Writer_table->getByIdRec($id);
         $this->view->assign('writers', $Writer);
        
    }
}
?>