<?php
	defined('BASEPATH') OR exit('此文件不可被直接访问');

	/**
	 * Order/ORD 商品订单类
	 *
	 * @version 1.0.0
	 * @author Kamas 'Iceberg' Lau <kamaslau@outlook.com>
	 * @copyright ICBG <www.bingshankeji.com>
	 */
	class Order extends MY_Controller
	{	
		/**
		 * 可作为列表筛选条件的字段名；可在具体方法中根据需要删除不需要的字段并转换为字符串进行应用，下同
		 */
		protected $names_to_sort = array(
			'user_id', 'user_ip', 'subtotal', 'promotion_id', 'discount_promotion', 'coupon_id', 'discount_coupon', 'credit_id', 'discount_credit', 'freight', 'total', 'discount_teller', 'teller_id', 'total_payed', 'total_refund', 'addressee_fullname', 'addressee_mobile', 'addressee_province', 'addressee_city', 'addressee_county', 'addressee_address', 'payment_type', 'payment_account', 'payment_id', 'note_user', 'note_stuff', 'commission_rate', 'commission', 'promoter_id', 'time_create', 'time_cancel', 'time_expire', 'time_pay', 'time_refuse', 'time_deliver', 'time_confirm', 'time_confirm_auto', 'time_comment', 'time_refund', 'time_delete', 'time_edit', 'operator_id', 'invoice_status', 'status',
			'time_create', 'time_delete', 'time_edit', 'creator_id', 'operator_id',
		);

		public function __construct()
		{
			parent::__construct();

			// 未登录用户转到登录页
			($this->session->time_expire_login > time()) OR redirect( base_url('login') );

			// 向类属性赋值
			$this->class_name = strtolower(__CLASS__);
			$this->class_name_cn = '商品订单'; // 改这里……
			$this->table_name = 'order'; // 和这里……
			$this->id_name = 'order_id'; // 还有这里，OK，这就可以了
			$this->view_root = $this->class_name; // 视图文件所在目录
			$this->media_root = MEDIA_URL. 'item/'; // 媒体文件所在目录，默认为商品信息

			// 设置需要自动在视图文件中生成显示的字段
			$this->data_to_display = array(
				'subtotal' => '商品小计',
				'total' => '应支付',
				'total_payed' => '已支付',
				'status' => '状态',
			);
		} // end __construct

		/**
		 * 列表页
		 */
		public function index()
		{
			// 页面信息
			$data = array(
				'title' => '所有'. $this->class_name_cn,
				'class' => $this->class_name.' index',
			);

			// 筛选条件
            $condition = array();
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
			    $data['title'] = $condition['status']. '订单';

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
			if ( !empty($id) ):
				$params['id'] = $id;
			else:
				redirect( base_url('error/code_400') ); // 若缺少参数，转到错误提示页
			endif;

			// 从API服务器获取相应详情信息
			$url = api_url($this->class_name. '/detail');
			$result = $this->curl->go($url, $params, 'array');
			if ($result['status'] === 200):
				$data['item'] = $result['content']; // 清除空元素

                // 获取相关用户信息
                $data['user'] = $this->get_user($data['item']['user_id']);

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

	} // end class Order

/* End of file Order.php */
/* Location: ./application/controllers/Order.php */
