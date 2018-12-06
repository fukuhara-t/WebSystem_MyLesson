<?php
class LocalInfoDatas{
    private static $Instance;
    private static $connInfo;

    private function _construct(){
        $connInfo = array(
            'host'     => 'localhost',
            'dbname'   => 'web_sample',
            'dbuser'   => 'test_user',
            'password' => 'test_user'
        );
        echo "<pre>";
        var_dump($connInfo);
        echo "</pre>";
    }
    public function getDbInfo(){
        return self::$connInfo;
    }
    public static function getInstance(){
        if(!isset(self::$Instance)){
            self::$Instance = new LocalInfoDatas();
        }
        return self::$Instance;
    }
    
}
?>