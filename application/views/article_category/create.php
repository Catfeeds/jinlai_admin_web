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
                <label for=parent_id class="col-sm-2 control-label">所属分类</label>
                <div class="col-sm-10 input-group">
                    <?php $input_name = 'parent_id' ?>
                    <select class=form-control name="<?php echo $input_name ?>">
                        <option value="">可选择</option>
                        <?php
                        if ( !empty($categories) ):
                            $options = $categories;
                            foreach ($options as $option):
                                ?>
                                <option value="<?php echo $option['category_id'] ?>" <?php echo set_select($input_name, $option['category_id']) ?>><?php echo $option['name'] ?></option>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </select>

                    <div class="input-group-addon">
                        <a href="<?php echo base_url('article_category') ?>">管理</a>
                    </div>
                </div>
            </div>

            <div class=form-group>
                <label for=name class="col-sm-2 control-label">名称</label>
                <div class=col-sm-10>
                    <input class=form-control name=name type=text value="<?php echo set_value('name') ?>" placeholder="名称" required>
                </div>
            </div>

            <div class=form-group>
                <label for=url_name class="col-sm-2 control-label">自定义域名</label>
                <div class=col-sm-10>
                    <input class=form-control name=url_name type=text value="<?php echo set_value('url_name') ?>" placeholder="自定义域名">
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