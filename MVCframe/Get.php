<?php
require_once(dirname(__FILE__)."/RequestVariables.php");
// GET変数クラス
class Get extends RequestVariables
{
    protected function setValues()
    {
        //連想配列のループを行う
        foreach ($_GET as $key => $value) {
            $this->_values[$key] = $value;
        }		
    }		
}

?>
