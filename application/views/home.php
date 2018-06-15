<style>
    #shortcut ul {margin-top:20px;}

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

<div id=content class=container>

    <div id="shortcut">
        <h2>快捷方式</h2>

        <ul class="list-unstyled row">
            <li class="col-xs-12">
                <a class="btn btn-default btn-block" title="投票活动详情" href="<?php echo base_url('vote/detail?id=5') ?>">"鲜果节"投票活动</a>
            </li>

            <li class="col-xs-6 col-sm-3">
                <a class="btn btn-primary btn-block" title="投票活动详情" href="<?php echo base_url('vote_option/index?vote_id=5') ?>">
                    <i class="far fa-list"></i> 候选项列表
                </a>
            </li>
            <li class="col-xs-6 col-sm-3">
                <a class="btn btn-primary btn-block" href="<?php echo base_url('vote_option/create?vote_id=5') ?>">
                    <i class="far fa-plus"></i> 创建候选项
                </a>
            </li>

            <li class="col-xs-6 col-sm-3">
                <a class="btn btn-default btn-block" href="<?php echo base_url('vote_tag/index?vote_id=5') ?>">候选项标签列表</a>
            </li>
            <li class="col-xs-6 col-sm-3">
                <a class="btn btn-default btn-block" href="<?php echo base_url('vote_option/create?vote_id=5') ?>">创建候选项标签</a>
            </li>
        </ul>
    </div>

	<hr>
    <!--
    <div>
        <a class="btn btn-default btn-block" href="<?php echo base_url('data/index') ?>">主要数据概览</a>
    </div>
    -->
</div>