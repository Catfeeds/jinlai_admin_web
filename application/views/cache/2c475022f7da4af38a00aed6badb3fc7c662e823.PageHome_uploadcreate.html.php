<?php
/* Smarty version 3.1.32, created on 2018-07-26 14:33:44
  from '/www/web/jinlai_admin/public_html/application/views/backend/PageHome_uploadcreate.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.32',
  'unifunc' => 'content_5b596b4806f310_70493234',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35d8d6e87ae8bf84ea4d81af5e122be40aff2d82' => 
    array (
      0 => '/www/web/jinlai_admin/public_html/application/views/backend/PageHome_uploadcreate.html',
      1 => 1532328716,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 60,
),true)) {
function content_5b596b4806f310_70493234 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>主页</title>

        <meta name="description" content="overview &amp; stats" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/font-awesome/4.0.3/css/font-awesome.min.css" />

        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/jquery-ui.custom.min.css" />
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/chosen.css" />
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/datepicker.css" />
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/bootstrap-timepicker.css" />
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/daterangepicker.css" />
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/bootstrap-datetimepicker.css" />
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/colorpicker.css" />

        <!-- picture move
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/jquery.gritter.css" />
        -->

        <!-- text fonts -->
        <link rel="stylesheet" href="//fonts.useso.com/css?family=Open+Sans:400,300" />

        <!-- ace styles -->
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/ace.min.css" />

        <!--[if lte IE 9]>
            <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/ace-part2.min.css" />
        <![endif]-->
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/ace-skins.min.css" />
        <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/ace-rtl.min.css" />

        <!--[if lte IE 9]>
          <link rel="stylesheet" href="https://admin.517ybang.com/public/admin/css/ace-ie.min.css" />
        <![endif]-->

        <!-- inline styles related to this page -->

        <!-- ace settings handler -->
        <script src="https://admin.517ybang.com/public/admin/js/ace-extra.min.js"></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

        <!--[if lte IE 8]>
        <script src="https://admin.517ybang.com/public/admin/js/html5shiv.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/respond.min.js"></script>
        <![endif]-->

        <!-- basic scripts -->

        <!--[if !IE]> -->

        <!-- <![endif]-->

        <!--[if IE]>
        <script src="//ajax.useso.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='https://admin.517ybang.com/public/admin/js/jquery.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<script src='https://admin.517ybang.com/public/admin/js/jquery1x.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->
    </head>

    <body class="no-skin">
        <div id="navbar" class="navbar navbar-default">
            <script type="text/javascript">
               
            </script>

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
                
                    <script type="text/javascript">
                        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                    </script>
                
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="/backend/PageHome/index">首页</a>
                        </li>
                        <li class="active">主页</li>
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
        <form action="/backend/PageHome/uploadimg" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label for="title" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">标题<span class="red">*</span></label>
                <div class="col-xs-12 col-sm-4">
                    <span class="block input-icon input-icon-right">
                        <input type="text" id="title" placeholder="标题" name="title" class="col-xs-12" value="" />
                    </span>
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline"></div>
            </div>

            <div class="form-group">
                <label for="img" class="col-xs-12 col-sm-3 col-md-3 control-label no-padding-right">轮播图</label>
                <div class="col-xs-12 col-sm-4">
                    <span class="block input-icon input-icon-right">
                        <input multiple="" type="file" id="img" placeholder="头图" name="img" class="col-xs-12" value="" />
                    </span>
                </div>
                <div class="help-block col-xs-12 col-sm-reset inline"> </div>
            </div>           




            <div class="clearfix form-actions">
                <div class="col-md-offset-3 col-md-9">
                    <button class="btn btn-info" type="submit">
                        <i class="ace-icon fa fa-check bigger-110"></i>
                        提交
                    </button>

                    &nbsp; &nbsp; &nbsp;
                    <a class="btn" href="javascript:;" onclick="history.back(); ">
                        <i class="ace-icon fa fa-undo bigger-110"></i>
                        返回
                    </a>
                </br>
                  </br>
                      <div class="help-block col-xs-12 col-sm-reset inline"></div>
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
    background-image: url("");
    background-size:100% 100%;
    background-repeat:no-repeat;
}
</style>

<script type="text/javascript">
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
</script>



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
        <script src="//ajax.useso.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
        <script src="//ajax.useso.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <![endif]-->

        <!--[if !IE]> -->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='https://admin.517ybang.com/public/admin/js/jquery.min.js'>"+"<"+"/script>");
        </script>

        <!-- <![endif]-->

        <!--[if IE]>
        <script type="text/javascript">
         window.jQuery || document.write("<script src='https://admin.517ybang.com/public/admin/js/jquery1x.min.js'>"+"<"+"/script>");
        </script>
        <![endif]-->

        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='https://admin.517ybang.com/public/admin/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

        <!-- page specific plugin scripts -->

      

        <!-- page specific plugin scripts -->
        <script src="https://admin.517ybang.com/public/admin/js/jquery.dataTables.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/jquery.dataTables.bootstrap.js"></script>
    
        <script src="https://admin.517ybang.com/public/admin/js/jquery-ui.custom.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/jquery.ui.touch-punch.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/chosen.jquery.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/fuelux/fuelux.spinner.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/date-time/bootstrap-datepicker.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/date-time/bootstrap-timepicker.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/date-time/moment.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/date-time/daterangepicker.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/date-time/bootstrap-datetimepicker.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/bootstrap-colorpicker.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/jquery.knob.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/jquery.autosize.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/jquery.inputlimiter.1.3.1.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/jquery.maskedinput.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/bootstrap-tag.min.js"></script>

        <!-- page specific plugin scripts -->
        <script src="https://admin.517ybang.com/public/admin/js/markdown/markdown.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/markdown/bootstrap-markdown.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/jquery.hotkeys.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/bootstrap-wysiwyg.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/bootbox.min.js"></script>

        <!-- ace scripts -->
        <script src="https://admin.517ybang.com/public/admin/js/ace-elements.min.js"></script>
        <script src="https://admin.517ybang.com/public/admin/js/ace.min.js"></script>

        <!-- 图片移动/拖位
    
        -->
        <!-- 图片异步上传 -->
        <script src="https://admin.517ybang.com/public/admin/js/ajaxfileupload.js"></script>

    </body>
</html>
<?php }
}
