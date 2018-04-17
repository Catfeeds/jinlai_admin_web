<link rel=stylesheet media=all href="/css/create.css">
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

<script defer src="/js/create.js"></script>

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
		$attributes = array('class' => 'form-'.$this->class_name.'-create form-horizontal', 'role' => 'form');
		echo form_open_multipart($this->class_name.'/create', $attributes);
	?>
		<p class=help-block>必填项以“※”符号标示</p>

		<fieldset>
			<div class=form-group>
				<label for=nation class="col-sm-2 control-label">国别</label>
				<div class=col-sm-10>
                    <p class="form-control-static">中国</p>
					<!--<input class=form-control name=nation type=text value="<?php echo set_value('nation') ?>" placeholder="例如：中国" required>-->
				</div>
			</div>
        </fieldset>

        <fieldset>
            <legend>省级行政区</legend>
			<div class=form-group>
				<label for=province class="col-sm-2 control-label">全称</label>
				<div class=col-sm-10>
					<input class=form-control name=province type=text value="<?php echo set_value('province') ?>" placeholder="例如：北京市、山东省、新疆维吾尔自治区等" required>
				</div>
			</div>
            <div class=form-group>
                <label for=province_abbr class="col-sm-2 control-label">简称</label>
                <div class=col-sm-10>
                    <input class=form-control name=province_abbr type=text value="<?php echo set_value('province_abbr') ?>" placeholder="例如：京、鲁、新等" required>
                </div>
            </div>
            <div class=form-group>
                <label for=province_brief class="col-sm-2 control-label">通称</label>
                <div class=col-sm-10>
                    <input class=form-control name=province_brief type=text value="<?php echo set_value('province_brief') ?>" placeholder="例如：北京、山东、新疆等" required>
                </div>
            </div>
			<div class=form-group>
				<label for=province_index class="col-sm-2 control-label">索引</label>
				<div class=col-sm-10>
					<input class=form-control name=province_index type=text value="<?php echo set_value('province_index') ?>" placeholder="例如：bj、sd、xj等" required>
                    <p class="help-block">通称前2-3个词或字的发音/拼音首字母</p>
				</div>
			</div>
        </fieldset>

        <fieldset>
			<div class=form-group>
				<label for=city class="col-sm-2 control-label">市级行政区</label>
				<div class=col-sm-10>
					<input class=form-control name=city type=text value="<?php echo set_value('city') ?>" placeholder="例如：青岛市" required>
				</div>
			</div>
			<div class=form-group>
				<label for=county class="col-sm-2 control-label">区县级行政区</label>
				<div class=col-sm-10>
					<input class=form-control name=county type=text value="<?php echo set_value('county') ?>" placeholder="例如：崂山区" required>
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