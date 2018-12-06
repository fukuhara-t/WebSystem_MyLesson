<?php
require_once(dirname(__FILE__)."/../../../../MVCframe/ControllerBase.php");
class BookTable extends Modelbase {
    protected $tableName = 'book_m';
    public function getAllRec(){
        $rows = $this->qy_select();
        return $rows;
    }
    public function getByIdRec($id){
        $params = array('book_id' => $id);
        $rows = $this->qy_select('book_id',$params);
        return $rows;
    }
    public function getWriterIdRec($id){
        $sql = sprintf('SELECT writer_id FROM %s where book_id = :book_id', $this->tableName);
        $params = array('book_id' => $id);
        $rows = $this->query($sql, $params);
        return $rows;
    }
    public function getUpdateByIdRec($id,$name,$phonetic_name,$writer_id,$publication_date){
        $params = array('name'=>$name,
                        'phonetic_name'=>$phonetic_name,
                        'writer_id'=>$writer_id,
                        'publication_date'=>$publication_date,
                    );
        $sql=sprintf('UPDATE book_m SET book_name=:name ,book_phonetic_name=:phonetic_name,writer_id=:writer_id,publication_date=:publication_date WHERE book_id=%s;',$id);
        $rows = $this->query($sql,$params);
        return $rows;
    }
    public function deleteRec($id){
        try{
            //例外処理を投げる（スロー）ようにする
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //トランザクション開始
            $this->db->beginTransaction();
            echo "<pre>";
            var_dump( $id);
            echo "</pre>";
            $num=$id;
            $sql = sprintf(
                "UPDATE %s SET book_name='NO_DATA',book_phonetic_name=NULL,writer_id=NULL,publication_date=NULL WHERE book_id = %d", 
                $this->tableName,
                $num,
            );
            
            echo "<pre>";
            var_dump( $sql);
            echo "</pre>";
            $stmt = $this->db->prepare($sql);
            $res  = $stmt->execute();
            // トランザクション完了（コミット）
            $this->db->commit();
            return true;
        
        }catch (PDOException $e){
            //トランザクション取り消し（ロールバック）
            $this->db->rollBack();
            print('Error:'.$e->getMessage());
            die();
            return false;
        }	
    }
    public function insertRec($name,$phonetic_name,$writer_id,$publication_date){
        try{
            $data = array('book_name'=>$name,
                        'book_phonetic_name'=>$phonetic_name,
                        'writer_id'=>$writer_id,
                        'publication_date'=>$publication_date,
                    );
            //例外処理を投げる（スロー）ようにする
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //トランザクション開始
            $this->db->beginTransaction();
    
            //指定カラムの一時格納
            $fields = array();
            $values = array();
            foreach ($data as $key => $val) {
                $fields[] = $key;
                $values[] = ':' . $key;
            }
            //空いているレコードを探す
            $sql = sprintf(
                "SELECT * FROM %s WHERE book_name = 'NO_DATA' ORDER BY book_id ASC LIMIT 1;", 
                $this->tableName
            );
            $stmt = $this->db->prepare($sql);
            $res  = $stmt->execute();
            $rows = $stmt->fetchAll();
            $num=null;
            //if()
            //$num=$rows[0]["book_id"];
            
            if($res == false || $rows==null){
                $num=null;
                //最大数取得
                $sql = sprintf(
                    "SELECT COUNT(*) FROM %s", 
                    $this->tableName
                );
                $stmt = $this->db->prepare($sql);
                $res  = $stmt->execute();
                $rows = $stmt->fetchAll();
                $num=$rows[0]["COUNT(*)"];
                $sql = sprintf(
                    "INSERT INTO %s (book_id,%s) VALUES (%d,%s)", 
                    $this->tableName,
                    implode(',', $fields),
                    $num,
                    implode(',', $values)
                );
                echo "<pre>";
                var_dump( $sql);
                echo "</pre>";
                $stmt = $this->db->prepare($sql);
                foreach ($data as $key => $val) {
                    $stmt->bindValue(':' . $key, $val);
                }
                $res  = $stmt->execute();
                $this->db->commit();
                return true;
            }
            $num=$rows[0]["book_id"];
            $sql = sprintf(
                "UPDATE %s SET book_name=:book_name,book_phonetic_name=:book_phonetic_name,writer_id=:writer_id,publication_date=:publication_date WHERE book_id = %d", 
                $this->tableName,
                $num,
            );
            
            echo "<pre>";
            var_dump( $sql);
            echo "</pre>";
            $stmt = $this->db->prepare($sql);
            foreach ($data as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
            echo "<pre>";
            var_dump( $sql);
            echo "</pre>";
            $res  = $stmt->execute();
            
            // トランザクション完了（コミット）
            $this->db->commit();
            return true;
        
        }catch (PDOException $e){
            //トランザクション取り消し（ロールバック）
            $this->db->rollBack();
            print('Error:'.$e->getMessage());
            die();
            return false;
        }	
    }
}
?>