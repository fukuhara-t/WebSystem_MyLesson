<?php
require_once(dirname(__FILE__)."/Post.php");
require_once(dirname(__FILE__)."/Get.php");
require_once(dirname(__FILE__)."/UrlParameter.php");
//POSTとGETの処理をまとめたクラス
class Request
{
    // POSTパラメータ
    private $post;
    // GETパラメータ
    private $query;
    // URLパラメータ
    private $url_param;

    // コンストラクタ@
    public function __construct(){
        $this->post = new Post();
        $this->query = new Get();
        $this->url_param = new UrlParameter();
    }

    // POST変数取得
    public function getPost($key = null){
        if (null == $key) {
            return $this->post->get();
        }
        if (false == $this->post->has($key)) {
            return null;
        }
        return $this->post->get($key);
    }

    // GET変数取得
    public function getQuery($key = null){
        if (null == $key) {
            return $this->query->get();
        }
        if (false == $this->query->has($key)) {
            return null;
        }
        return $this->query->get($key);
    }

    // URLパラメーター取得
    public function getParam($key = null)
    {
        if (null == $key) {
            return $this->url_param->get();
        }
        if (false == $this->url_param->has($key)) {
            return null;
        }
        return $this->url_param->get($key);
    }
}


?>
