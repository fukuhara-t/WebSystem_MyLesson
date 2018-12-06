<?php
require_once(dirname(__FILE__)."/../../../../MVCframe/ControllerBase.php");
class WriterindexTable extends Modelbase {
    protected $tableName = 'writer_m';
    public function getAllRec(){
        $rows = $this->qy_select();
        return $rows;
    }
    public function getByIdRec($id){
        $params = array('writer_id' => $id);
        $rows = $this->qy_select('writer_id',$params);
        return $rows;
    }
    public function getUpdateByIdRec($id,$name,$phonetic_name){
        $params = array('name'=>$name,
                        'phonetic_name'=>$phonetic_name,
                    );
        $sql=sprintf('UPDATE writer_m SET writer_name=:name, writer_phonetic_name=:phonetic_name WHERE writer_id=%s;',$id);
        $rows = $this->query($sql,$params);
        return $rows;
    }
    public function deleteRec($id){
        try{
            //例外処理を投げる（スロー）ようにする
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //トランザクション開始
            $this->db->beginTransaction();
            //ここでエスケープ処理いるかも
            $num=$id;
            $sql = sprintf(
                "UPDATE %s SET writer_name='NO_DATA',writer_phonetic_name=NULL WHERE writer_id = %d", 
                $this->tableName,
                $num,
            );
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

    public function insertRec($name,$phonetic_name){
        try{
            $data = array('writer_name'=>$name,
                        'writer_phonetic_name'=>$phonetic_name,
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
                "SELECT * FROM %s WHERE writer_name = 'NO_DATA' ORDER BY writer_id ASC LIMIT 1;", 
                $this->tableName
            );
            $stmt = $this->db->prepare($sql);
            $res  = $stmt->execute();
            $rows = $stmt->fetchAll();
            $num=null;
             
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
                    "INSERT INTO %s (writer_id,%s) VALUES (%d,%s)", 
                    $this->tableName,
                    implode(',', $fields),
                    $num,
                    implode(',', $values)
                );
                $stmt = $this->db->prepare($sql);
                foreach ($data as $key => $val) {
                    $stmt->bindValue(':' . $key, $val);
                }
                $res  = $stmt->execute();
                $this->db->commit();
                return true;
            }
            $num=$rows[0]["writer_id"];
            $sql = sprintf(
                "UPDATE %s SET writer_name=:writer_name,writer_phonetic_name=:writer_phonetic_name WHERE writer_id = %d", 
                $this->tableName,
                $num,
            );
            
            $stmt = $this->db->prepare($sql);
            foreach ($data as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
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