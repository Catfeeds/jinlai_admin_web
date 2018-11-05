<?php
	defined('BASEPATH') OR exit('此文件不可被直接访问');

	/**
	 * Refund/RFD 退款/售后类
     *
     * 仅退款类型，当商家同意后进行退款；退货退款类型，当商家收货后进行退款
     * 若货款未结算，则直接从商家余额中扣除相应商家余额到平台余额，平台向用户原路退款
     * 若货款已结算，商家余额足够时扣除相应商家余额到平台余额，平台向用户原路退款；余额不足时创建对商家的待收款项和对用户的待付款项
	 *
	 * @version 1.0.0
	 * @author Kamas 'Iceberg' Lau <kamaslau@outlook.com>
	 * @copyright ICBG <www.bingshankeji.com>
	 */
	class Refund extends MY_Controller
	{
		/**
		 * 可作为列表筛选条件的字段名；可在具体方法中根据需要删除不需要的字段并转换为字符串进行应用，下同
		 */
		protected $names_to_sort = array(
			'order_id', 'biz_id', 'user_id', 'record_id', 'type', 'cargo_status', 'reason', 'description', 'url_images', 'total_applied', 'total_approved', 'deliver_method', 'deliver_biz', 'waybill_id',
            'time_create', 'time_cancel', 'time_close', 'time_refuse', 'time_accept', 'time_refund', 'time_edit', 'operator_id', 'status',
		);

		public function __construct()
		{
			parent::__construct();

			// 未登录用户转到登录页
			($this->session->time_expire_login > time()) OR redirect( base_url('login') );

			// 向类属性赋值
			$this->class_name = strtolower(__CLASS__);
			$this->class_name_cn = '退款/售后'; // 改这里……
			$this->table_name = 'refund'; // 和这里……
			$this->id_name = 'refund_id'; // 还有这里，OK，这就可以了
			$this->view_root = $this->class_name; // 视图文件所在目录
            $this->media_root = MEDIA_URL. 'item/'; // 媒体文件所在目录，默认为商品信息

			// 设置需要自动在视图文件中生成显示的字段
			$this->data_to_display = array(
				'order_id' => '订单ID',
                'cargo_status' => '货物状态',
				'total_applied' => '申请退款金额',
			);
		} // end __construct

		/**
		 * 列表页
		 */
		public function index()
		{
			// 页面信息
			$data = array(
				'title' => $this->class_name_cn. '列表',
				'class' => $this->class_name.' index',
			);

			// 筛选条件
			$condition['time_delete'] = 'NULL';
			// （可选）遍历筛选条件
			foreach ($this->names_to_sort as $sorter):
                if ( !empty($this->input->get_post($sorter)) )
                    $condition[$sorter] = $this->input->get_post($sorter);
			endforeach;

			// 排序条件
			$order_by = NULL;

			// 从API服务器获取相应列表信息
			$params = $condition;
			$url = api_url($this->class_name. '/index');
			$result = $this->curl->go($url, $params, 'array');
			if ($result['status'] === 200):
				$data['items'] = $result['content'];
			else:
				$data['items'] = array();
				$data['error'] = $result['content']['error']['message'];
			endif;

            // 根据状态筛选值确定页面标题
            if ( !empty($condition['status'] ) )
                $data['title'] = $condition['status']. '退款';

			// 输出视图
			$this->load->view('templates/header', $data);
			$this->load->view($this->view_root.'/index', $data);
			$this->load->view('templates/footer', $data);
		} // end index

		/**
		 * 详情页
		 */
		public function detail()
		{
			// 检查是否已传入必要参数
			$id = $this->input->get_post('id')? $this->input->get_post('id'): NULL;
            $record_id = $this->input->get_post('record_id')? $this->input->get_post('record_id'): NULL;
			if ( !empty($id) ):
				$params['id'] = $id;
			elseif (!empty($record_id)):
                $params['record_id'] = $record_id;
			else:
				redirect( base_url('error/code_400') ); // 若缺少参数，转到错误提示页
			endif;

            // 从API服务器获取相应详情信息
            $url = api_url($this->class_name. '/detail');
            $result = $this->curl->go($url, $params, 'array');
            if ($result['status'] === 200):
                $data['item'] = $result['content'];
                $url   = api_url('order/detail');
            	$order = $this->curl->go($url, ['id'=>$result['content']['order_id']], 'array');
            	if ($order['status'] === 200){
            		$data['biz_name'] = $order['content']['biz_name'];
            	}
                // 页面信息
                $data['title'] = $this->class_name_cn. $data['item'][$this->id_name];
                $data['class'] = $this->class_name.' detail';

                // 输出视图
                $this->load->view('templates/header', $data);
                $this->load->view($this->view_root.'/detail', $data);
                $this->load->view('templates/footer', $data);

            else:
                redirect( base_url('error/code_404') ); // 若缺少参数，转到错误提示页

            endif;
		} // end detail

		/**
		 * TODO 根据条件导出订单信息为excel
		 *
		 * 起止时间、字段等
		 */
		public function export(){
			$this->class_name_cn = '';
			// 页面信息
            $data = [
                'title' => '退款导出'. $this->class_name_cn,
                'class' => $this->class_name. ' export',
                'error' => '', // 预设错误提示
                'refund_status' => ['待处理','已取消','已关闭','已拒绝','待退货','待退款','已退款'],
                'biz'   => $this->getallbiz()
            ];
			// 待验证的表单项
			$this->form_validation->set_error_delimiters('', '；');
            $this->form_validation->set_rules('time_create_min', '开始时间', 'trim|required');
            $this->form_validation->set_rules('time_create_max', '结束时间', 'trim|required');
            $this->form_validation->set_rules('user_id', '用户id', 'trim|integer');
            $this->form_validation->set_rules('order_id', '起始订单id', 'trim|integer|max_length[11]');
            $this->form_validation->set_rules('limit', '总量', 'trim|integer|max_length[4]');
            $this->form_validation->set_rules('status', '订单状态', 'trim|in_list[待处理,已取消,已关闭,已拒绝,待退货,待退款,已退款]');
            $this->form_validation->set_rules('biz_id', '商家', 'trim|integer');
            //若表单提交不成功
			if ($this->form_validation->run() === FALSE):
				$data['error'] .= validation_errors();
				$this->load->view('templates/header', $data);
				$this->load->view($this->view_root.'/export', $data);
				$this->load->view('templates/footer', $data);

			else:
				//起始订单id 
				$order_id = intval($this->input->post('order_id'));
				// 筛选参数；逐一赋值需特别处理的字段
				$data_to_send = array(
					'time_create_min' => strtotime($this->input->post('time_create_min') . ':00'),
                    'time_create_max' => strtotime($this->input->post('time_create_max') . ':00'),
                    'client_type'     => 'biz',
				);
				// 自动生成无需特别处理的数据
				$data_need_no_prepare = array(
                    'status','user_id','mobile','payment_type','limit','biz_id'
				);
				foreach ($data_need_no_prepare as $name)
					$data_to_send[$name] = $this->input->post($name);

				// 查找是否存在文件缓存
				$new_condition = sha1(implode('-', $data_to_send));
				if (isset($_COOKIE[$new_condition]) && file_exists($_COOKIE[$new_condition])) :
					redirect('/' . $_COOKIE[$new_condition]);
					exit;
				endif;

                // 向API服务器发送待创建数据
				$params = $data_to_send;
				$url    = api_url($this->class_name. '/index');
				$result = $this->curl->go($url, $params, 'array');
				//api返回成功
				if ($result['status'] == 200):
					$this->user_id = $this->session->user_id;
					$data_list = [];
					$data_filterd = [];

					//增加一步 ，字段过滤,处理订单的item
					$data_order_show = ['biz_id'=>'商家ID','order_id'=>'订单ID','user_id'=>'用户ID','total_payed'=>'实际退款金额','total_applied'=>'申请退款金额','total_approved'=>'同意退款金额','cargo_status'=>'货物状态','reason'=>'原因','description'=>'补充说明','deliver_method'=>'退货方式','deliver_biz'=>'物流服务商','waybill_id'=>'运单号','note_stuff'=>'员工备注','time_create'=>'用户创建时间','time_cancel'=>'用户取消时间','time_close'=>'关闭时间','time_accept'=>'商家同意时间','time_confirm'=>'商家收货时间','time_refuse'=>'商家拒绝时间','time_refund'=>'商家退款时间','status'=>'订单状态'];
					foreach ($result['content'] as  $order) :
						//从哪开始
						if ($order['order_id'] < $order_id) :
							continue;
						endif;
						$data_filterd = [];
						foreach ($order as $key => $value) :
							if ( !is_array($value) && array_key_exists($key, $data_order_show) ):
								$data_filterd[$data_order_show[$key]] = $value;
								if ($key == 'biz_id' && isset($data['biz'][$data_filterd['商家ID']]) ) :
									$data_filterd['商家名称'] = $data['biz'][$data_filterd['商家ID']];
								endif;
							endif;
						endforeach;
						$data_list[] = $data_filterd;
					endforeach;
					//导出
					$this->load->library('Excel');
					$this->excel->export($data_list, $data_to_send['time_create_min'] . '-' . $data_to_send['time_create_max'] . '退款导出', 'save');
					if ($this->result['status'] == 200) :
						//文件生成 后 保存 cookie
						$cookie_condition = sha1(implode('-', $params));
						setcookie($cookie_condition,  $this->result['content'], time() + 180);
						redirect('/' . $this->result['content']);
						exit;
					else:
						$data['error'] = $this->result['content']['error']['message'];
                        $this->load->view('templates/header', $data);
                        $this->load->view($this->view_root.'/export', $data);
                        $this->load->view('templates/footer', $data);
					endif;

				else:
					if (isset($result['content']['error'])) :
						$data['error'] = $result['content']['error']['message'];
					else: 
						$data['error'] = '导出错误，稍后重试';
					endif;

                    $this->load->view('templates/header', $data);
                    $this->load->view($this->view_root.'/export', $data);
                    $this->load->view('templates/footer', $data);
				endif;
			endif;
		}

		private function getallbiz(){
			//所有商家信息的缓存
			$filepath = './temp_files/' . date('Y-m-d') . '_biz_cache.php';
			if (file_exists($filepath)) :
				require $filepath;
				if (isset($data))
					return $data ;
			endif;
			//没有缓存从接口读取
			$params = ['app_type'=>'admin'];
			$url    = api_url('biz/index');
			$result = $this->curl->go($url, $params, 'array');

			$data = [];
			if (is_array($result) && $result['status'] == 200) :
				//简化数据
				foreach ($result['content'] as $key => $value) :
					if (is_null($value['time_delete'])) {
						$data[$value['biz_id']] = $value['brief_name'];
					}
				endforeach;
				//保存成文件
				if (!empty($data)) :
					$str = "<?php \$data = " . var_export($data, TRUE) . ';';
					$r = file_put_contents($filepath, $str);
					if ($r) 
						return $data;

				endif;
			endif;
			return [];
		}


        /**
         * 删除
         *
         * 不可删除
         */
        public function delete()
        {
            exit('不可删除用户的'.$this->class_name_cn.'；您意图违规操作的记录已被发送到安全中心。');
        } // end delete

        /**
         * 找回
         *
         * 不可找回
         */
        public function restore()
        {
            exit('不可找回用户的'.$this->class_name_cn.'；您意图违规操作的记录已被发送到安全中心。');
        } // end restore

        /**
         * 以下为工具类方法
         */

	} // end class Refund

/* End of file Refund.php */
/* Location: ./application/controllers/Refund.php */
