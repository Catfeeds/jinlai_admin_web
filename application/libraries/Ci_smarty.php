<?php 
defined('BASEPATH') OR exit('此文件不可被直接访问');

require(APPPATH.'libraries/smarty-3.1.32/libs/Smarty.class.php');

class Ci_smarty extends Smarty {
    protected $ci;
    public function __construct()
    {

        $this->ci = & get_instance();
        $this->ci->load->config('smarty');//加载smarty的配置文件
        parent::__construct();
        $this->cache_lifetime =$this->ci->config->item('cache_lifetime');
        $this->caching = $this->ci->config->item('caching');
        $this->config_dir = $this->ci->config->item('config_dir');
        $this->template_dir = $this->ci->config->item('template_dir');
        $this->compile_dir = $this->ci->config->item('compile_dir');
        $this->cache_dir = $this->ci->config->item('cache_dir');
        $this->use_sub_dirs = $this->ci->config->item('use_sub_dirs');
        $this->left_delimiter = $this->ci->config->item('left_delimiter');
        $this->right_delimiter = $this->ci->config->item('right_delimiter');
    }
}