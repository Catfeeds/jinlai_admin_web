<?php
	defined('BASEPATH') OR exit('此文件不可被直接访问');

	/**
	 * Vote_option/VTO 投票候选项类
	 *
	 * @version 1.0.0
	 * @author Kamas 'Iceberg' Lau <kamaslau@outlook.com>
	 * @copyright ICBG <www.bingshankeji.com>
	 */
	class Vote_option extends MY_Controller
	{	
		/**
		 * 可作为列表筛选条件的字段名；可在具体方法中根据需要删除不需要的字段并转换为字符串进行应用，下同
		 */
		protected $names_to_sort = array(
			'vote_id', 'tag_id', 'index_id', 'name', 'ballot_overall',
            'time_create', 'time_delete', 'time_edit', 'creator_id', 'operator_id', 'status', 'time_create_min', 'time_create_max',
		);

		/**
		 * 可被编辑的字段名
		 */
		protected $names_edit_allowed = array(
            'tag_id', 'index_id', 'name', 'description', 'url_image',
		);

		/**
		 * 完整编辑单行时必要的字段名
		 */
		protected $names_edit_required = array(
			'id',
			'name',
		);

        /**
         * @var string 所属投票活动ID
         */
        public $vote_id;

		public function __construct()
		{
			parent::__construct();

			// 未登录用户转到登录页
			($this->session->time_expire_login > time()) OR redirect( base_url('login') );

			// 向类属性赋值
			$this->class_name = strtolower(__CLASS__);
			$this->class_name_cn = '投票候选项'; // 改这里……
			$this->table_name = 'vote_option'; // 和这里……
			$this->id_name = 'option_id'; // 还有这里，OK，这就可以了
			$this->view_root = $this->class_name; // 视图文件所在目录
			$this->media_root = MEDIA_URL. $this->class_name.'/'; // 媒体文件所在目录

            $this->vote_id = empty($this->input->get_post('vote_id'))? NULL: $this->input->get_post('vote_id');

			// 设置需要自动在视图文件中生成显示的字段
			$this->data_to_display = array(
				'name' => '名称',
				'description' => '描述',
			);
		} // end __construct

		/**
		 * 列表页
		 */
		public function index()
		{
            // 检查是否已传入必要参数
			$vote_id = $this->vote_id;
			if ( !empty($vote_id) ):
                $params['vote_id'] = $vote_id;
            else:
                redirect( base_url('error/code_400') ); // 若缺少参数，转到错误提示页
            endif;

			// 页面信息
			$data = array(
				'title' => $this->class_name_cn. '列表',
				'class' => $this->class_name.' index',
                'vote_id' => $this->vote_id,
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

                // 获取投票信息
                $data['vote'] = $this->get_vote($vote_id);

			else:
				$data['items'] = array();
				$data['error'] = $result['content']['error']['message'];

			endif;

			// 将需要显示的数据传到视图以备使用
			$data['data_to_display'] = $this->data_to_display;

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
				$data['item'] = $result['content'];

                // 获取投票信息
                $data['vote'] = $this->get_vote($data['item']['vote_id']);
				
				// 页面信息
                $data['title'] = $this->class_name_cn. ' "'. $data['item']['name']. '"';
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
		 * 回收站
		 */
		public function trash()
		{
            // 检查是否已传入必要参数
            $vote_id = $this->vote_id;
            if ( !empty($vote_id) ):
                $params['vote_id'] = $vote_id;
            else:
                redirect( base_url('error/code_400') ); // 若缺少参数，转到错误提示页
            endif;

			// 操作可能需要检查操作权限
			$role_allowed = array('管理员', '经理'); // 角色要求
			$min_level = 30; // 级别要求
			$this->permission_check($role_allowed, $min_level);

			// 页面信息
			$data = array(
				'title' => $this->class_name_cn. '回收站',
				'class' => $this->class_name.' trash',
                'vote_id' => $this->vote_id,
			);

			// 筛选条件
			$condition['time_delete'] = 'IS NOT NULL';
			// （可选）遍历筛选条件
			foreach ($this->names_to_sort as $sorter):
				if ( !empty($this->input->get_post($sorter)) )
					$condition[$sorter] = $this->input->get_post($sorter);
			endforeach;

			// 排序条件
			$order_by['time_delete'] = 'DESC';

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

			// 将需要显示的数据传到视图以备使用
			$data['data_to_display'] = $this->data_to_display;

			// 输出视图
			$this->load->view('templates/header', $data);
			$this->load->view($this->view_root.'/trash', $data);
			$this->load->view('templates/footer', $data);
		} // end trash

		/**
		 * 创建
		 */
		public function create()
		{
			// 操作可能需要检查操作权限
			// $role_allowed = array('管理员', '经理'); // 角色要求
// 			$min_level = 30; // 级别要求
// 			$this->basic->permission_check($role_allowed, $min_level);

            // 检查是否已传入必要参数
            $vote_id = $this->vote_id;
            if ( empty($vote_id) )
                redirect( base_url('error/code_400') ); // 若缺少参数，转到错误提示页

			// 页面信息
			$data = array(
				'title' => '创建'.$this->class_name_cn,
				'class' => $this->class_name.' create',
				'error' => '', // 预设错误提示
                'vote_id' => $vote_id,
			);

			// 待验证的表单项
			$this->form_validation->set_error_delimiters('', '；');
			// 验证规则 https://www.codeigniter.com/user_guide/libraries/form_validation.html#rule-reference
            $this->form_validation->set_rules('tag_id', '所属标签', 'trim|is_natural_no_zero');
            $this->form_validation->set_rules('index_id', '索引序号', 'trim|is_natural_no_zero|less_than[65535]');
			$this->form_validation->set_rules('name', '名称', 'trim|required|max_length[30]');
			$this->form_validation->set_rules('description', '描述', 'trim|max_length[100]');
			$this->form_validation->set_rules('url_image', '形象图', 'trim|max_length[255]');

			// 若表单提交不成功
			if ($this->form_validation->run() === FALSE):
				$data['error'] = validation_errors();

                // 获取候选项标签
			    $data['tags'] = $this->list_vote_tag($vote_id);

				$this->load->view('templates/header', $data);
				$this->load->view($this->view_root.'/create', $data);
				$this->load->view('templates/footer', $data);

			else:
				// 需要创建的数据；逐一赋值需特别处理的字段
				$data_to_create = array(
					'user_id' => $this->session->user_id,
                    'vote_id' => $vote_id,
				);
				// 自动生成无需特别处理的数据
				$data_need_no_prepare = array(
                    'tag_id', 'index_id', 'name', 'description', 'url_image',
				);
				foreach ($data_need_no_prepare as $name)
					$data_to_create[$name] = $this->input->post($name);

				// 向API服务器发送待创建数据
				$params = $data_to_create;
				$url = api_url($this->class_name. '/create');
				$result = $this->curl->go($url, $params, 'array');
				if ($result['status'] === 200):
					$data['title'] = $this->class_name_cn. '创建成功';
					$data['class'] = 'success';
					$data['content'] = $result['content']['message'];
					$data['operation'] = 'create';
					$data['id'] = $result['content']['id']; // 创建后的信息ID

					$this->load->view('templates/header', $data);
					$this->load->view($this->view_root.'/result', $data);
					$this->load->view('templates/footer', $data);

				else:
					// 若创建失败，则进行提示
					$data['error'] = $result['content']['error']['message'];

					$this->load->view('templates/header', $data);
					$this->load->view($this->view_root.'/create', $data);
					$this->load->view('templates/footer', $data);

				endif;
				
			endif;
		} // end create

		/**
		 * 编辑单行
		 */
		public function edit()
		{
			// 检查是否已传入必要参数
			$id = $this->input->get_post('id')? $this->input->get_post('id'): NULL;
			if ( !empty($id) ):
				$params['id'] = $id;
			else:
				redirect( base_url('error/code_400') ); // 若缺少参数，转到错误提示页
			endif;

			// 操作可能需要检查操作权限
			// $role_allowed = array('管理员', '经理'); // 角色要求
// 			$min_level = 30; // 级别要求
// 			$this->basic->permission_check($role_allowed, $min_level);

			// 页面信息
			$data = array(
				'title' => '修改'.$this->class_name_cn,
				'class' => $this->class_name.' edit',
				'error' => '', // 预设错误提示
			);

			// 从API服务器获取相应详情信息
			$url = api_url($this->class_name. '/detail');
			$result = $this->curl->go($url, $params, 'array');
			if ($result['status'] === 200):
				$data['item'] = $result['content'];
			    $data['vote_id'] = $data['item']['vote_id'];
			else:
				redirect( base_url('error/code_404') ); // 若未成功获取信息，则转到错误页
			endif;

			// 待验证的表单项
			$this->form_validation->set_error_delimiters('', '；');
            $this->form_validation->set_rules('tag_id', '所属标签', 'trim|is_natural_no_zero');
            $this->form_validation->set_rules('index_id', '索引序号', 'trim|is_natural_no_zero|less_than[65535]');
			$this->form_validation->set_rules('name', '名称', 'trim|required|max_length[30]');
			$this->form_validation->set_rules('description', '描述', 'trim|max_length[100]');
			$this->form_validation->set_rules('url_image', '形象图URL', 'trim|max_length[255]');

			// 若表单提交不成功
			if ($this->form_validation->run() === FALSE):
				$data['error'] .= validation_errors();

                $data['tags'] = $this->list_vote_tag($data['vote_id']);

				$this->load->view('templates/header', $data);
				$this->load->view($this->view_root.'/edit', $data);
				$this->load->view('templates/footer', $data);

			else:
				// 需要编辑的数据；逐一赋值需特别处理的字段
				$data_to_edit = array(
					'user_id' => $this->session->user_id,
					'id' => $id,
				);
				// 自动生成无需特别处理的数据
				$data_need_no_prepare = array(
                    'tag_id', 'index_id', 'name', 'description', 'url_image',
				);
				foreach ($data_need_no_prepare as $name)
					$data_to_edit[$name] = $this->input->post($name);

				// 向API服务器发送待创建数据
				$params = $data_to_edit;
				$url = api_url($this->class_name. '/edit');
				$result = $this->curl->go($url, $params, 'array');
				if ($result['status'] === 200):
					$data['title'] = $this->class_name_cn. '修改成功';
					$data['class'] = 'success';
					$data['content'] = $result['content']['message'];
					$data['operation'] = 'edit';
					$data['id'] = $result['content']['id']; // 修改后的信息ID

					$this->load->view('templates/header', $data);
					$this->load->view($this->view_root.'/result', $data);
					$this->load->view('templates/footer', $data);

				else:
					// 若修改失败，则进行提示
					$data['error'] = $result['content']['error']['message'];

					$this->load->view('templates/header', $data);
					$this->load->view($this->view_root.'/edit', $data);
					$this->load->view('templates/footer', $data);

				endif;

			endif;
		} // end edit

        /**
         * 批准参选
         */
        public function approve()
        {
            // 检查必要参数是否已传入
            if ( empty($this->input->post_get('ids')))
                redirect( base_url('error/code_400') ); // 若缺少参数，转到错误提示页

            // 操作可能需要检查操作权限
            // $role_allowed = array('管理员', '经理'); // 角色要求
// 			$min_level = 30; // 级别要求
// 			$this->basic->permission_check($role_allowed, $min_level);

            $op_name = '批准参选'; // 操作的名称
            $op_view = 'approve'; // 操作名、视图文件名

            // 赋值视图中需要用到的待操作项数据
            $ids = $this->parse_ids_array(); // 数组格式，已去掉重复项及空项
            $ids_string = implode(',', $ids); // 字符串格式

            // 页面信息
            $data = array(
                'title' => $op_name. $this->class_name_cn,
                'class' => $this->class_name. ' '. $op_view,
                'error' => '', // 预设错误提示

                'op_name' => $op_view,
                'ids' => $ids_string,
            );

            // 获取待操作项数据
            $params = array('ids' => $ids_string);
            $url = api_url($this->class_name.'/index');
            $data['items'] = $this->curl->go($url, $params, 'array')['content'];

            // 将需要显示的数据传到视图以备使用
            $data['data_to_display'] = $this->data_to_display;

            // 待验证的表单项
            $this->form_validation->set_error_delimiters('', '；');
            $this->form_validation->set_rules('ids', '待操作数据', 'trim|required|regex_match[/^(\d|\d,?)+$/]'); // 仅允许非零整数和半角逗号
            $this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|max_length[20]');

            // 若表单提交不成功
            if ($this->form_validation->run() === FALSE):
                $data['error'] .= validation_errors();

                $this->load->view('templates/header', $data);
                $this->load->view($this->view_root.'/'.$op_view, $data);
                $this->load->view('templates/footer', $data);

            else:
                // 检查必要参数是否已传入
                $required_params = $this->names_edit_bulk_required;
                foreach ($required_params as $param):
                    ${$param} = $this->input->post($param);
                    if ( empty( ${$param} ) ):
                        $data['error'] = '必要的请求参数未全部传入';
                        $this->load->view('templates/header', $data);
                        $this->load->view($this->view_root.'/'.$op_view, $data);
                        $this->load->view('templates/footer', $data);
                        exit();
                    endif;
                endforeach;

                // 需要存入数据库的信息
                $data_to_edit = array(
                    'user_id' => $this->session->user_id,
                    'ids' => $ids,
                    'password' => $password,
                    'operation' => $op_view,
                );

                // 向API服务器发送待修改数据
                $params = $data_to_edit;
                $url = api_url($this->class_name. '/edit_bulk');
                $result = $this->curl->go($url, $params, 'array');
                if ($result['status'] === 200):
                    $data['title'] = $this->class_name_cn.$op_name. '成功';
                    $data['class'] = 'success';
                    $data['content'] = $result['content']['message'];

                    $this->load->view('templates/header', $data);
                    $this->load->view($this->view_root.'/result', $data);
                    $this->load->view('templates/footer', $data);

                else:
                    // 若修改失败，则进行提示
                    $data['error'] .= $result['content']['error']['message'];

                    $this->load->view('templates/header', $data);
                    $this->load->view($this->view_root.'/'.$op_view, $data);
                    $this->load->view('templates/footer', $data);
                endif;

            endif;
        } // end approve

        /**
         * 拒绝参选
         */
        public function reject()
        {
            // 检查必要参数是否已传入
            if ( empty($this->input->post_get('ids')))
                redirect( base_url('error/code_400') ); // 若缺少参数，转到错误提示页

            // 操作可能需要检查操作权限
            // $role_allowed = array('管理员', '经理'); // 角色要求
// 			$min_level = 30; // 级别要求
// 			$this->basic->permission_check($role_allowed, $min_level);

            $op_name = '拒绝参选'; // 操作的名称
            $op_view = 'reject'; // 操作名、视图文件名

            // 赋值视图中需要用到的待操作项数据
            $ids = $this->parse_ids_array(); // 数组格式，已去掉重复项及空项
            $ids_string = implode(',', $ids); // 字符串格式

            // 页面信息
            $data = array(
                'title' => $op_name. $this->class_name_cn,
                'class' => $this->class_name. ' '. $op_view,
                'error' => '', // 预设错误提示

                'op_name' => $op_view,
                'ids' => $ids_string,
            );

            // 获取待操作项数据
            $params = array('ids' => $ids_string);
            $url = api_url($this->class_name.'/index');
            $data['items'] = $this->curl->go($url, $params, 'array')['content'];

            // 将需要显示的数据传到视图以备使用
            $data['data_to_display'] = $this->data_to_display;

            // 待验证的表单项
            $this->form_validation->set_error_delimiters('', '；');
            $this->form_validation->set_rules('ids', '待操作数据', 'trim|required|regex_match[/^(\d|\d,?)+$/]'); // 仅允许非零整数和半角逗号
            $this->form_validation->set_rules('password', '密码', 'trim|required|min_length[6]|max_length[20]');

            // 若表单提交不成功
            if ($this->form_validation->run() === FALSE):
                $data['error'] .= validation_errors();

                $this->load->view('templates/header', $data);
                $this->load->view($this->view_root.'/'.$op_view, $data);
                $this->load->view('templates/footer', $data);

            else:
                // 检查必要参数是否已传入
                $required_params = $this->names_edit_bulk_required;
                foreach ($required_params as $param):
                    ${$param} = $this->input->post($param);
                    if ( empty( ${$param} ) ):
                        $data['error'] = '必要的请求参数未全部传入';
                        $this->load->view('templates/header', $data);
                        $this->load->view($this->view_root.'/'.$op_view, $data);
                        $this->load->view('templates/footer', $data);
                        exit();
                    endif;
                endforeach;

                // 需要存入数据库的信息
                $data_to_edit = array(
                    'user_id' => $this->session->user_id,
                    'ids' => $ids,
                    'password' => $password,
                    'operation' => $op_view, // 操作名称
                );

                // 向API服务器发送待修改数据
                $params = $data_to_edit;
                $url = api_url($this->class_name. '/edit_bulk');
                $result = $this->curl->go($url, $params, 'array');
                if ($result['status'] === 200):
                    $data['title'] = $this->class_name_cn.$op_name. '成功';
                    $data['class'] = 'success';
                    $data['content'] = $result['content']['message'];

                    $this->load->view('templates/header', $data);
                    $this->load->view($this->view_root.'/result', $data);
                    $this->load->view('templates/footer', $data);

                else:
                    // 若修改失败，则进行提示
                    $data['error'] .= $result['content']['error']['message'];

                    $this->load->view('templates/header', $data);
                    $this->load->view($this->view_root.'/'.$op_view, $data);
                    $this->load->view('templates/footer', $data);
                endif;

            endif;
        } // end reject

        /**
         * 以下为工具类方法
         */

    } // end class Vote_option

/* End of file Vote_option.php */
/* Location: ./application/controllers/Vote_option.php */
