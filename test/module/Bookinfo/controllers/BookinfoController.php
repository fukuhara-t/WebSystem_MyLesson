<?php
require_once(dirname(__FILE__)."/../../../../MVCframe/ControllerBase.php");
require_once(dirname(__FILE__)."/../../commons/table/BookTable.php");
require_once(dirname(__FILE__)."/../../commons/table/Writerindextable.php");
class BookinfoController extends ControllerBase{
    //baseのrunないで呼ばれるアクションを記載していく
    public function BookinfoAction(){
        $Book_table = new BookTable();
        $Writer_table= new WriterindexTable();
        $id = 1;

        if (null != $this->request->getParam('book_id')) {
            $id = $this->request->getParam('book_id');
        }

        $Books = $Book_table->getByIdRec($id);
        $WriterId = $Book_table->getWriterIdRec($id);
        $this->view->assign('books', $Books);
        if($WriterId != null ){
            $Writers = $Writer_table->getByIdRec($WriterId[0]['writer_id']);
            $this->view->assign('writers', $Writers);
        }
    }
}
?>