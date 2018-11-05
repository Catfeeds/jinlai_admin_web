<?php
defined('BASEPATH') OR exit('此文件不可被直接访问');
require_once './sdk/php-sdk-upyun/vendor/autoload.php'; // 针对压缩包安装
use Upyun\Upyun;
use Upyun\Config;
class PageHome extends MY_Controller {
    public function index() {
        //           $redis = new Redis();
        // $redis->connect('47.100.19.150',6379);
        // print_r(unserialize($redis->get('homepage')));exit;
        // $redis = new Redis();
        // $redis->connect('47.100.19.150',6379);
        // $redis->set('test','hello redis');
        // echo $redis->get('test');
        // $serviceConfig = new Config('medias-jinlai.b0.aicdn.com', 'jinlaisandbox', 'jinlaisandbox');
        // $client = new Upyun($serviceConfig);
        // print_r($client);exit;
        // $client = new Upyun($bucketConfig);
        //      $test='123213213213123配置成功';
        //          $query = $this->db
        //    ->from('adp')
        //    ->get()->result_array();
        // $this->assign('data',$query);
        // if(!empty($_FILES['xmldata']['tmp_name'])){//判断上传内容是否为空
        //      $name = $_FILES['xmldata']['tmp_name'];
        // }
        //   $xml = simplexml_load_file($name);
        //   print_r(object_to_array($xml->broadcastlist));exit;
        $this->assign('pageTitle', '主页');
        $this->display('backend/PageHome_doXml.html');
    }
    public function updateredis() {
        if (IS_POST) {
            if (!empty($_FILES['homexml']['tmp_name'])) { //判断上传内容是否为空
                $name = $_FILES['homexml']['tmp_name'];
                $xml = simplexml_load_file($name);
                $xmldata = object_to_array($xml);
            } else {
                $data['uerror'] = '上传文件为空！';
                $this->assign('pageTitle', '主页');
                $this->display('backend/PageHome_doXml.html');
                exit;
            }
        }
        // print_r(unserialize(serialize(object_to_array($xml))) );exit;
        $redis = new Redis();
        $redis->connect('47.100.19.150', 6379);
        $redis->set('homepage', serialize($xmldata));
        $this->assign('pageTitle', '主页');
        $this->display('backend/PageHome_doXml.html');
    }
    public function xmltest() {
        $name = './temp/baby.xml';
        $xml = simplexml_load_file($name);
        $xmldata = object_to_array($xml);
        $data['xmldata'] = $xmldata;
        $this->assign('pageTitle', '主页');
         $this->load->view('templates_client/header', $data);
         $this->load->view('templates_client/tabclass', $data);
         $this->load->view('templates_client/footer', $data);
    
    }
    /**
     * [homeindex description]
     * @return [type] [description]
     */
    public function homeindex() {
        $error = '';
        if (IS_POST) {
            // 页面信息
            $data = array(
                'title' => NULL, // 直接使用默认标题
                'class' => $this->class_name, // 页面body标签的class属性值
                
            );
            // 获取商家列表
            $data['bizs'] = $this->list_biz();
            //读取xml文件
            if (!empty($_FILES['xmldata']['tmp_name'])) { //判断上传内容是否为空
                $name = $_FILES['xmldata']['tmp_name'];
                $xml = simplexml_load_file($name);
                $xmldata = object_to_array($xml);
                //轮播图数据
                $data['broadcastlist'] = $xmldata['broadcastlist']['broadcast'];
                //第一部分
                $data['part0'] = $xmldata['partlist']['part'][0];
                $data['part1'] = $xmldata['partlist']['part'][1];
                $data['part2'] = $xmldata['partlist']['part'][2];
                $data['part3'] = $xmldata['partlist']['part'][3];
                $data['part4'] = $xmldata['partlist']['part'][4];
                $data['part5'] = $xmldata['partlist']['part'][5];
                $data['part6'] = $xmldata['partlist']['part'][6];
                $data['part7'] = $xmldata['partlist']['part'][7];
                $data['part8'] = $xmldata['partlist']['part'][8];
            } else {
                $data['error'] = '上传文件为空！';
                $this->assign('pageTitle', '主页');
                $this->display('backend/PageHome_doXml.html');
                exit;
            }
            // print_r($data['part0']['businesslist']['business']['openlist']['open']);exit;
            //print_r(object_to_array($xml->broadcastlist));exit;
            // 载入视图
            $this->assign('pageTitle', '主页');
            $this->load->view('newtemplates/header', $data);
            $this->load->view('newhome', $data);
            $this->load->view('newtemplates/nav-main', $data);
            $this->load->view('newtemplates/footer', $data);
        }
    }
    public function RollList() {
        $query = $this->db->from('adp')->get()->result_array();
        $this->assign('data', $query);
        $this->display('backend/PageHome_rollList.html');
        //echo $this->session->user_id;exit;
        
    }
    public function RollCreate() {
        if (IS_POST) {
            $data = $this->input->post();
            $serviceConfig = new Config('jinlaisandbox-images', 'jinlaisandbox', 'jinlaisandbox');
            $client = new Upyun($serviceConfig);
            if (!empty($_FILES['img']['tmp_name'])) { //判断上传内容是否为空
                $name = $_FILES['img']['tmp_name'];
                print_r($name);
            }
            $file = fopen($name, 'r');
            $client->write('/jinlaisandbox-images/user/avatar/201807/0718/172856201_test.jpg', $file, array(
                'x-gmkerl-thumb' => '/format/jpg'
            ));
            exit;
            // 待验证的表单项
            $this->form_validation->set_error_delimiters('', '；');
            // 验证规则 https://www.codeigniter.com/user_guide/libraries/form_validation.html#rule-reference
            $this->form_validation->set_rules('title', '标题', 'trim|required|max_length[200]');
            $this->form_validation->set_rules('pid', '产品ID', 'trim|required|max_length[11]');
            if ($this->form_validation->run()) {
                if ($data['type'] === '1') {
                    //判断商品id是否存在
                    $ishave = $this->db->select('item_id')->from('item')->where("item_id", $data['pid'])->get()->row_array();
                } else {
                    //判断商家id是否存在
                    $ishave = $this->db->select('biz_id')->from('biz')->where("biz_id", $data['pid'])->get()->row_array();
                }
                if ($ishave) {
                    $data['userid'] = $this->session->user_id;
                    $data['dateline'] = time();
                    $this->db->insert('rollimg', $data);
                    redirect(base_url('backend/PageHome/RollList'));
                } else {
                    $error = '产品ID不存在！';
                    $this->assign('error', $error);
                }
            } else {
                $data['error'] = validation_errors();
                $this->assign('error', $data['error']);
            }
        }
        $this->assign('pageTitle', '轮播图-新建');
        $this->display('backend/PageHome_rollCreate.html');
        //echo $this->session->user_id;exit;
        
    }
    public function uploadimglist() {
        // $this->db->from('upimginfo');
        // $data = $this->db->get()->result_array();
        // $this->db->from('upimginfo');
        // $data = $this->db->get()->result_array();
        $sqlwhere = ' 1=1 ';
        $search = $this->input->post();  
        if(isset($search['search']))
        {
            $sqlwhere = " title like '%".$search['search']."%'"; 
        }
        $data = $this->db->from('upimginfo')->where($sqlwhere)->order_by('id', 'desc')->limit(30)->get()->result_array();
        $this->assign('info', $data);
        $this->display('backend/PageHome_uploadimglist.html');

    }
    public function uploadimg() {
        if (IS_POST) {
            $data = $this->input->post();
            $serviceConfig = new Config('jinlaisandbox-images', 'jinlaisandbox', 'jinlaisandbox');
            $client = new Upyun($serviceConfig);
            //https://medias.517ybang.com/item/url_image_main/201807/0713/104740.jpg
            if (!empty($_FILES['img']['tmp_name'])) { //判断上传内容是否为空
                $name = $_FILES['img']['tmp_name'];
                $file = fopen($name, 'r');
                $url = '/item/homepage_img_url/';
                $url.= date("Ym") . '/';
                $url.= date("md") . '/';
                $url.= 'pageimg' . time() . '.jpg';
                $client->write($url, $file, array(
                    'x-gmkerl-thumb' => '/format/jpg'
                ));
                $data['userid'] = $this->session->user_id;
                $data['dateline'] = time();
                $data['img'] = 'https://medias.517ybang.com' . $url;
                $this->db->insert('upimginfo', $data);
                redirect(base_url('backend/PageHome/uploadimglist'));
            }
        }
        $this->assign('pageTitle', '主页');
        $this->display('backend/PageHome_uploadcreate.html');
    }
    /**
     * [homeindex description]
     * @return [type] [description]
     */
    public function save() {
        if (IS_POST) {
            // 页面信息
            $data = array(
                'title' => NULL, // 直接使用默认标题
                'class' => $this->class_name, // 页面body标签的class属性值
                
            );
            // 获取商家列表
            $data['bizs'] = $this->list_biz();
            //读取xml文件
            if (!empty($_FILES['xmldata']['tmp_name'])) { //判断上传内容是否为空
                $name = $_FILES['xmldata']['tmp_name'];
            }
            $xml = simplexml_load_file($name);
            //轮播图数据
            $data['broadcastlist'] = object_to_array($xml->broadcastlist) ['broadcast'];
            //第一部分
            $data['part0'] = object_to_array($xml->partlist) ['part'][0];
            $data['part1'] = object_to_array($xml->partlist) ['part'][1];
            $data['part2'] = object_to_array($xml->partlist) ['part'][2];
            $data['part3'] = object_to_array($xml->partlist) ['part'][3];
            $data['part4'] = object_to_array($xml->partlist) ['part'][4];
            $data['part5'] = object_to_array($xml->partlist) ['part'][5];
            $data['part6'] = object_to_array($xml->partlist) ['part'][6];
            $data['part7'] = object_to_array($xml->partlist) ['part'][7];
            $data['part8'] = object_to_array($xml->partlist) ['part'][8];
            // 载入视图
            $this->load->view('newhome', $data);
        }
    }
    /**
     * 预览分类页
     */
    public function detail() {
        $data = [];
      if(IS_POST){
         $data = $this->input->post();
         if (!empty($_FILES['classpagexml']['tmp_name'])) { //判断上传内容是否为空
                $name = $_FILES['classpagexml']['tmp_name'];
                $xml = simplexml_load_file($name);
                $xmldata = object_to_array($xml);
                //轮播图数据
                $data['xmldata'] = $xmldata;
            }
      } 

         $this->assign('pageTitle', '主页');
         $this->load->view('templates_client/header', $data);
         if (isset($xmldata['partlist']['part']['businesslist'])) {
           $this->load->view('templates_client/tabclass-sub', $data); 
        } else {
            $this->load->view('templates_client/tabclass', $data); 
        }
         $this->load->view('templates_client/footer', $data);
            
    } // end detail
    /**
     * 更新预览分类页缓存 
     */
    public function updatedetail() {
          if (IS_POST) {
             $data = $this->input->post();
            if (!empty($_FILES['updateclasspagexml']['tmp_name'])) { //判断上传内容是否为空
                $name = $_FILES['updateclasspagexml']['tmp_name'];
                $xml = simplexml_load_file($name);
                $xmldata = object_to_array($xml);
            } else {
                $data['uerror'] = '上传文件为空！';
                $this->assign('pageTitle', '主页');
                $this->display('backend/PageHome_doXml.html');
                exit;
            }
       // print_r(unserialize(serialize(object_to_array($xml))) );exit;
        if($data['classtype']){
        $redis = new Redis();
        $redis->connect('47.100.19.150', 6379);
        $redis->set('classpage_'.$data['classtype'], serialize($xmldata));
         }
        }

        $this->assign('pageTitle', '主页');
        $this->display('backend/PageHome_doXml.html');
            
    } // end detail
}
/**
 * 对象 转 数组
 *
 * @param object $obj 对象
 * @return array
 */
function object_to_array($obj) {
    $obj = (array)$obj;
    foreach ($obj as $k => $v) {
        if (gettype($v) == 'resource') {
            return;
        }
        if (gettype($v) == 'object' || gettype($v) == 'array') {
            $obj[$k] = (array)object_to_array($v);
        }
    }
    return $obj;
}

