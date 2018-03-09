<link rel=stylesheet media=all href="/css/detail.css">
<style>


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
			if ( in_array($current_role, $role_allowed) && ($current_level >= $level_allowed) ):
			?>
		    <!--
                <ul id=item-actions class=list-unstyled>
				<li><a title="编辑" href="<?php echo base_url($this->class_name.'/edit?id='.$item[$this->id_name]) ?>">编辑</a></li>
		    </ul>
		    -->
			<?php endif ?>
            <ul id=item-actions class=list-unstyled>
                <li><a title="候选项标签列表" href="<?php echo base_url('vote_tag') ?>">候选项标签</a></li>
                <li><a title="创建候选项标签" href="<?php echo base_url('vote_tag/create?vote_id='.$item[$this->id_name]) ?>">创建候选项标签</a></li>
                <li><a title="候选项列表" href="<?php echo base_url('vote_option') ?>">候选项</a></li>
                <li><a title="创建候选项" href="<?php echo base_url('vote_option/create?vote_id='.$item[$this->id_name]) ?>">创建候选项</a></li>
            </ul>

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
            <figure class="qrcode col-xs-12 col-sm-6 col-md-3" data-qrcode-string="<?php echo $item_url ?>"></figure>
        </dd>

		<dt>名称</dt>
		<dd><?php echo $item['name'] ?></dd>
		<dt>描述</dt>
		<dd><?php echo $item['description'] ?></dd>

        <dt>形象图</dt>
        <dd class=row>
            <?php
            $column_image = 'url_image';
            if ( empty($item[$column_image]) ):
                ?>
                <p>未上传</p>
            <?php else: ?>
                <figure id=vote-url_image class=vote-figure>
                    <img src="<?php echo $item[$column_image] ?>">
                </figure>
            <?php endif ?>
        </dd>

        <dt>形象视频</dt>
        <dd class=row>
            <?php
            if ( empty($item['url_video']) ):
                ?>
                <p>未上传</p>
            <?php else: ?>
                <figure id=url_video class=vote-figure>
                    <video controls alt="<?php echo $item['name'] ?>形象视频" poster="<?php echo $item['url_video_thumb'] ?>" src="<?php echo $item['url_video'] ?>">您的浏览器不支持视频播放</video>
                </figure>
            <?php endif ?>
        </dd>

        <dt>背景音乐</dt>
        <dd class=row>
            <?php
            $column_image = 'url_audio';
            if ( empty($item[$column_image]) ):
                ?>
                <p>未上传</p>
            <?php else: ?>
                <audio controls src="<?php echo $item[$column_image] ?>">
            <?php endif ?>
        </dd>

		<dt>URL名称</dt>
		<dd><?php echo $item['url_name'] ?></dd>
		<dt>可报名</dt>
		<dd><?php echo $item['signup_allowed'] ?></dd>

		<dt>每选民最高总选票数</dt>
		<dd><?php echo ($item['max_user_total'] == 0)? '不限': $item['max_user_total'].'票' ?></dd>
		<dt>每选民最高日选票数</dt>
		<dd><?php echo $item['max_user_daily'] ?>票</dd>
		<dt>每选民同选项最高日选票数</dt>
        <dd><?php echo $item['max_user_daily_each'] ?>票</dd>

		<dt>起止时间</dt>
		<dd>
            <?php echo date('Y-m-d H:i:s', $item['time_start']) ?> - <?php echo date('Y-m-d H:i:s', $item['time_end']) ?>
        </dd>
	</dl>

    <style>
        #list-options td {height:30px;overflow:hidden;}
    </style>

    <?php if (empty($options)): ?>
    <p>暂无有效候选项。</p>

    <?php else: ?>
    <table id=list-options>
        <tr>
            <th>形象图</th><th>候选项ID</th><th>名称</th><th>目前选票</th><!--<th>操作</th>-->
        </tr>

        <?php foreach ($options as $option): ?>
        <tr>

            <td>
                <figure class="option-image">
                    <img src="<?php echo MEDIA_URL.'vote_option/'.$option['url_image'] ?>">
                </figure>
            </td>
            <td>#<?php echo $option['option_id'] ?> </td>
            <td><?php echo $option['name'] ?></td>
            <td class="option-brief"><?php echo $option['ballot_count'] ?></td>

            <!--
            <td class="option-actions">
                <a class=option-detail href="<?php echo base_url('vote_option/detail?id='.$item['vote_id']) ?>">查看</a>
                <a class=option-create href="<?php echo base_url('vote_ballot/create?vote_id='.$item['vote_id'].'&option_id='.$option['option_id']) ?>">投票</a>
            </td>
            -->

        </tr>
        <?php endforeach ?>
    </table>
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