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
							<label for=lottery_id class="col-sm-2 control-label">抽奖ID</label>
							<div class=col-sm-10>
								<input class=form-control name=lottery_id type=text value="<?php echo empty(set_value('lottery_id'))? $item['lottery_id']: set_value('lottery_id') ?>" placeholder="抽奖ID">
							</div>
						</div>
						<div class=form-group>
							<label for=name class="col-sm-2 control-label">名称</label>
							<div class=col-sm-10>
								<input class=form-control name=name type=text value="<?php echo empty(set_value('name'))? $item['name']: set_value('name') ?>" placeholder="名称">
							</div>
						</div>
						<div class=form-group>
							<label for=url_name class="col-sm-2 control-label">自定义URL ※</label>
							<div class=col-sm-10>
								<input class=form-control name=url_name type=text value="<?php echo empty(set_value('url_name'))? $item['url_name']: set_value('url_name') ?>" placeholder="自定义URL" required>
							</div>
						</div>
						<div class=form-group>
							<label for=description class="col-sm-2 control-label">描述 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=description type=text value="<?php echo empty(set_value('description'))? $item['description']: set_value('description') ?>" placeholder="描述" required>
							</div>
						</div>
						<div class=form-group>
							<label for=extra class="col-sm-2 control-label">补充描述 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=extra type=text value="<?php echo empty(set_value('extra'))? $item['extra']: set_value('extra') ?>" placeholder="补充描述" required>
							</div>
						</div>
						<div class=form-group>
							<label for=url_image class="col-sm-2 control-label">形象图 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=url_image type=text value="<?php echo empty(set_value('url_image'))? $item['url_image']: set_value('url_image') ?>" placeholder="形象图" required>
							</div>
						</div>
						<div class=form-group>
							<label for=url_audio class="col-sm-2 control-label">背景音乐 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=url_audio type=text value="<?php echo empty(set_value('url_audio'))? $item['url_audio']: set_value('url_audio') ?>" placeholder="背景音乐" required>
							</div>
						</div>
						<div class=form-group>
							<label for=url_video class="col-sm-2 control-label">形象视频 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=url_video type=text value="<?php echo empty(set_value('url_video'))? $item['url_video']: set_value('url_video') ?>" placeholder="形象视频" required>
							</div>
						</div>
						<div class=form-group>
							<label for=url_video_thumb class="col-sm-2 control-label">形象视频缩略图 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=url_video_thumb type=text value="<?php echo empty(set_value('url_video_thumb'))? $item['url_video_thumb']: set_value('url_video_thumb') ?>" placeholder="形象视频缩略图" required>
							</div>
						</div>
						<div class=form-group>
							<label for=max_user_total class="col-sm-2 control-label">每用户最高总抽奖数</label>
							<div class=col-sm-10>
								<input class=form-control name=max_user_total type=text value="<?php echo empty(set_value('max_user_total'))? $item['max_user_total']: set_value('max_user_total') ?>" placeholder="每用户最高总抽奖数">
							</div>
						</div>
						<div class=form-group>
							<label for=max_user_daily class="col-sm-2 control-label">每用户最高日抽奖数</label>
							<div class=col-sm-10>
								<input class=form-control name=max_user_daily type=text value="<?php echo empty(set_value('max_user_daily'))? $item['max_user_daily']: set_value('max_user_daily') ?>" placeholder="每用户最高日抽奖数">
							</div>
						</div>
						<div class=form-group>
							<label for=chance_shared_daily class="col-sm-2 control-label">每用户每日分享后额外抽奖数 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=chance_shared_daily type=text value="<?php echo empty(set_value('chance_shared_daily'))? $item['chance_shared_daily']: set_value('chance_shared_daily') ?>" placeholder="每用户每日分享后额外抽奖数" required>
							</div>
						</div>
						<div class=form-group>
							<label for=exturl_before class="col-sm-2 control-label">活动前相关外链 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=exturl_before type=text value="<?php echo empty(set_value('exturl_before'))? $item['exturl_before']: set_value('exturl_before') ?>" placeholder="活动前相关外链" required>
							</div>
						</div>
						<div class=form-group>
							<label for=exturl_ongoing class="col-sm-2 control-label">活动中相关外链 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=exturl_ongoing type=text value="<?php echo empty(set_value('exturl_ongoing'))? $item['exturl_ongoing']: set_value('exturl_ongoing') ?>" placeholder="活动中相关外链" required>
							</div>
						</div>
						<div class=form-group>
							<label for=exturl_after class="col-sm-2 control-label">活动后相关外链 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=exturl_after type=text value="<?php echo empty(set_value('exturl_after'))? $item['exturl_after']: set_value('exturl_after') ?>" placeholder="活动后相关外链" required>
							</div>
						</div>
						<div class=form-group>
							<label for=content_css class="col-sm-2 control-label">自定义样式 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=content_css type=text value="<?php echo empty(set_value('content_css'))? $item['content_css']: set_value('content_css') ?>" placeholder="自定义样式" required>
							</div>
						</div>
						<div class=form-group>
							<label for=time_start class="col-sm-2 control-label">开始时间</label>
							<div class=col-sm-10>
								<input class=form-control name=time_start type=text value="<?php echo empty(set_value('time_start'))? $item['time_start']: set_value('time_start') ?>" placeholder="开始时间">
							</div>
						</div>
						<div class=form-group>
							<label for=time_end class="col-sm-2 control-label">结束时间</label>
							<div class=col-sm-10>
								<input class=form-control name=time_end type=text value="<?php echo empty(set_value('time_end'))? $item['time_end']: set_value('time_end') ?>" placeholder="结束时间">
							</div>
						</div>
						<div class=form-group>
							<label for=time_create class="col-sm-2 control-label">创建时间</label>
							<div class=col-sm-10>
								<input class=form-control name=time_create type=text value="<?php echo empty(set_value('time_create'))? $item['time_create']: set_value('time_create') ?>" placeholder="创建时间">
							</div>
						</div>
						<div class=form-group>
							<label for=time_delete class="col-sm-2 control-label">删除时间 ※</label>
							<div class=col-sm-10>
								<input class=form-control name=time_delete type=text value="<?php echo empty(set_value('time_delete'))? $item['time_delete']: set_value('time_delete') ?>" placeholder="删除时间" required>
							</div>
						</div>
						<div class=form-group>
							<label for=time_edit class="col-sm-2 control-label">最后操作时间</label>
							<div class=col-sm-10>
								<input class=form-control name=time_edit type=text value="<?php echo empty(set_value('time_edit'))? $item['time_edit']: set_value('time_edit') ?>" placeholder="最后操作时间">
							</div>
						</div>
						<div class=form-group>
							<label for=creator_id class="col-sm-2 control-label">创建者ID</label>
							<div class=col-sm-10>
								<input class=form-control name=creator_id type=text value="<?php echo empty(set_value('creator_id'))? $item['creator_id']: set_value('creator_id') ?>" placeholder="创建者ID">
							</div>
						</div>
						<div class=form-group>
							<label for=operator_id class="col-sm-2 control-label">最后操作者ID ※</label>
							<div class=col-sm-10>
								<input class=form-control name=operator_id type=text value="<?php echo empty(set_value('operator_id'))? $item['operator_id']: set_value('operator_id') ?>" placeholder="最后操作者ID" required>
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