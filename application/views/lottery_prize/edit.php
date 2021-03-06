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
			<legend>常用字段类型</legend>
			
			<div class=form-group>
				<label for=url_image_main class="col-sm-2 control-label">主图</label>
				<div class=col-sm-10>
                    <?php
                    require_once(APPPATH. 'views/templates/file-uploader.php');
                    $name_to_upload = 'url_image_main';
                    generate_html($name_to_upload, $this->class_name, TRUE, 1, $item[$name_to_upload]);
                    ?>
				</div>
			</div>

			<div class=form-group>
				<label for=figure_image_urls class="col-sm-2 control-label">形象图</label>
				<div class=col-sm-10>
                    <?php
                    require_once(APPPATH. 'views/templates/file-uploader.php');
                    $name_to_upload = 'figure_image_urls';
                    generate_html($name_to_upload, $this->class_name, FALSE, 4, $item[$name_to_upload]);
                    ?>
				</div>
			</div>
			
			<div class=form-group>
				<label for=description class="col-sm-2 control-label">详情</label>
				<div class=col-sm-10>
                    <textarea class=form-control name=description rows=5 placeholder="详情" required><?php echo empty(set_value('description'))? $item['description']: set_value('description') ?></textarea>
				</div>
			</div>
			
			<div class=form-group>
				<?php $input_name = 'delivery' ?>
				<label for="<?php echo $input_name ?>" class="col-sm-2 control-label">库存状态</label>
				<div class=col-sm-10>
					<select class=form-control name="<?php echo $input_name ?>" required>
						<?php
							$options = array('现货','期货');
							foreach ($options as $option):
						?>
						<option value="<?php echo $option ?>" <?php if ($option === $item[$input_name]) echo 'selected'; ?>><?php echo $option ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			
            <div class=form-group>
				<?php $input_name = 'home_m1_ace_id' ?>
                <label for="<?php echo $input_name ?>" class="col-sm-2 control-label">模块一首推商品</label>
                <div class=col-sm-10>
                    <select class=form-control name="<?php echo $input_name ?>">
                        <?php
                        $options = $comodities;
                        foreach ($options as $option):
                            if ( empty($option['time_delete']) ):
                                ?>
                                <option value="<?php echo $option['item_id'] ?>" <?php if ($option['item_id'] === $item[$input_name]) echo 'selected'; ?>><?php echo $option['name'] ?></option>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </select>

                    <p class=help-block>点击形象图后跳转到的商品，下同</p>
                </div>
            </div>

            <div class=form-group>
                <?php $input_name = 'home_m1_ids' ?>
                <label for=<?php echo $input_name.'[]' ?> class="col-sm-2 control-label">模块一陈列商品</label>
                <div class=col-sm-10>
                    <select class=form-control name="<?php echo $input_name.'[]' ?>" multiple>
                        <?php
                        $options = $comodities;
                        $current_array = explode(',', $item[$input_name]);
                        foreach ($options as $option):
                            if ( empty($option['time_delete']) ):
                                ?>
                                <option value="<?php echo $option['item_id'] ?>" <?php if ( in_array($option['item_id'], $current_array) ) echo 'selected'; ?>><?php echo $option['name'] ?></option>
                                <?php
                            endif;
                        endforeach;
                        ?>
                    </select>

                    <p class=help-block>需要进行展示的1-3款商品，下同；桌面端按住Ctrl（Windows）或⌘（Mac）可多选；如果选择了3款以上，将仅示前3款</p>
                </div>
            </div>

			<div class=form-group>
				<label for=private class="col-sm-2 control-label">需登录</label>
				<div class=col-sm-10>
					<label class=radio-inline>
						<input type=radio name=private value="是" required <?php if ($item['private'] === '1') echo 'checked'; ?>> 是
					</label>
					<label class=radio-inline>
						<input type=radio name=private value="否" required <?php if ($item['private'] === '0') echo 'checked'; ?>> 否
					</label>
				</div>
			</div>
		</fieldset>

		<fieldset>
			<legend>基本信息</legend>

			<input name=id type=hidden value="<?php echo $item[$this->id_name] ?>">

            <div class=form-group>
                <label for=index_id class="col-sm-2 control-label">索引序号 ※</label>
                <div class=col-sm-10>
                    <input class=form-control name=index_id type=text value="<?php echo empty(set_value('index_id'))? $item['index_id']: set_value('index_id') ?>" placeholder="索引序号" required>
                </div>
            </div>
            <div class=form-group>
                <label for=name class="col-sm-2 control-label">名称</label>
                <div class=col-sm-10>
                    <input class=form-control name=name type=text value="<?php echo empty(set_value('name'))? $item['name']: set_value('name') ?>" placeholder="名称">
                </div>
            </div>
            <div class=form-group>
                <label for=description class="col-sm-2 control-label">描述 ※</label>
                <div class=col-sm-10>
                    <input class=form-control name=description type=text value="<?php echo empty(set_value('description'))? $item['description']: set_value('description') ?>" placeholder="描述" required>
                </div>
            </div>
            <div class=form-group>
                <label for=url_image class="col-sm-2 control-label">形象图 ※</label>
                <div class=col-sm-10>
                    <input class=form-control name=url_image type=text value="<?php echo empty(set_value('url_image'))? $item['url_image']: set_value('url_image') ?>" placeholder="形象图URL" required>
                </div>
            </div>
            <div class=form-group>
                <label for=rate class="col-sm-2 control-label">中奖率 ※</label>
                <div class=col-sm-10>
                    <input class=form-control name=rate type=text value="<?php echo empty(set_value('rate'))? $item['rate']: set_value('rate') ?>" placeholder="中奖率" required>
                </div>
            </div>
            <div class=form-group>
                <label for=stocks class="col-sm-2 control-label">奖品总数 ※</label>
                <div class=col-sm-10>
                    <input class=form-control name=stock type=text value="<?php echo empty(set_value('stocks'))? $item['stocks']: set_value('stocks') ?>" placeholder="奖品总数" required>
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