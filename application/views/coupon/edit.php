<link rel=stylesheet media=all href="/css/edit.css">
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
<script defer src="/js/edit.js"></script>

<base href="<?php echo $this->media_root ?>">

<div id=breadcrumb>
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url() ?>">首页</a></li>
		<li><a href="<?php echo base_url($this->class_name) ?>"><?php echo $this->class_name_cn ?></a></li>
		<li class=active><?php echo $title ?></li>
	</ol>
</div>

<div id=content class=container>
	<?php
		if ( !empty($error) ) echo '<div class="alert alert-warning" role=alert>'.$error.'</div>';
		$attributes = array('class' => 'form-'.$this->class_name.'-edit form-horizontal', 'role' => 'form');
		echo form_open_multipart($this->class_name.'/edit?id='.$item[$this->id_name], $attributes);
	?>
		<p class=help-block>必填项以“※”符号标示</p>

		<fieldset>
			<legend>基本信息</legend>

			<input name=id type=hidden value="<?php echo $item[$this->id_name] ?>">

			<div class=form-group>
				<label for=coupon_id class="col-sm-2 control-label">优惠券ID</label>
				<div class=col-sm-10>
					<input class=form-control name=coupon_id type=text value="<?php echo $item['coupon_id'] ?>" placeholder="优惠券ID" required>
				</div>
			</div>
			<div class=form-group>
				<label for=user_id class="col-sm-2 control-label">所属用户ID</label>
				<div class=col-sm-10>
					<input class=form-control name=user_id type=text value="<?php echo $item['user_id'] ?>" placeholder="所属用户ID" required>
				</div>
			</div>
			<div class=form-group>
				<label for=template_id class="col-sm-2 control-label">所属优惠券模板ID</label>
				<div class=col-sm-10>
					<input class=form-control name=template_id type=text value="<?php echo $item['template_id'] ?>" placeholder="所属优惠券模板ID" required>
				</div>
			</div>
			<div class=form-group>
				<label for=category_id class="col-sm-2 control-label">限定系统分类ID</label>
				<div class=col-sm-10>
					<input class=form-control name=category_id type=text value="<?php echo $item['category_id'] ?>" placeholder="限定系统分类ID" required>
				</div>
			</div>
			<div class=form-group>
				<label for=biz_id class="col-sm-2 control-label">所属/限定商家ID</label>
				<div class=col-sm-10>
					<input class=form-control name=biz_id type=text value="<?php echo $item['biz_id'] ?>" placeholder="所属/限定商家ID" required>
				</div>
			</div>
			<div class=form-group>
				<label for=category_biz_id class="col-sm-2 control-label">限定商家分类ID</label>
				<div class=col-sm-10>
					<input class=form-control name=category_biz_id type=text value="<?php echo $item['category_biz_id'] ?>" placeholder="限定商家分类ID" required>
				</div>
			</div>
			<div class=form-group>
				<label for=item_id class="col-sm-2 control-label">限定商品ID</label>
				<div class=col-sm-10>
					<input class=form-control name=item_id type=text value="<?php echo $item['item_id'] ?>" placeholder="限定商品ID" required>
				</div>
			</div>
			<div class=form-group>
				<label for=name class="col-sm-2 control-label">名称</label>
				<div class=col-sm-10>
					<input class=form-control name=name type=text value="<?php echo $item['name'] ?>" placeholder="名称" required>
				</div>
			</div>
			<div class=form-group>
				<label for=description class="col-sm-2 control-label">说明</label>
				<div class=col-sm-10>
					<input class=form-control name=description type=text value="<?php echo $item['description'] ?>" placeholder="说明" required>
				</div>
			</div>
			<div class=form-group>
				<label for=amount class="col-sm-2 control-label">面额（元）</label>
				<div class=col-sm-10>
					<input class=form-control name=amount type=text value="<?php echo $item['amount'] ?>" placeholder="面额（元）" required>
				</div>
			</div>
			<div class=form-group>
				<label for=min_subtotal class="col-sm-2 control-label">最低订单小计（元）</label>
				<div class=col-sm-10>
					<input class=form-control name=min_subtotal type=text value="<?php echo $item['min_subtotal'] ?>" placeholder="最低订单小计（元）" required>
				</div>
			</div>
			<div class=form-group>
				<label for=time_start class="col-sm-2 control-label">开始时间</label>
				<div class=col-sm-10>
					<input class=form-control name=time_start type=text value="<?php echo $item['time_start'] ?>" placeholder="开始时间" required>
				</div>
			</div>
			<div class=form-group>
				<label for=time_end class="col-sm-2 control-label">结束时间</label>
				<div class=col-sm-10>
					<input class=form-control name=time_end type=text value="<?php echo $item['time_end'] ?>" placeholder="结束时间" required>
				</div>
			</div>
			<div class=form-group>
				<label for=time_expire class="col-sm-2 control-label">失效时间</label>
				<div class=col-sm-10>
					<input class=form-control name=time_expire type=text value="<?php echo $item['time_expire'] ?>" placeholder="失效时间" required>
				</div>
			</div>
			<div class=form-group>
				<label for=order_id class="col-sm-2 control-label">所属订单ID</label>
				<div class=col-sm-10>
					<input class=form-control name=order_id type=text value="<?php echo $item['order_id'] ?>" placeholder="所属订单ID" required>
				</div>
			</div>
			<div class=form-group>
				<label for=time_used class="col-sm-2 control-label">使用时间</label>
				<div class=col-sm-10>
					<input class=form-control name=time_used type=text value="<?php echo $item['time_used'] ?>" placeholder="使用时间" required>
				</div>
			</div>
			<div class=form-group>
				<label for=time_create class="col-sm-2 control-label">创建时间</label>
				<div class=col-sm-10>
					<input class=form-control name=time_create type=text value="<?php echo $item['time_create'] ?>" placeholder="创建时间" required>
				</div>
			</div>
			<div class=form-group>
				<label for=time_delete class="col-sm-2 control-label">删除时间</label>
				<div class=col-sm-10>
					<input class=form-control name=time_delete type=text value="<?php echo $item['time_delete'] ?>" placeholder="删除时间" required>
				</div>
			</div>
			<div class=form-group>
				<label for=status class="col-sm-2 control-label">状态</label>
				<div class=col-sm-10>
					<input class=form-control name=status type=text value="<?php echo $item['status'] ?>" placeholder="状态" required>
				</div>
			</div>

		</fieldset>

		<div class=form-group>
		    <div class="col-xs-12 col-sm-offset-2 col-sm-2">
				<button class="btn btn-primary btn-lg btn-block" type=submit>确定</button>
		    </div>
		</div>
	</form>

</div>