<link rel=stylesheet media=all href="/css/detail.css">
<style>
    #list-options td {height:30px;overflow:hidden;vertical-align:top;}

	/* 宽度在750像素以上的设备 */
	@media only screen and (min-width:751px)
	{
		
	}
	
	/* 宽度在960像素以上的设备 */
	@media only screen and (min-width:961px)
	{

	}

	/* 宽度在1280像素以上的设备 */
	@media only screen and (min-width:1281px)
	{

	}
</style>

<script defer src="/js/detail.js"></script>

<base href="<?php echo $this->media_root ?>">

<div id=breadcrumb>
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url() ?>">首页</a></li>
		<li><a href="<?php echo base_url($this->class_name) ?>"><?php echo $this->class_name_cn ?></a></li>
		<li class=active><?php echo $title ?></li>
	</ol>
</div>

<div id=content class=container>
	<?php if ( empty($item) ): ?>
	<p><?php echo $error ?></p>

	<?php
		else:
			// 需要特定角色和权限进行该操作
			$current_role = $this->session->role; // 当前用户角色
			$current_level = $this->session->level; // 当前用户级别
			$role_allowed = array('管理员', '经理');
			$level_allowed = 30;
			//if ( in_array($current_role, $role_allowed) && ($current_level >= $level_allowed) ):
			?>

            <ul id=item-actions class=list-unstyled>
                <li><a title="候选项标签列表" href="<?php echo base_url('vote_tag?vote_id='.$item[$this->id_name]) ?>" target="_blank">候选项标签</a></li>
                <li><a title="创建候选项标签" href="<?php echo base_url('vote_tag/create?vote_id='.$item[$this->id_name]) ?>" target="_blank">创建候选项标签</a></li>
                <li><a title="候选项列表" href="<?php echo base_url('vote_option?vote_id='.$item[$this->id_name]) ?>" target="_blank">候选项</a></li>
                <li><a title="创建候选项" href="<?php echo base_url('vote_option/create?vote_id='.$item[$this->id_name]) ?>" target="_blank">创建候选项</a></li>
                <li><a title="编辑" href="<?php echo base_url($this->class_name.'/edit?id='.$item[$this->id_name]) ?>">编辑</a></li>
		    </ul>
			<?php //endif ?>

	<dl id=list-info class=dl-horizontal>
		<dt><?php echo $this->class_name_cn ?>ID</dt>
		<dd><?php echo $item[$this->id_name] ?></dd>

        <?php
        // 当前项客户端URL
        $item_url = WEB_URL.$this->class_name.'/detail?id='.$item[$this->id_name];
        ?>
        <dt><?php echo $this->class_name_cn ?>链接</dt>
        <dd>
            <span><?php echo $item_url ?></span>
            <a href="<?php echo $item_url ?>" target=_blank>查看</a>
            <p>部分投票活动页面仅支持在微信中打开</p>
        </dd>

        <dt><?php echo $this->class_name_cn ?>二维码</dt>
        <dd>
            <figure class=qrcode data-qrcode-string="<?php echo $item_url ?>"></figure>
        </dd>

		<dt>名称</dt>
		<dd><?php echo $item['name'] ?></dd>
        <dt>自定义URL</dt>
        <dd><?php echo $item['url_name'] ?></dd>
		<dt>描述</dt>
		<dd><?php echo $item['description'] ?></dd>

        <dt>形象图</dt>
        <dd>
            <?php
            $column_image = 'url_image';
            if ( empty($item[$column_image]) ):
            ?>
            <p>未上传</p>
            <?php else: ?>
                <figure id=vote-url_image class=vote-figure>
                    <img class=lazyload data-original="<?php echo $item[$column_image] ?>">
                </figure>
            <?php endif ?>
        </dd>

        <dt>背景音乐</dt>
        <dd>
            <?php
            $column_image = 'url_audio';
            if ( empty($item[$column_image]) ):
            ?>
            <p>未上传</p>
            <?php else: ?>
            <audio controls src="<?php echo $item[$column_image] ?>">您的浏览器不支持音频播放</audio>
            <?php endif ?>
        </dd>

        <dt>形象视频</dt>
        <dd>
            <?php
            if ( empty($item['url_video']) ):
            ?>
            <p>未上传</p>
            <?php else: ?>
            <figure id=url_video class=vote-figure>
                <video controls alt="<?php echo $item['name'] ?>形象视频" src="<?php echo $item['url_video'] ?>" poster="<?php echo $item['url_video_thumb'] ?>">您的浏览器不支持视频播放</video>
            </figure>
            <?php endif ?>
        </dd>

        <dt>形象视频缩略图</dt>
        <dd>
            <?php
            $column_image = 'url_video_thumb';
            if ( empty($item[$column_image]) ):
                ?>
                <p>未上传</p>
            <?php else: ?>
                <figure id=vote-url_video_thumb class=vote-figure>
                    <img class=lazyload src="<?php echo $item[$column_image] ?>">
                </figure>
            <?php endif ?>
        </dd>

        <dt>选项默认占位图</dt>
        <dd class=row>
            <?php
            $column_image = 'url_default_option_image';
            if ( empty($item[$column_image]) ):
                ?>
                <p>未上传</p>
            <?php else: ?>
                <figure id=vote-url_default_option_image class=vote-figure>
                    <img src="<?php echo $item[$column_image] ?>">
                </figure>
            <?php endif ?>
        </dd>

		<dt>可报名</dt>
		<dd><?php echo $item['signup_allowed'] ?></dd>

        <dt>投票规则</dt>
        <dd>
            <?php echo ($item['max_user_total'] == 0)? NULL: '总共可投'.$item['max_user_total'].'票，' ?>每人每天<?php echo $item['max_user_daily'] ?>张选票，同一候选项每天限投<?php echo $item['max_user_daily_each'] ?>票
        </dd>

		<dt>起止时间</dt>
		<dd>
            <?php echo date('Y-m-d H:i:s', $item['time_start']). ' - '. date('Y-m-d H:i:s', $item['time_end']) ?>
            <p>
                持续<?php echo round( ($item['time_end'] - $item['time_start']) / (60 * 60 * 24), 1) // 计算天数，保留一位小数 ?>天，
                <?php
                    $days_to_start = round( ($item['time_start'] - time()) / (60 * 60 * 24), 1);
                    if ($days_to_start < 0):
                        echo '已在进行中';
                    else:
                        echo $days_to_start.'天后开始';
                    endif;
                ?>
            </p>
        </dd>
	</dl>

    <?php if (empty($options)): ?>
    <p>暂无有效候选项。</p>

    <?php else: ?>
    <hr>
    <table id=list-options class="table table-striped">
        <thead class=thead-dark>
            <tr>
                <th>形象图</th>
                <th data-sort=int>候选项ID</th>
                <th>名称</th>
                <th data-sort=int>目前选票</th>
                <th data-sort=int>标签ID</th>
                <th data-sort=int>索引序号</th>
                <th data-sort=string>状态</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody>
        <?php
            // 候选项默认占位图
            $default_option_image = $item['url_default_option_image'];
            foreach ($options as $option):
        ?>
        <tr>

            <td>
                <a title="查看" href="<?php echo base_url('vote_option/detail?id='.$option['option_id']) ?>" target=_blank>
                <figure>
                    <img
                            class=lazyload
                            src="<?php echo $default_option_image ?>"
                            data-original="<?php echo !empty($option['url_image'])? MEDIA_URL.'vote_option/'.$option['url_image']: $default_option_image ?>"
                    >
                </figure>
                </a>
            </td>
            <td><?php echo $option['option_id'] ?></td>
            <td><?php echo $option['name'] ?></td>
            <td><?php echo $option['ballot_count'] ?></td>
            <td><?php echo $option['tag_id'] ?></td>
            <td><?php echo $option['index_id'] ?></td>
            <td><?php echo $option['status'] ?></td>
            <td class=option-actions>
                <ul>
                    <?php
                    // 需要特定角色和权限进行该操作
                    //if ( in_array($current_role, $role_allowed) && ($current_level >= $level_allowed) ):
                    ?>
                    <li><a href="<?php echo base_url('vote_option/detail?id='.$option['option_id']) ?>" target=_blank>查看</a></li>
                    <li><a href="<?php echo base_url('vote_option/edit?id='.$option['option_id']) ?>" target=_blank>编辑</a></li>

                    <?php if ($option['status'] === '正常'): ?>
                        <li><a href="<?php echo base_url('vote_ballot/create?vote_id='.$option['vote_id'].'&option_id='.$option['option_id']) ?>" target=_blank>投票</a></li>
                        <li><a href="<?php echo base_url('vote_option/delete?ids='.$option['option_id']) ?>" target=_blank>删除</a></li>
                        <li><a href="<?php echo base_url('vote_option/reject?ids='.$option['option_id']) ?>" target=_blank>中止参选</a></li>
                    <?php elseif ($option['status'] === '待审核'): ?>
                        <li><a href="<?php echo base_url('vote_option/approve?ids='.$option['option_id']) ?>" target=_blank>批准</a></li>
                        <li><a href="<?php echo base_url('vote_option/reject?ids='.$option['option_id']) ?>" target=_blank>拒绝</a></li>
                    <?php elseif ($option['status'] === '已拒绝'): ?>
                        <li><a href="<?php echo base_url('vote_option/delete?ids='.$option['option_id']) ?>" target=_blank>删除</a></li>
                    <?php endif ?>

                    <?php //endif ?>
                </ul>
            </td>

        </tr>
        <?php endforeach ?>
        </tbody>
    </table>
    <hr>
    <?php endif ?>

	<dl id=list-record class=dl-horizontal>
		<dt>创建时间</dt>
		<dd>
			<?php echo date('Y-m-d H:i:s', $item['time_create']) ?>
			<a href="<?php echo base_url('stuff/detail?id='.$item['creator_id']) ?>" target=new>查看创建者</a>
		</dd>

		<?php if ( ! empty($item['time_delete']) ): ?>
		<dt>删除时间</dt>
		<dd><?php echo $item['time_delete'] ?></dd>
		<?php endif ?>

		<?php if ( ! empty($item['operator_id']) ): ?>
		<dt>最后操作时间</dt>
		<dd>
			<?php echo $item['time_edit'] ?>
			<a href="<?php echo base_url('stuff/detail?id='.$item['operator_id']) ?>" target=new>查看最后操作者</a>
		</dd>
		<?php endif ?>
	</dl>
	<?php endif ?>
</div>