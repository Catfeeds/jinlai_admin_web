<link rel=stylesheet media=all href="/css/index.css">
<style>
    td {text-align:left;}

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

<script defer src="/js/index.js"></script>

<base href="<?php echo $this->media_root ?>">

<div id=breadcrumb>
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url() ?>">首页</a></li>
		<li class=active><?php echo $this->class_name_cn ?></li>
	</ol>
</div>

<div id=content class=container>
    <div class="btn-group btn-group-justified" role=group>
        <a class="btn btn-primary" title="所有<?php echo $this->class_name_cn ?>" href="<?php echo base_url($this->class_name) ?>">所有</a>
        <?php
        // 需要特定角色和权限进行该操作
        $current_role = $this->session->role; // 当前用户角色
        $current_level = $this->session->level; // 当前用户级别
        $role_allowed = array('管理员', '经理');
        $level_allowed = 30;
        if ( in_array($current_role, $role_allowed) && ($current_level >= $level_allowed) ):
            ?>
            <a class="btn btn-default" title="<?php echo $this->class_name_cn ?>回收站" href="<?php echo base_url($this->class_name.'/trash') ?>">回收站</a>
            <a class="btn btn-default" title="创建<?php echo $this->class_name_cn ?>" href="<?php echo base_url($this->class_name.'/create') ?>">创建</a>
        <?php endif ?>
    </div>

	<?php if ( empty($items) ): ?>
	<blockquote>
		<p>这里空空如也，快点添加<?php echo $this->class_name_cn ?>吧</p>
	</blockquote>

	<?php else: ?>
	<form method=get target=_blank>

		<table id=item-list class="table table-condensed table-hover table-responsive table-striped">
			<thead>
				<tr>
                    <th><?php echo $this->class_name_cn ?>ID</th><th>名称</th><th>内容</th><th>操作</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($items as $item): ?>
				<tr>
					<td><?php echo $item[$this->id_name] ?></td>
				    <td>
                        <?php echo $item['name'] ?>
                        <br><?php echo $item['description'] ?>
                    </td>
				    <td><?php echo $item['value'] ?></td>
					<td>
                        <ul class=list-unstyled>
                            <?php
                            // 需要特定角色和权限进行该操作
                            if ( in_array($current_role, $role_allowed) && ($current_level >= $level_allowed) ):
                                ?>
                            <li><a href="<?php echo base_url($this->class_name.'/delete?ids='.$item[$this->id_name]) ?>" target=_blank>删除</a></li>
                            <li><a href="<?php echo base_url($this->class_name.'/edit?id='.$item[$this->id_name]) ?>" target=_blank>编辑</a></li>
                            <?php endif ?>
                        </ul>
					</td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>

	</form>
	<?php endif ?>
</div>