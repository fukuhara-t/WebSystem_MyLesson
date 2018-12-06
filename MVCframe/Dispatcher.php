<?php
class Dispatcher{
    
    private $sysRoot;
    
    //
    public function setSystemRoot($path){
        $this->sysRoot = rtrim($path,'/');
    }
    //
    public function dispatch(){
        //パラメータの取得
        $param=$_SERVER["REQUEST_URI"];
        
        //パラメータを/で分割する
        $params=array();
        if($param != ''){
            $params = explode('/',$param);
        }
        
        //パラメータからコントローラとして取得
        $controller ="Main";
        if (count($params) >= 3){
            $controller = $params[2];
            //空欄の時
            if($controller == ''){
                $controller ="Main";
            }
        }
        
        //1文字目を大文字にしてコントローラーの名前作成
        $com_controller=ucfirst(strtolower($controller));
        $className =$com_controller.'Controller';
        
        $controllerFileName = sprintf('%s/%s/controllers/%s.php', $this->sysRoot,$com_controller,$className);
        
        //存在チェック
        if (false == file_exists($controllerFileName)) {
            //echo "<pre>";
            //var_dump( $className);
            //echo "</pre>";
            header("HTTP/1.0 404 Not Found");
            return null;
        }
        //ファイル読み込み
        require_once $controllerFileName;
        // クラスが定義されているかチェック
        if (false == class_exists($className)) {
            return null;
        }
        //クラスインスタンス生成
        $controllerInstarnce = new $className();
        //インスタンス生成
        
        $controllerInstance = new $className();
        if (null == $controllerInstance) {
            header("HTTP/1.0 404 Not Found");
            exit;
        }
        //2番目のパラメーターをアクションとして取得
        $action= "Main";
        if (count($params) >= 3 ) {
            if ( $params[2] !='') {
                $action = $params[2];
            }
        }
        if (count($params) >= 4 ){
            $splited = explode('=', $params[3]);
            if ( $params[3] !='' && 2 != count($splited)) {
                $action = $params[3];
            }
        }
        //アクションメソッドの存在確認
        if (false == method_exists($controllerInstance, ucfirst(strtolower($action)).'Action')) {
            //header("HTTP/1.0 404 Not Found");
            exit;
        }
        //コントローラー初期設定
        $controllerInstance->setSystemRoot($this->sysRoot);
        $controllerInstance->setControllerAction($com_controller, ucfirst(strtolower($action)));
        //処理実行
        $controllerInstance->run();
    }

}
?>