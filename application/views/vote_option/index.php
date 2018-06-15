<link rel=stylesheet media=all href="/css/index.css">
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

<script defer src="/js/index.js"></script>

<?php
    // 通用URL参数
    $common_params = '?vote_id='.$vote_id;
?>
<base href="<?php echo $this->media_root ?>">

<div id=breadcrumb>
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url() ?>">首页</a></li>
		<li class=active><?php echo $this->class_name_cn ?></li>
	</ol>
</div>

<div id=content class=container>
	<?php
	// 需要特定角色和权限进行该操作
	$current_role = $this->session->role; // 当前用户角色
	$current_level = $this->session->level; // 当前用户级别
	$role_allowed = array('管理员', '经理');
	$level_allowed = 30;

	if ( in_array($current_role, $role_allowed) && ($current_level >= $level_allowed) ):
	?>
	<div class="btn-group btn-group-justified" role=group>
		<a class="btn btn-primary" title="所有<?php echo $this->class_name_cn ?>" href="<?php echo base_url($this->class_name.'?vote_id='.$vote_id) ?>">所有</a>
	  	<a class="btn btn-default" title="<?php echo $this->class_name_cn ?>回收站" href="<?php echo base_url($this->class_name.'/trash?vote_id='.$vote_id) ?>">回收站</a>
		<a class="btn btn-default" title="创建<?php echo $this->class_name_cn ?>" href="<?php echo base_url($this->class_name.'/create'.$common_params) ?>">创建</a>
	</div>
	
    <div id=primary_actions class=action_bottom>
        <?php if (count($items) > 1): ?>
        <span id=enter_bulk>
            <i class="far fa-circle" aria-hidden=true></i>批量
        </span>
        <?php endif ?>

        <ul class=horizontal>
            <li>
                <a class=bg_primary title="创建<?php echo $this->class_name_cn ?>" href="<?php echo base_url($this->class_name.'/create'.$common_params) ?>">创建</a>
            </li>
        </ul>
    </div>
	<?php endif ?>

	<?php if ( empty($items) ): ?>
	<blockquote>
		<p>这里空空如也，快点添加<?php echo $this->class_name_cn ?>吧</p>
	</blockquote>

	<?php else: ?>
	<form method=get target=_blank>
        <?php if (count($items) > 1): ?>
        <div id=bulk_action class=action_bottom>
            <span id=bulk_selector data-bulk-selector=off>
                <i class="far fa-check-circle" aria-hidden=true></i>全选
            </span>
            <span id=exit_bulk>取消</span>
            <ul class=horizontal>
                <li>
                    <input name=vote_id type=hidden value="<?php echo $vote['vote_id'] ?>">
                    <button class=bg_second formaction="<?php echo base_url('vote_ballot/create_multiple') ?>" type=submit>批量投票</button>
                </li>
                <li>
                    <button class=bg_primary formaction="<?php echo base_url($this->class_name.'/delete') ?>" type=submit>删除</button>
                </li>
            </ul>
        </div>
        <?php endif ?>

        <ul id=item-list class=row>
            <?php foreach ($items as $item): ?>
            <li>
                <a href="<?php echo base_url($this->class_name.'/detail?id='.$item[$this->id_name]) ?>">
                    <p><?php echo $this->class_name_cn ?>ID <?php echo $item[$this->id_name] ?></p>
                    <p><?php echo $item['name'] ?></p>
                    <p>标签ID <?php echo $item['tag_id'] ?></p>
                    <p>索引序号 <?php echo $item['index_id'] ?></p>
                    <p><?php echo $item['ballot_overall'] ?> 票</p>
                </a>

                <div class=item-actions>
		            <span>
		                <input name=ids[] class=form-control type=checkbox value="<?php echo $item[$this->id_name] ?>">
		            </span>

                    <ul class=horizontal>
                        <?php
                        // 需要特定角色和权限进行该操作
                        //if ( in_array($current_role, $role_allowed) && ($current_level >= $level_allowed) ):
                            ?>
                        <li><a href="<?php echo base_url($this->class_name.'/edit?id='.$item[$this->id_name]) ?>" target=_blank>编辑</a></li>

                        <?php if ($item['status'] === '正常'): ?>
                        <li><a href="<?php echo base_url($this->class_name.'/create?vote_id='.$item['vote_id'].'&option_id='.$item['option_id']) ?>" target=_blank>投1张票</a></li>
                        <li><a href="<?php echo base_url('vote_ballot/create_multiple?vote_id='.$item['vote_id'].'&ids='.$item['option_id']) ?>" target=_blank>投多张票</a></li>
                        <li><a href="<?php echo base_url($this->class_name.'/delete?ids='.$item[$this->id_name]) ?>" target=_blank>删除</a></li>
                        <li><a href="<?php echo base_url($this->class_name.'/reject?ids='.$item[$this->id_name]) ?>" target=_blank>中止参选</a></li>
                        <?php elseif ($item['status'] === '待审核'): ?>
                        <li><a href="<?php echo base_url($this->class_name.'/approve?ids='.$item[$this->id_name]) ?>" target=_blank>批准</a></li>
                        <li><a href="<?php echo base_url($this->class_name.'/reject?ids='.$item[$this->id_name]) ?>" target=_blank>拒绝</a></li>
                        <?php elseif ($item['status'] === '已拒绝'): ?>
                        <li><a href="<?php echo base_url($this->class_name.'/delete?ids='.$item[$this->id_name]) ?>" target=_blank>删除</a></li>
                        <?php endif ?>

                        <?php //endif ?>
                    </ul>
                </div>

            </li>
            <?php endforeach ?>
        </ul>

	</form>
	<?php endif ?>
</div>