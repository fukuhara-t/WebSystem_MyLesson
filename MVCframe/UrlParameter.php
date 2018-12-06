<?php
require_once(dirname(__FILE__)."/RequestVariables.php");
class UrlParameter extends RequestVariables
{
    protected function setValues()
    {
        // パラメーター取得（末尾の / は削除）
        $param=$_SERVER["REQUEST_URI"];
        $params = array();
        if ('' != $param) {
            // パラメーターを / で分割
            $params = explode('/', $param);
        }
        // 3番目以降のパラメーターを順に_valuesに格納
        $i = 0;
        if (count($params) >= 4) {
            foreach ($params as $param) { 
                // "="で分割
                $splited = explode('=', $param);
                if (2 == count($splited)) {
                    $key = $splited[0];
                    $val = $splited[1];
                    $this->_values[$key] = $val;
                }
            }
        }
    }
}
?>