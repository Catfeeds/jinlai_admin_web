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

<!--<script defer src="/js/edit.js"></script>-->

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
			<input name=id type=hidden value="<?php echo $item[$this->id_name] ?>">

            <div class=form-group>
                <label for=nature class="col-sm-2 control-label">商品性质 ※</label>
                <div class=col-sm-10>
                    <label class=radio-inline>
                        <input type=radio name=nature value="商品" required <?php if ($item['nature'] === '商品') echo 'checked' ?>> 商品
                    </label>
                    <label class=radio-inline>
                        <input type=radio name=nature value="服务" required <?php if ($item['nature'] === '服务') echo 'checked' ?>> 服务
                    </label>
                </div>
            </div>

            <div class=form-group>
                <label for=parent_id class="col-sm-2 control-label">所属分类</label>
                <div class=col-sm-10>
                    <input name=parent_id type=hidden value="<?php echo $item['parent_id'] ?>">

                    <div
                        class="multi-selector row"
                        data-ms-name=parent_id
                        data-ms-api_url="item_category/index"
                        data-ms-min_level=1
                        data-ms-max_level=2
                    >
                        <div class=col-xs-4>
                            <select class=form-control data-ms-level=1>
                                <option value="">可选择</option>
                                <?php foreach ($categories as $option): ?>
                                    <option value="<?php echo $option['category_id'] ?>" <?php if ($option['category_id'] === $item['parent_id']) echo 'selected' ?>><?php echo $option['nature'].'-'.$option['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class=form-group>
                <label for=name class="col-sm-2 control-label">名称 ※</label>
                <div class=col-sm-10>
                    <input class=form-control name=name type=text value="<?php echo empty(set_value('name'))? $item['name']: set_value('name') ?>" placeholder="名称" required>
                </div>
            </div>

            <div class=form-group>
                <label for=item_id class="col-sm-2 control-label">主推商品</label>
                <div class=col-sm-10>
                    <input class=form-control name=item_id type=text value="<?php echo empty(set_value('item_id'))? $item['item_id']: set_value('item_id') ?>" placeholder="请填写商品ID">
                </div>
            </div>

            <div class=form-group>
                <label for=description class="col-sm-2 control-label">描述</label>
                <div class=col-sm-10>
                    <textarea class=form-control name=description rows=5 placeholder="描述"><?php echo empty(set_value('description'))? $item['description']: set_value('description') ?></textarea>
                </div>
            </div>

            <div class=form-group>
                <label for=url_name class="col-sm-2 control-label">自定义域名</label>
                <div class=col-sm-10>
                    <input class=form-control name=url_name type=text value="<?php echo empty(set_value('url_name'))? $item['url_name']: set_value('url_name') ?>" placeholder="自定义域名">
                </div>
            </div>

            <div class=form-group>
                <label for=url_image class="col-sm-2 control-label">形象图</label>
                <div class=col-sm-10>
                    <?php
                    require_once(APPPATH. 'views/templates/file-uploader.php');
                    $name_to_upload = 'url_image';
                    generate_html($name_to_upload, $this->class_name, FALSE, 1, $item[$name_to_upload]);
                    ?>
                    <p class="help-block">将显示在分类列表页中列表项</p>
                </div>
            </div>

            <div class=form-group>
                <label for=url_image_index class="col-sm-2 control-label">列表页形象图</label>
                <div class=col-sm-10>
                    <?php
                    $name_to_upload = 'url_image_index';
                    generate_html($name_to_upload, $this->class_name, FALSE, 4, $item[$name_to_upload]);
                    ?>
                    <p class="help-block">将显示在分类列表页中当前分类的页面的顶端</p>
                </div>
            </div>

            <div class=form-group>
                <label for=url_image_detail class="col-sm-2 control-label">详情页形象图</label>
                <div class=col-sm-10>
                    <?php
                    $name_to_upload = 'url_image_detail';
                    generate_html($name_to_upload, $this->class_name, FALSE, 4, $item[$name_to_upload]);
                    ?>
                    <p class="help-block">将显示在当前分类的详情页顶端</p>
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