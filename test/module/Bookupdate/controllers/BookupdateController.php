<?php
require_once(dirname(__FILE__)."/../../../../MVCframe/ControllerBase.php");
require_once(dirname(__FILE__)."/../../commons/table/BookTable.php");
require_once(dirname(__FILE__)."/../../commons/table/Writerindextable.php");
class BookupdateController extends ControllerBase{
    //baseのrunないで呼ばれるアクションを記載していく
    public function BookupdateAction(){
        //テーブルの作成
        $Book_table = new BookTable();
        $Writer_table= new WriterindexTable();
        $id = 0;

        if (null != $this->request->getParam('book_id')) {
            $id = $this->request->getParam('book_id');
        }

        $Books = $Book_table->getByIdRec($id);
        $Writer = $Writer_table->getByIdRec($Books[0]['writer_id']);
        $Writers = $Writer_table->getAllRec();

        $this->view->assign('books', $Books);
        $this->view->assign('writer', $Writer);
        $this->view->assign('writers', $Writers);
        
    }
    public function BookchangeAction(){
        $Book_table = new BookTable();
        $name=$phonetic_name=$writer_id=$publication_date=null;
        $id=0;
        if (null != $this->request->getParam('book_id')) {
            $id = $this->request->getParam('book_id');
        }
        $page=sprintf('Location: /Main.php/Bookupdate/book_id=%s/',$id);
        $name=$this->request->getPost('name');
        $phonetic_name=$this->request->getPost('phonetic_name');
        $writer_id=$this->request->getPost('writer_id');
        $publication_date=$this->request->getPost('publication_date');
        if( $name==null||$phonetic_name==null||$writer_id==null||$publication_date==null){
            $page=sprintf('Location: /Main.php/Bookupdate/book_id=%s/',$id);
        }
    
        $Books = $Book_table->getUpdateByIdRec($id,$name,$phonetic_name,$writer_id,$publication_date);
       
        header($page);
        exit();
        
    }
    
}
?>