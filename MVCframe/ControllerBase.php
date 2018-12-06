<?php 
require_once(dirname(__FILE__)."/Request.php");
require_once(dirname(__FILE__)."/Smarty/Smarty.class.php");
class ControllerBase{
    protected $systemRoot;
    protected $controller ='Main';
    protected $action = 'Main';
    protected $view;
    protected $request;
    protected $templatePath;
    //コンストラクタ
    public function __construct(){
        $this->request = new Request();
    }
    //
    public function setSystemRoot($path){
        $this->systemRoot = $path;
    }
    //
    public function setControllerAction($controller,$action){
        $this->controller = $controller;
        $this->action = $action;
    }
    //
    public function run(){
        try{
            //
            $this->initializeView();
            //
            $this->preAction();
            //
            $methodName = sprintf('%sAction', $this->action);
            $this->$methodName();
            //
            $this->view->display($this->templatePath);
        }catch(Exception $e){
            //
        }
    }
    //
    protected function initializeView(){
        $this->view = new Smarty();
        $this->view->template_dir = sprintf('%s/%s/view/templates/', $this->systemRoot,$this->controller);
        $this->view->compile_dir = sprintf('%s/%s/view/templates_c/', $this->systemRoot,$this->controller);
        
        $this->templatePath = sprintf('%s.tpl', $this->action);
    }
    // 共通前処理（オーバーライド前提）
    protected function preAction(){
    }
}
?>
