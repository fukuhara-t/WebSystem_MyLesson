 <?PHP
 require_once(dirname(__FILE__)."/Dispatcher.php");
class ModelBase{
    //dbの接続設定
    private static $connectInfo;
    protected $db;
    protected $tableName;
    //コンストラクタ
    public function __construct(){
        $this->initDb();
    }
    //初期化
    public function initDb(){
        //DBに接続
        try
        {
            $this->db = new PDO('mysql:host=localhost;dbname=web_sample;charset=utf8','root','');
        } catch (PDOException $e) {
            print "エラー!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    //DB接続設定情報取得
    public static function setConnectionInfo($connInfo){
        self::$connectInfo = $connInfo;
    }

    //基本的なクリエを発行処理
    //sql直書き
    public function query($sql,array $params = array()){
        $stmt = $this->db->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        $rows = $stmt->fetchAll();

        return $rows;
    }
    //SELECT
    //@$where   カラム名
    //@$params  連想配列
    public function qy_select($where = "" ,array $params = array()){
        $sql = sprintf("SELECT * FROM %s", $this->tableName);
        if ($where != "") {
            $sql .= " where ". $where;
            $sql .= " = :". $where;
        }
        $stmt = $this->db->prepare($sql);
        if ($params != null) {
            
            foreach ($params as $key => $val) {
             $stmt->bindValue((':'.$key), $val , PDO::PARAM_INT );
            }
        }
        
        $res = $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    //DELETE
    //@$where   カラム名
    //@$params  連想配列
    public function qy_delete($where = "",$params = null){
        $sql = sprintf("DELETE FROM %s", $this->tableName);
        if ($where != "") {
            $sql .= " WHERE :" . $where;
        }
        $stmt = $this->db->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $res = $stmt->execute();
        
        return $res;
    }
}
?>