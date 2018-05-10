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
                <?php $input_name = 'receiver_type' ?>
                <label for="<?php echo $input_name ?>" class="col-sm-2 control-label">收信端类型</label>
                <div class=col-sm-10>
                    <select class=form-control name="<?php echo $input_name ?>" required>
                        <option value="" <?php echo set_select($input_name, '') ?>>请选择</option>
                        <?php
                        $options = array('admin','biz','client');
                        foreach ($options as $option):
                            ?>
                            <option value="<?php echo $option ?>" <?php echo set_select($input_name, $option) ?>><?php echo $option ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

			<div class=form-group>
				<label for=user_id class="col-sm-2 control-label">收信用户ID</label>
				<div class=col-sm-10>
					<input class=form-control name=user_id type=text value="<?php echo set_value('user_id') ?>" placeholder="用户ID">
				</div>
			</div>
			<div class=form-group>
				<label for=biz_id class="col-sm-2 control-label">收信商家ID</label>
				<div class=col-sm-10>
					<input class=form-control name=biz_id type=text value="<?php echo set_value('biz_id') ?>" placeholder="商家ID">
				</div>
			</div>
        </fieldset>

        <fieldset>
            <legend>通知内容</legend>

            <div class=form-group>
                <label for=article_id class="col-sm-2 control-label">相关文章</label>
                <div class=col-sm-10>
                    <div class=input-group>
                        <?php $input_name = 'article_id' ?>
                        <select class=form-control name="<?php echo $input_name ?>">
                            <?php if ( ! empty($articles) ): ?>
                            <option value="">可选择</option>
                            <?php
                                $options = $articles;
                                foreach ($options as $option):
                                    ?>
                                    <option value="<?php echo $option['article_id'] ?>" <?php echo set_select($input_name, $option['article_id']) ?>><?php echo $option['title'] ?></option>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </select>

                        <div class="input-group-addon">
                            <a href="<?php echo base_url('article') ?>">管理</a>
                        </div>
                    </div>

                    <p class="help-block">可选择平台文章作为通知内容，标题、摘要、形象图将根据文章相应数据自动生成。</p>
                </div>
            </div>

			<div class=form-group>
				<label for=title class="col-sm-2 control-label">标题</label>
				<div class=col-sm-10>
					<input class=form-control name=title type=text value="<?php echo set_value('title') ?>" placeholder="最多30个字符">
                    <p class="help-block">如果已选择了相关文章，则将覆盖自动生成的标题，以下各项也是。</p>
				</div>
			</div>
			<div class=form-group>
				<label for=excerpt class="col-sm-2 control-label">摘要</label>
				<div class=col-sm-10>
					<textarea class=form-control name=excerpt rows=5 placeholder="最多100个字符"><?php echo set_value('excerpt') ?></textarea>
				</div>
			</div>
            <div class=form-group>
                <label for=url_image_main class="col-sm-2 control-label">形象图</label>
                <div class=col-sm-10>
                    <?php
                    require_once(APPPATH. 'views/templates/file-uploader.php');
                    $name_to_upload = 'url_image';
                    generate_html($name_to_upload, $this->class_name, FALSE);
                    ?>
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