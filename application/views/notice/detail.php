<link rel=stylesheet media=all href="/css/detail.css">
<style>
    #list-info {background-color:#fff;}
    #content {background-color:transparent;}

    .notice-item {margin-bottom:20px;}

    .notice-time {font-size:24px;color:#a6a6a6;text-align:center;height:24px;line-height:24px;margin:44px auto 16px;}
    .notice-content {background-color:#fff;border:1px solid #e9e9e9;border-radius:30px;padding:38px 38px 40px;overflow:hidden;}
    .notice-content h2 {font-size:30px;color:#3f3f3f;}
    .notice-body {overflow:hidden;margin-top:18px;}
    .notice-figure {float:left;width:100px;height:100px;border-radius:10px;}
    .notice-excerpt {font-size:26px;color:#a6a6a6;margin-top:18px;max-height:96px;line-height:48px;text-overflow:ellipsis;word-break:break-all;}
    .has-figure .notice-excerpt {padding-left:134px;max-height:80px;line-height:40px;}

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
		    <!--<ul id=item-actions class=list-unstyled>
				<li><a href="<?php /*echo base_url($this->class_name.'/revoke?id='.$item[$this->id_name]) */?>">撤回</a></li>
		    </ul>-->
			<?php endif ?>

	<dl id=list-info class=dl-horizontal>
		<dt><?php echo $this->class_name_cn ?>ID</dt>
		<dd><?php echo $item[$this->id_name] ?></dd>

		<dt>收信端类型</dt>
		<dd><?php echo $item['receiver_type'] ?></dd>

        <?php if ($item['receiver_type'] === 'client'): ?>
        <dt>收信用户</dt>
        <dd><?php echo 'ID '.$item['user_id'] ?></dd>
        <?php endif ?>

        <?php if ($item['receiver_type'] === 'biz'): ?>
        <dt>收信商家</dt>
        <dd><?php echo 'ID '.$item['biz_id'] ?></dd>
        <?php endif ?>

		<dt>标题</dt>
        <dd><?php echo empty($item['title'])? 'N/A': $item['title'] ?></dd>
		<dt>摘要</dt>
        <dd><?php echo empty($item['excerpt'])? 'N/A': $item['excerpt'] ?></dd>
        <dt>形象图</dt>
        <dd class=row>
            <?php
            $column_image = 'url_image';
            if ( empty($item[$column_image]) ):
                ?>
                <p>未上传</p>
            <?php else: ?>
                <figure class="col-xs-12 col-sm-6 col-md-4">
                    <img src="<?php echo $item[$column_image] ?>">
                </figure>
            <?php endif ?>
        </dd>

        <dt>相关文章</dt>
        <dd>
            <?php echo empty($item['article_id'])? 'N/A': 'ID '.$item['article_id'] ?>

            <?php if ( ! empty($item['article_id'])): ?>
                <a href="<?php echo base_url('article/detial?id='.$item['article_id']) ?>" target="_blank">查看</a>
            <?php endif ?>
        </dd>
	</dl>

    <div id=preview>
        <h2>预览</h2>

        <div class=notice-item>
            <div class=notice-time><?php echo date('Y-m-d H:i', $item['time_create']) ?></div>

            <?php $content_class = empty($item['url_image'])? 'notice-content': 'notice-content has-figure' ?>
            <div class="<?php echo $content_class ?>">
                <?php if ( ! empty($item['article_id'])): ?>
                <a href="<?php echo base_url('article/detail?id='.$item['article_id']) ?>">
                    <?php endif ?>

                    <h2><?php echo $item['title'] ?> [<?php echo $item[$this->id_name] ?>]</h2>
                    <div class="notice-body">
                        <?php if ( ! empty($item['url_image'])): ?>
                            <figure class="notice-figure centered_xy">
                                <img src="<?php echo $item['url_image'] ?>">
                            </figure>
                        <?php endif ?>

                        <?php if ( ! empty($item['excerpt'])): ?>
                            <p class=notice-excerpt><?php echo $item['excerpt'] ?></p>
                        <?php endif ?>
                    </div>

                    <?php if ( ! empty($item['article_id'])): ?>
                </a>
            <?php endif ?>
            </div>

        </div>
    </div>

	<dl id=list-record class=dl-horizontal>
		<dt>创建时间</dt>
		<dd>
			<?php echo date('Y-m-d H:i:s', $item['time_create']) ?>
			<a href="<?php echo base_url('stuff/detail?id='.$item['creator_id']) ?>" target=new>查看创建者</a>
		</dd>

        <?php if ( ! empty($item['time_revoke']) ): ?>
        <dt>撤回时间</dt>
        <dd><?php echo date('Y-m-d H:i:s', $item['time_revoke']) ?></dd>
        <?php endif ?>

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