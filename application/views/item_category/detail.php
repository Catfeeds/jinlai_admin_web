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
		    <ul id=item-actions class=list-unstyled>
                <?php if ($item['level'] < 3): ?>
                <li><a href="<?php echo base_url('item_category/index?parent_id='.$item[$this->id_name]) ?>">子分类</a></li>
                <?php endif ?>

				<li><a title="编辑" href="<?php echo base_url($this->class_name.'/edit?id='.$item[$this->id_name]) ?>">编辑</a></li>
		    </ul>
			<?php endif ?>

	<dl id=list-info class=dl-horizontal>
		<dt><?php echo $this->class_name_cn ?>ID</dt>
		<dd><?php echo $item[$this->id_name] ?></dd>

        <dt>商品性质</dt>
        <dd><?php echo $item['nature'] ?></dd>

        <dt>分类级别</dt>
        <dd><?php echo $item['level'] ?></dd>
		
		<?php if ($item['level'] > 1): ?>
        <dt>所属顶级分类ID</dt>
        <dd>
            ID<?php echo $item['ancestor_id'] ?>
            <a href="<?php echo base_url('item_category/detail?id='.$item['ancestor_id']) ?>">查看</a>
        </dd>

        <dt>所属上级分类ID</dt>
		<dd>
            ID<?php echo $item['parent_id'] ?>
            <a href="<?php echo base_url('item_category/detail?id='.$item['parent_id']) ?>">查看</a>
        </dd>
        <?php endif ?>
		
		<dt>名称</dt>
		<dd><?php echo $item['name'] ?></dd>
		
		<dt>描述</dt>
		<dd><?php echo empty($item['description'])? 'N/A': $item['description'] ?></dd>
		
		<dt>自定义域名</dt>
		<dd><?php echo empty($item['url_name'])? 'N/A': $item['url_name'] ?></dd>
		
		<dt>形象图</dt>
		<dd class=row>
			<?php
				$column_image = 'url_image';
				if ( empty($item[$column_image]) ):
			?>
			N/A
			<?php else: ?>
			<figure class="col-xs-12 col-sm-6 col-md-4">
				<img src="<?php echo $item[$column_image] ?>">
			</figure>
			<?php endif ?>
		</dd>

        <dt>列表页形象图</dt>
        <dd class=row>
            <?php
                $column_name = 'url_image_index';
                if ( !empty($item[$column_name]) ):
            ?>
                <ul class=row>
                <?php
                $slides = explode(',', $item[$column_name]);
                foreach($slides as $slide):
                    ?>
                    <li class="col-xs-12 col-sm-6 col-md-4">
                        <figure>
                            <img src="<?php echo $slide ?>">
                        </figure>
                    </li>
                <?php endforeach ?>
                </ul>
            <?php else: ?>
                N/A
            <?php endif ?>
        </dd>

        <dt>详情页形象图</dt>
        <dd class=row>
            <?php
            $column_name = 'url_image_detail';
            if ( !empty($item[$column_name]) ):
                ?>
                <ul class=row>
                    <?php
                    $slides = explode(',', $item[$column_name]);
                    foreach($slides as $slide):
                        ?>
                        <li class="col-xs-12 col-sm-6 col-md-4">
                            <figure>
                                <img src="<?php echo $slide ?>">
                            </figure>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php else: ?>
                N/A
            <?php endif ?>
        </dd>
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