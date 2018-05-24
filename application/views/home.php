<style>
    #shortcut ul {margin-top:20px;}
        #shortcut li {width:48%;margin-bottom:10px;}
            #shortcut li:nth-of-type(2n+0) {margin-left:4%;}

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
        <h3>"进来商城匠心商家评选"相关</h3>
        <a class="btn btn-default btn-block" title="投票活动详情" href="<?php echo base_url('vote/detail?id=1') ?>">投票活动详情</a>

        <ul class="list-unstyled row">
            <li class="col-xs-12 col-sm-6">
                <a class="btn btn-primary btn-lg btn-block" title="投票活动详情" href="<?php echo base_url('vote_option/index?vote_id=1') ?>">
                    <i class="far fa-list"></i> 候选项列表
                </a>
            </li>
            <li class="col-xs-12 col-sm-6">
                <a class="btn btn-primary btn-lg btn-block" href="<?php echo base_url('vote_option/create?vote_id=1') ?>">
                    <i class="far fa-plus"></i> 创建候选项
                </a>
            </li>
        </ul>

        <ul class="list-unstyled row">
            <li class="col-xs-12 col-sm-6">
                <a class="btn btn-default btn-block" href="<?php echo base_url('vote_tag/index?vote_id=1') ?>">候选项标签列表</a>
            </li>
            <li class="col-xs-12 col-sm-6">
                <a class="btn btn-default btn-block" href="<?php echo base_url('vote_option/create?vote_id=1') ?>">创建候选项标签</a>
            </li>
        </ul>
    </div>

	<hr>
    <div>
        <a class="btn btn-default btn-block" href="<?php echo base_url('data/index') ?>">主要数据概览</a>
    </div>
</div>