<?php
require_once(dirname(__FILE__)."/../../../../MVCframe/ControllerBase.php");
require_once(dirname(__FILE__)."/../../commons/table/BookTable.php");
require_once(dirname(__FILE__)."/../../commons/table/Writerindextable.php");
//require_once 'C:/websample/MVCframe/ControllerBase.php';
//require_once 'C:/websample/test/module/commons/table/BookTable.php';
//require_once 'C:/websample/test/module/commons/table/Writerindextable.php';
class BookindexController extends ControllerBase{
    //baseのrunないで呼ばれるアクションを記載していく
    public function BookindexAction(){
        $Book_table = new BookTable();
        $Writer_table= new WriterindexTable();

        $Books = $Book_table->getAllRec();
        $Writers = $Writer_table->getAllRec();
        
        $this->view->assign('books', $Books);
        $this->view->assign('writers', $Writers);
    }
    public function BookinsertAction(){
        $Book_table = new BookTable();
        $page='Location: /Main.php/Bookindex';
        $name=$phonetic_name=$writer_id=$publication_date=null;
        $name=$this->request->getPost('name');
        $phonetic_name=$this->request->getPost('phonetic_name');
        $writer_id=$this->request->getPost('writer_id');
        $publication_date=$this->request->getPost('publication_date');
        echo "<pre>";
        var_dump( $name);
        var_dump( $phonetic_name);
        echo "</pre>";
        if( $name==null||$phonetic_name==null||$writer_id==null||$publication_date==null){
            header($page);
        }
        $res = $Book_table->insertRec($name,$phonetic_name,$writer_id,$publication_date);
        header($page);
        
    }
    public function BookdeleteAction(){
        $Book_table = new BookTable();
        if (null != $this->request->getParam('book_id')) {
            $id = $this->request->getParam('book_id');
        }
        echo "<pre>";
        var_dump( $id);
        echo "</pre>";
        $res = $Book_table->deleteRec($id);
        $page='Location: /Main.php/Bookindex';
        header($page);
    }
}
?>