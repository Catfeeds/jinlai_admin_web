<?php
/* Smarty version 3.1.32, created on 2018-07-26 13:13:48
  from '/www/web/jinlai_admin/public_html/application/views/backend/PageHome_doXml.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b59588cebe294_29028724',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7099a0cbcc6e14e8a65490ca58dc7c712f22c96f' => 
    array (
      0 => '/www/web/jinlai_admin/public_html/application/views/backend/PageHome_doXml.html',
      1 => 1532581998,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b59588cebe294_29028724 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->compiled->nocache_hash = '3810942125b59588cda5f82_57473094';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title><?php ob_start();
echo $_smarty_tpl->tpl_vars['pageTitle']->value;
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>
</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>
admin/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable3 = ob_get_clean();
echo $_prefixVariable3;?>
admin/font-awesome/4.0.3/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>
admin/css/jquery-ui.custom.min.css" />
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>
admin/css/chosen.css" />
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable6 = ob_get_clean();
echo $_prefixVariable6;?>
admin/css/datepicker.css" />
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable7 = ob_get_clean();
echo $_prefixVariable7;?>
admin/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable8 = ob_get_clean();
echo $_prefixVariable8;?>
admin/css/daterangepicker.css" />
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable9 = ob_get_clean();
echo $_prefixVariable9;?>
admin/css/bootstrap-datetimepicker.css" />
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable10 = ob_get_clean();
echo $_prefixVariable10;?>
admin/css/colorpicker.css" />

        <!-- picture move
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable11 = ob_get_clean();
echo $_prefixVariable11;?>
admin/css/jquery.gritter.css" />
        -->

        <!-- text fonts -->
        <link rel="stylesheet" href="//fonts.useso.com/css?family=Open+Sans:400,300" />

        <!-- ace styles -->
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable12 = ob_get_clean();
echo $_prefixVariable12;?>
admin/css/ace.min.css" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable13 = ob_get_clean();
echo $_prefixVariable13;?>
admin/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable14 = ob_get_clean();
echo $_prefixVariable14;?>
admin/css/ace-skins.min.css" />
        <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable15 = ob_get_clean();
echo $_prefixVariable15;?>
admin/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable16 = ob_get_clean();
echo $_prefixVariable16;?>
admin/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable17 = ob_get_clean();
echo $_prefixVariable17;?>
admin/js/ace-extra.min.js"><?php echo '</script'; ?>
>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable18 = ob_get_clean();
echo $_prefixVariable18;?>
admin/js/html5shiv.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable19 = ob_get_clean();
echo $_prefixVariable19;?>
admin/js/respond.min.js"><?php echo '</script'; ?>
>
        <![endif]-->

        <!-- basic scripts -->

        <!--[if !IE]> -->
      <!--   <?php echo '<script'; ?>
 src="//ajax.useso.com/ajax/libs/jquery/2.1.0/jquery.min.js"><?php echo '</script'; ?>
> -->

        <!-- <![endif]-->

        <!--[if IE]>
        <?php echo '<script'; ?>
 src="//ajax.useso.com/ajax/libs/jquery/1.11.0/jquery.min.js"><?php echo '</script'; ?>
>
        <![endif]-->

        <!--[if !IE]> -->
        <?php echo '<script'; ?>
 type="text/javascript">
            window.jQuery || document.write("<?php echo '<script'; ?>
 src='<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable20 = ob_get_clean();
echo $_prefixVariable20;?>
admin/js/jquery.min.js'>"+"<"+"/script>");
        <?php echo '</script'; ?>
>

        <!-- <![endif]-->

        <!--[if IE]>
        <?php echo '<script'; ?>
 type="text/javascript">
         window.jQuery || document.write("<?php echo '<script'; ?>
 src='<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable21 = ob_get_clean();
echo $_prefixVariable21;?>
admin/js/jquery1x.min.js'>"+"<"+"/script>");
        <?php echo '</script'; ?>
>
        <![endif]-->
    </head>

    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default">
            <?php echo '<script'; ?>
 type="text/javascript">
               
            <?php echo '</script'; ?>
>

            <div class="navbar-container" id="navbar-container">
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
                    
						</small>
					</a>
                </div>

                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
               
                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                           

                            <li class="divider"></li>

                            <li>
                            <a href="">
                                <i class="ace-icon fa fa-power-off"></i>
                                退出
                            </a>
                            </li>
                        </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- /.navbar-container -->
        </div>

        <div class="main-container" id="main-container">
         

            <div id="sidebar" class="sidebar                  responsive">
             

                <div class="sidebar-shortcuts" id="sidebar-shortcuts">
                <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
                </button>

                <button class="btn btn-info">
               <i class="ace-icon fa fa-pencil"></i>
                </button>

                <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
                </button>

                <!--<button class="btn btn-danger">-->
                <!--<i class="ace-icon fa fa-cogs"></i>-->
                <!--</button>-->
                <!--</div>-->

                <!--<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">-->
                <!--<span class="btn btn-success"></span>-->

                <!--<span class="btn btn-info"></span>-->

                <!--<span class="btn btn-warning"></span>-->

                <!--<span class="btn btn-danger"></span>-->
                </div>
                </div>
                <!-- /.nav-list -->
                <ul class="nav nav-list">

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text"> 首页管理 </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">


                            <li class="">
                                <a href="/backend/PageHome/index">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    生成XML
                                </a>

                                <b class="arrow"></b>
                            </li>

                            <li class="">
                                <a href="/backend/PageHome/uploadimglist">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    上传图片
                                </a>

                                <b class="arrow"></b>
                            </li>

						</ul>
					</li>
				
				</ul>
                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>

            </div>

            <div class="main-content">

            <div class="breadcrumbs" id="breadcrumbs">
                
                    <?php echo '<script'; ?>
 type="text/javascript">
                        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                    <?php echo '</script'; ?>
>
                
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="/backend/PageHome/index">首页</a>
                        </li>
                        <li class="active"><?php ob_start();
echo $_smarty_tpl->tpl_vars['pageTitle']->value;
$_prefixVariable22 = ob_get_clean();
echo $_prefixVariable22;?>
</li>
                    </ul><!-- /.breadcrumb -->

                    <div class="nav-search" id="nav-search">
                        <form class="form-search">
                            <span class="input-icon">
                                <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off">
                                <i class="ace-icon fa fa-search nav-search-icon"></i>
                            </span>
                        </form>
                    </div><!-- /.nav-search -->
                </div>

                <div class="page-content">

                    <!-- 消息提醒S -->
            
                    <!-- 消息提醒E -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form action="/backend/PageHome/homeindex" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <div class="col-xs-12">
                <input type="file" id="id-input-file-2" name="xmldata">
            </div>
            </div>
            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
            <div class="col-md-offset-3 col-md-9">
                 <button class="btn btn-app btn-warning" type="submit" >
                                            <i class="ace-icon fa fa-undo bigger-230"></i>
                                            预览首页
                                        </button>  </div>
                </br>
                  </br>
                      <div class="help-block col-xs-12 col-sm-reset inline"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['error']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>
                </div>
            </div>

        </form>
          
    </div><!-- /.col -->
</div><!-- /.row -->

<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form action="/backend/PageHome/updateredis" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <div class="col-xs-12">
                <input type="file" id="id-input-file-2" name="homexml">
            </div>
            </div>
            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
            <div class="col-md-offset-3 col-md-9">
                 <button class="btn btn-app btn-warning" type="submit" >
                                            <i class="ace-icon fa fa-undo bigger-230"></i>
                                            更新首页
                                        </button>  </div>
                </br>
                  </br>
                      <div class="help-block col-xs-12 col-sm-reset inline"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['error']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>
                </div>
            </div>

        </form>
          
    </div><!-- /.col -->
</div><!-- /.row -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form action="/backend/PageHome/detail" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
            <label for="form-field-select-1">选择分类</label>
            <select class="form-control" id="form-field-select-1" name="classtype">
                <option value="2">生鲜超市</option>
                <option value="15">潮流酷玩</option>
                <option value="8">母婴用品</option>
                <option value="10">科技数码</option>
                <option value="11">居家生活</option>
                <option value="12">休闲零食</option>
                <option value="13">运动户外</option>
                <option value="14">游戏动漫</option>           
 
            </select>
          <div class="form-group">
            <div class="col-xs-12">
                <input type="file" id="id-input-file-2" name="classpagexml">
            </div>
            </div>
            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
            <div class="col-md-offset-3 col-md-9">
                 <button class="btn btn-app btn-warning" type="submit" >
                                            <i class="ace-icon fa fa-undo bigger-230"></i>
                                            预览分类页
                                        </button>  </div>
                </br>
                  </br>
                      <div class="help-block col-xs-12 col-sm-reset inline"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['error']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>
                </div>
            </div>

        </form>
          
    </div><!-- /.col -->
</div><!-- /.row -->
<div class="row">
    <div class="col-xs-12">
        <!-- PAGE CONTENT BEGINS -->
        <form action="/backend/PageHome/updatedetail" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
            <label for="form-field-select-1">选择分类</label>
            <select class="form-control" id="form-field-select-1" name="classtype">
                <option value="2">生鲜超市</option>
                <option value="15">潮流酷玩</option>
                <option value="8">母婴用品</option>
                <option value="10">科技数码</option>
                <option value="11">居家生活</option>
                <option value="12">休闲零食</option>
                <option value="13">运动户外</option>
                <option value="14">游戏动漫</option>           
 
            </select>
          <div class="form-group">
            <div class="col-xs-12">
                <input type="file" id="id-input-file-2" name="updateclasspagexml">
            </div>
            </div>
            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
            <div class="col-md-offset-3 col-md-9">
                 <button class="btn btn-app btn-warning" type="submit" >
                                            <i class="ace-icon fa fa-undo bigger-230"></i>
                                            更新分类页
                                        </button>  </div>
                </br>
                  </br>
                      <div class="help-block col-xs-12 col-sm-reset inline"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['error']->value)===null||$tmp==='' ? '' : $tmp);?>
</div>
                </div>
            </div>

        </form>
          
    </div><!-- /.col -->
</div><!-- /.row -->
<style>
    .ace-file-multiple .ace-file-container .ace-file-name .ace-icon{
    width:100%;
    height:100px;
}
.fa-img {
    background-image: url("/backend/PageHome/homeindex");
    background-size:100% 100%;
    background-repeat:no-repeat;
}
</style>

<?php echo '<script'; ?>
 type="text/javascript">
    function updatehomepage(){
        if (confirm("你确定要更新首页信息吗？")) {
            document.getElementById("updateform").submit()
        }
    }

    $(document).ready(function(){

       $('#img').ace_file_input({
           style:'well',
           btn_choose:'点击这里修改图片',
           btn_change:null,
           no_icon:'ace-icon fa {% if news.img %}fa-img{% else %}fa-cloud-upload{% endif %}',
           droppable:false,
           thumbnail:'large'//large | fit
       });

   $('#detail_editor').ace_wysiwyg({
      'wysiwyg': {
           uploadScript: "{{ url('backend/upload/upload', {'dir':'news'}) }}",
           uploadOptions: {
               post_id: '10',
               revision_id: '3'
           }
       }
   });
   $('#detail_editor').focusout(function() {
       $('#detail').val($('#detail_editor').html());
   });
    $('#dateline').datetimepicker({format: 'YYYY-MM-DD hh:mm:ss'}).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });
    $('#updatetime').datetimepicker({format: 'YYYY-MM-DD hh:mm:ss'}).next().on(ace.click_event, function(){
        $(this).prev().focus();
    });

        $(".ace-switch").each(function () {
            var aceswitch = this;

            aceswitch.addEventListener("click", function(){
                id = this.id.replace("_radio", "");
                if(this.checked){
                    $("#"+id).val('1');
                } else {
                    $("#"+id).val('0');
                }
                });
        });
    });
<?php echo '</script'; ?>
>



                </div><!-- /.page-content -->
            </div><!-- /.main-content -->
            <div class="footer">
                <div class="footer-inner">
                    <div class="footer-content">
                        <span class="bigger-120">
                            <span class="blue bolder">青岛进来</span>
                       
                           copyright 2018
                        </span>
                    </div>
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->
        <!-- basic scripts -->


        <!--[if !IE]> -->
   

        <!-- <![endif]-->

        <!--[if IE]>
        <?php echo '<script'; ?>
 src="//ajax.useso.com/ajax/libs/jquery/1.11.0/jquery.min.js"><?php echo '</script'; ?>
>
        <![endif]-->

        <!--[if !IE]> -->
        <?php echo '<script'; ?>
 type="text/javascript">
            window.jQuery || document.write("<?php echo '<script'; ?>
 src='<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable23 = ob_get_clean();
echo $_prefixVariable23;?>
admin/js/jquery.min.js'>"+"<"+"/script>");
        <?php echo '</script'; ?>
>

        <!-- <![endif]-->

        <!--[if IE]>
        <?php echo '<script'; ?>
 type="text/javascript">
         window.jQuery || document.write("<?php echo '<script'; ?>
 src='<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable24 = ob_get_clean();
echo $_prefixVariable24;?>
admin/js/jquery1x.min.js'>"+"<"+"/script>");
        <?php echo '</script'; ?>
>
        <![endif]-->

        <?php echo '<script'; ?>
 type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<?php echo '<script'; ?>
 src='<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable25 = ob_get_clean();
echo $_prefixVariable25;?>
admin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        <?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"><?php echo '</script'; ?>
>

        <!-- page specific plugin scripts -->

      

        <!-- page specific plugin scripts -->
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable26 = ob_get_clean();
echo $_prefixVariable26;?>
admin/js/jquery.dataTables.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable27 = ob_get_clean();
echo $_prefixVariable27;?>
admin/js/jquery.dataTables.bootstrap.js"><?php echo '</script'; ?>
>
    
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable28 = ob_get_clean();
echo $_prefixVariable28;?>
admin/js/jquery-ui.custom.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable29 = ob_get_clean();
echo $_prefixVariable29;?>
admin/js/jquery.ui.touch-punch.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable30 = ob_get_clean();
echo $_prefixVariable30;?>
admin/js/chosen.jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable31 = ob_get_clean();
echo $_prefixVariable31;?>
admin/js/fuelux/fuelux.spinner.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable32 = ob_get_clean();
echo $_prefixVariable32;?>
admin/js/date-time/bootstrap-datepicker.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable33 = ob_get_clean();
echo $_prefixVariable33;?>
admin/js/date-time/bootstrap-timepicker.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable34 = ob_get_clean();
echo $_prefixVariable34;?>
admin/js/date-time/moment.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable35 = ob_get_clean();
echo $_prefixVariable35;?>
admin/js/date-time/daterangepicker.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable36 = ob_get_clean();
echo $_prefixVariable36;?>
admin/js/date-time/bootstrap-datetimepicker.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable37 = ob_get_clean();
echo $_prefixVariable37;?>
admin/js/bootstrap-colorpicker.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable38 = ob_get_clean();
echo $_prefixVariable38;?>
admin/js/jquery.knob.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable39 = ob_get_clean();
echo $_prefixVariable39;?>
admin/js/jquery.autosize.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable40 = ob_get_clean();
echo $_prefixVariable40;?>
admin/js/jquery.inputlimiter.1.3.1.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable41 = ob_get_clean();
echo $_prefixVariable41;?>
admin/js/jquery.maskedinput.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable42 = ob_get_clean();
echo $_prefixVariable42;?>
admin/js/bootstrap-tag.min.js"><?php echo '</script'; ?>
>

        <!-- page specific plugin scripts -->
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable43 = ob_get_clean();
echo $_prefixVariable43;?>
admin/js/markdown/markdown.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable44 = ob_get_clean();
echo $_prefixVariable44;?>
admin/js/markdown/bootstrap-markdown.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable45 = ob_get_clean();
echo $_prefixVariable45;?>
admin/js/jquery.hotkeys.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable46 = ob_get_clean();
echo $_prefixVariable46;?>
admin/js/bootstrap-wysiwyg.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable47 = ob_get_clean();
echo $_prefixVariable47;?>
admin/js/bootbox.min.js"><?php echo '</script'; ?>
>

        <!-- ace scripts -->
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable48 = ob_get_clean();
echo $_prefixVariable48;?>
admin/js/ace-elements.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable49 = ob_get_clean();
echo $_prefixVariable49;?>
admin/js/ace.min.js"><?php echo '</script'; ?>
>

        <!-- 图片移动/拖位
    
        -->
        <!-- 图片异步上传 -->
        <?php echo '<script'; ?>
 src="<?php ob_start();
echo $_smarty_tpl->tpl_vars['assetsUri']->value;
$_prefixVariable50 = ob_get_clean();
echo $_prefixVariable50;?>
admin/js/ajaxfileupload.js"><?php echo '</script'; ?>
>

    </body>
</html>
<?php }
}
