<?php
require_once(dirname(__FILE__)."/RequestVariables.php");
// POST変数クラス
class Post extends RequestVariables
{
    protected function setValues()
    {
        //連想配列のループを行う
        foreach ($_POST as $key => $value) {
            //リクエストに関してのエスケープ処理を追加する
            $this->_values[$key] = $value;
        }		
    }		
}
?>
