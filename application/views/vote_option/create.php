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

<?php
// 通用URL参数
$common_params = '?vote_id='.$vote_id;
?>
<base href="<?php echo $this->media_root ?>">

<div id=breadcrumb>
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url() ?>">首页</a></li>
		<li><a href="<?php echo base_url($this->class_name.$common_params) ?>"><?php echo $this->class_name_cn ?></a></li>
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
            <input name=vote_id type=hidden value=<?php echo $vote_id ?>>

            <div class=form-group>
                <label for=index_id class="col-sm-2 control-label">索引序号</label>
                <div class=col-sm-10>
                    <input class=form-control name=index_id type=number min="1" step="1" max=65535 value="<?php echo set_value('index_id') ?>" placeholder="整数数字">

                    <p class=help-block>输入索引序号后，活动页面上各候选项将按序号数字大小排序；也可以在活动修改页批量调序。</p>
                </div>
            </div>
			
			<div class=form-group>
				<label for=name class="col-sm-2 control-label">名称 ※</label>
				<div class=col-sm-10>
					<input class=form-control name=name type=text value="<?php echo set_value('name') ?>" placeholder="30个字符以内" required>
				</div>
			</div>
			
			<div class=form-group>
				<label for=description class="col-sm-2 control-label">描述</label>
				<div class=col-sm-10>
					<textarea class=form-control name=description rows=10 placeholder="100个字符以内"><?php echo set_value('description') ?></textarea>
				</div>
			</div>

            <div class=form-group>
                <?php $input_name = 'tag_id' ?>
                <label for="<?php echo $input_name ?>" class="col-sm-2 control-label">参选分类</label>
                <div class=col-sm-10>
                    <?php if ( ! empty($tags)): ?>
                    <select name=<?php echo $input_name ?> required>
                    <?php foreach($tags as $tag): ?>
                        <option value="<?php echo $tag[$input_name] ?>"><?php echo $tag['name'] ?></option>
                    <?php endforeach ?>
                    </select>

                    <?php else: ?>
                    <p class="form-control-static"><a href="<?php echo base_url('vote_tag/create'.$common_params) ?>">添加候选项标签</a>后，即可为候选项指定所属标签（即分类）</p>

                    <?php endif ?>
                </div>
            </div>
			
			<div class=form-group>
				<label for=url_image class="col-sm-2 control-label">形象图</label>
				<div class=col-sm-10>
                    <?php
                    require_once(APPPATH. 'views/templates/file-uploader.php');
                    $name_to_upload = 'url_image';
                    generate_html($name_to_upload, $this->class_name, FALSE);
                    ?>

                    <p class=help-block>正方形图片视觉效果最佳</p>
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