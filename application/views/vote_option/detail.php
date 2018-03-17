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
			//if ( in_array($current_role, $role_allowed) && ($current_level >= $level_allowed) ):
			?>
		    <ul id=item-actions class=list-unstyled>
                <?php if ($item['status'] === '正常'): ?>
                    <li><a href="<?php echo base_url($this->class_name.'/create?vote_id='.$item['vote_id'].'&option_id='.$item['option_id']) ?>" target=_blank>投票</a></li>
                    <li><a href="<?php echo base_url('vote_ballot/create_multiple?vote_id='.$item['vote_id'].'&ids='.$item['option_id']) ?>" target=_blank>批量投票</a></li>
                    <li><a href="<?php echo base_url($this->class_name.'/delete?ids='.$item[$this->id_name]) ?>" target=_blank>删除</a></li>
                    <li><a href="<?php echo base_url($this->class_name.'/reject?ids='.$item[$this->id_name]) ?>" target=_blank>中止参选</a></li>
                <?php elseif ($item['status'] === '待审核'): ?>
                    <li><a href="<?php echo base_url($this->class_name.'/approve?ids='.$item[$this->id_name]) ?>" target=_blank>批准</a></li>
                    <li><a href="<?php echo base_url($this->class_name.'/reject?ids='.$item[$this->id_name]) ?>" target=_blank>拒绝</a></li>
                <?php elseif ($item['status'] === '已拒绝'): ?>
                <li><a href="<?php echo base_url($this->class_name.'/delete?ids='.$item[$this->id_name]) ?>" target=_blank>删除</a></li>
                <?php endif ?>

                <li><a href="<?php echo base_url($this->class_name.'/edit?id='.$item[$this->id_name]) ?>" target=_blank>编辑</a></li>
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

		<dt>所属投票ID</dt>
		<dd>
            <?php echo $item['vote_id'] ?>
            <a href="<?php echo base_url('vote/detail?id='.$item['vote_id']) ?>">查看活动</a>
        </dd>

        <dt>所属标签ID</dt>
        <dd>
            <?php echo $item['tag_id'] ?>
            <a href="<?php echo base_url('vote_tag/detail?id='.$item['tag_id']) ?>">查看标签</a>
        </dd>

        <dt>总选票数</dt>
        <dd><?php echo $item['ballot_overall'] ?> 票</dd>

		<dt>名称</dt>
		<dd><?php echo $item['name'] ?></dd>
		<dt>描述</dt>
		<dd>
            <p><?php echo $item['description'] ?></p>
        </dd>

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

        <?php if ( ! empty($item['mobile'])): ?>
        <dt>审核联系手机号</dt>
        <dd>
            <a class="btn btn-default" href="tel:+86<?php echo $item['mobile'] ?>"><i class="far fa-mobile"></i><?php echo $item['mobile'] ?></a>
        </dd>
        <?php endif ?>
	</dl>

	<dl id=list-record class=dl-horizontal>
		<dt>创建时间</dt>
		<dd>
			<?php echo $item['time_create'] ?>
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