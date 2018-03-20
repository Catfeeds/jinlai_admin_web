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

<base href="<?php echo $this->media_root ?>">

<div id=breadcrumb>
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url() ?>">首页</a></li>
		<li><a href="<?php echo base_url($this->class_name) ?>"><?php echo $this->class_name_cn ?></a></li>
		<li class=active><?php echo $title ?></li>
	</ol>
</div>

<div id=content class=container>
	<table class="table table-striped table-condensed table-responsive">
		<thead>
			<tr>
				<?php
					$thead = array_values($data_to_display);
					foreach ($thead as $th):
						echo '<th>' .$th. '</th>';
					endforeach;
				?>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($items as $item): ?>
			<tr>
				<?php
					$tr = array_keys($data_to_display);
					foreach ($tr as $td):
						echo '<td>' .$item[$td]. '</td>';
					endforeach;
				?>
			</tr>
			<?php endforeach ?>
		</tbody>
	</table>

	<div class="alert alert-warning" role=alert>
		<p>确定要<?php echo $title ?>？系统将会为上述每个候选项创建投票数量上下限之间随机数量的选票；候选项数量较多或待投票数较多时，系统需要较长时间处理，页面可能无法成功刷新，请稍候进入相关候选项页面查看即可。</p>
	</div>

	<?php
		if ( !empty($error) ) echo '<div class="alert alert-warning" role=alert>'.$error.'</div>';
		$attributes = array('class' => 'form-'.$this->class_name.'-'.$op_name.' form-horizontal', 'role' => 'form');
		echo form_open($this->class_name.'/'.$op_name, $attributes);
	?>
		<fieldset>
			<input name=ids type=hidden value="<?php echo $ids ?>">

            <input name=vote_id type=hidden value="<?php echo $vote_id ?>">

            <div class=form-group>
                <label for=amount_min class="col-sm-2 control-label">投票数量下限</label>
                <div class=col-sm-10>
                    <input class=form-control name=amount_min type=number min=10 step=1 max=1000 value="<?php echo set_value('amount_min') ?>" placeholder="最少需要增加多少选票，10 - 1000之间" required>
                </div>
            </div>

            <div class=form-group>
                <label for=amount_max class="col-sm-2 control-label">投票数量上限</label>
                <div class=col-sm-10>
                    <input class=form-control name=amount_max type=number min=10 step=1 max=1000 value="<?php echo set_value('amount_max') ?>" placeholder="最多需要增加多少选票，10 - 1000之间，不可低于投票数量下限" required>
                </div>
            </div>

            <div class=form-group>
                <label for=password class="col-sm-2 control-label">密码</label>
                <div class=col-sm-10>
                    <input class=form-control name=password type=password placeholder="请输入您的登录密码" autofocus required>
                </div>
            </div>
		</fieldset>

		<div class=form-group>
		    <div class="col-xs-12 col-sm-offset-2 col-sm-2">
				<button class="btn btn-danger btn-lg btn-block" type=submit>批量创建选票</button>
		    </div>
		</div>

	</form>

</div>