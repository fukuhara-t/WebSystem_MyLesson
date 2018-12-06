<?php
require_once(dirname(__FILE__)."/../MVCframe/ModelBase.php");
require_once(dirname(__FILE__)."/../MVCframe/Dispatcher.php");
require_once(dirname(__FILE__)."/../MVCframe/setting/localinfo.php");
// DB接続情報設定
$Info = LocalInfoDatas::getInstance();
ModelBase::setConnectionInfo($Info->getDbInfo());

$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot('../test/module');
$dispatcher->dispatch();

?>
