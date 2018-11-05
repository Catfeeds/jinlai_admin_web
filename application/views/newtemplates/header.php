<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    // 生成SEO相关变量，一般为页面特定信息与在config/config.php中设置的站点通用信息拼接
    $title_prefix = (ENVIRONMENT !== 'production')? '': NULL;
    $title = isset($title)? $title: SITE_NAME.' - '.SITE_SLOGAN;
    $title = $title_prefix. $title;
    $keywords = (isset($keywords)? $keywords.',': NULL). SITE_KEYWORDS;
    $description = (isset($description)? $description: NULL). SITE_DESCRIPTION;

    // 生成body的class
    $body_class = ( isset($class) )? $class: NULL;
    $body_class .= ($this->user_agent['is_wechat'])? ' is_wechat': NULL;
    $body_class .= ($this->user_agent['is_ios'])? ' is_ios': NULL;
    $body_class .= ($this->user_agent['is_android'])? ' is_android': NULL;
    $body_class .= ($this->user_agent['is_mobile'])? ' is_mobile': NULL; // 移动端设备

    $body_class .= ($this->user_agent['is_macos'])? ' is_macos': NULL;
    $body_class .= ($this->user_agent['is_windows'])? ' is_windows': NULL;
    $body_class .= ($this->user_agent['is_desktop'])? ' is_desktop': NULL; // 非移动端设备
?>
<!DOCTYPE html>
<html lang=zh-cn>
<!-- header -->
    <head>
        <meta charset=utf-8>
        <meta http-equiv=x-dns-prefetch-control content=on>
        <link rel=dns-prefetch href="<?php echo CDN_URL ?>">
        <title><?php echo $title ?></title>
        <meta name=description content="<?php echo $description ?>">
        <meta name=keywords content="<?php echo $keywords ?>">
        <meta name=version content="revision20180709">
        <meta name=author content="刘亚杰Kamas,青岛意帮网络科技有限公司产品部&amp;技术部">
        <meta name=copyright content="进来商城,青岛意帮网络科技有限公司">
        <meta name=contact content="kamaslau@dingtalk.com">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <script src="<?php echo CDN_URL ?>js/jquery-3.3.1.min.js"></script>
        <script>
             (function (doc, win) {
                      var docEl = doc.documentElement,
                        resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
                        recalc = function () {
                          var clientWidth = docEl.clientWidth;
                          if (!clientWidth) return;
                    // [注]:chrome下不支持10px所以前边的100代表，1rem = 100px;后边的750代表设计稿的宽度
                          docEl.style.fontSize = 100 * (clientWidth / 750) + 'px';
                        };
                    
                      if (!doc.addEventListener) return;recalc();
                      win.addEventListener(resizeEvt, recalc, false);
                      doc.addEventListener('DOMContentLoaded', recalc, false);
                    })(document, window);
        </script>
        <script defer src="<?php echo CDN_URL ?>font-awesome/v5.0.13/fontawesome-all.min.js"></script>
        <script defer src="<?php echo CDN_URL ?>js/jquery.qrcode.min.js"></script>
        <script>
        $(function(){
            // 生成二维码
            $('figure.qrcode').each(function(){
                var qrcode_string = $(this).attr('data-qrcode-string');
                var dom = $(this);
                qrcode_generate(qrcode_string, dom);
            });
            function qrcode_generate(string, dom)
            {
                // 若未传入二维码容器，则默认为#qrcode
                var dom = dom || '#qrcode';

                // 创建二维码并转换为图片格式，以使微信能识别该二维码
                $(dom).qrcode(string);

                // 将canvas转换为Base64格式的图片内容
                function convertCanvasToImage(canvas)
                {
                    // 新Image对象，可以理解为DOM
                    var image = new Image();
                    // canvas.toDataURL 返回的是一串Base64编码的URL，当然,浏览器自己肯定支持
                    // 指定格式 PNG
                    image.src = canvas.toDataURL("image/png");
                    return image;
                }

                // 获取网页中的canvas对象
                var mycanvas = document.getElementsByTagName('canvas')[0];

                // 将转换后的img标签插入到html中
                var img = convertCanvasToImage(mycanvas);
                $(dom).append(img);
                dom.find('canvas').remove(); // 移除canvas格式的二维码
            }
        });
        </script>

        <?php
            // 微信相关功能
            if ($this->user_agent['is_wechat'])
                require_once(VIEWS_PATH.'templates/wechat.php');
        ?>
        <!--公用部分css-->
        <!--<link href="<?php echo CDN_URL ?>css/base.css" rel="stylesheet">-->
        <link href="<?php echo CDN_URL ?>css/swiper.mini.css" rel="stylesheet">
        <link href="<?php echo CDN_URL ?>css/index.min.css" rel="stylesheet">
        <style>
            .pagination-bullet-active{
                background:#606060 !important;
            }
            .swiper-pagination-bullet {
                background: #eaeaea;
            }
            .swiper-container-horizontal > .swiper-pagination {
                bottom: -2px;
                left: 0;
                width: 100%;
            }
            #nav-header {
                display: none;
            }
            .ui-loader{
                display: none;
            }
        </style>
    
        <script>
            console.log('意帮科技人才招聘' + "\n" + 'https://www.zhipin.com/gongsi/579c83446262d89f3n183tg~.html' + "\n\n");

            // UserAgent
            var user_agent = <?php echo json_encode($this->user_agent) ?>;

            // 当前用户信息
            var user_id = '<?php echo $this->session->user_id ?>';

            // 全局参数
            var api_url = '<?php echo API_URL ?>'; // API根URL
            var base_url = '<?php echo BASE_URL ?>'; // 页面根URL
            var cdn_url = '<?php echo CDN_URL ?>'; // CDN根URL
            var media_url = '<?php echo MEDIA_URL ?>'; // 媒体文件根URL
            var class_name = '<?php echo $this->class_name ?>';
            var class_name_cn = '<?php echo $this->class_name_cn ?>';
            
            // AJAX参数
            var ajax_root = '<?php echo API_URL ?>';
            var common_params = new Object()
            common_params.app_type = 'client' // 默认为客户端请求
            common_params.user_id = user_id
            $.ajaxSetup({
                type: 'post',
                dataType: 'json',
            });

            // 将时间戳格式化为可读日期
            Date.prototype.format = function(format) {
                var date = {
                    "M+": this.getMonth() + 1,
                    "d+": this.getDate(),
                    "h+": this.getHours() > 9? this.getHours(): '0'+this.getHours(), // 补足两位数字，下同
                    "m+": this.getMinutes() > 9? this.getMinutes(): '0'+this.getMinutes(),
                    "s+": this.getSeconds() > 9? this.getSeconds(): '0'+this.getSeconds(),
                    "q+": Math.floor((this.getMonth() + 3) / 3),
                    "S+": this.getMilliseconds()
                };
                if (/(y+)/i.test(format)) {
                    format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
                }
                for (var k in date) {
                    if (new RegExp("(" + k + ")").test(format)) {
                        format = format.replace(RegExp.$1, RegExp.$1.length == 1
                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
                    }
                }
                return format;
            }
            // 转换时间戳为日期
            function date(timestamp)
            {
                var timestamp = timestamp || Date.parse(new Date());

                var newDate = new Date();
                newDate.setTime(timestamp * 1000);
                return newDate.format('yyyy-MM-dd h:m:s');
            }
        </script>

        <link rel=canonical href="<?php echo current_url() ?>">
        <link rel="shortcut icon" href="<?php echo CDN_URL ?>icon/jinlai_client/icon28@3x.png">

        <?php if ($this->user_agent['is_desktop']): ?>
            <link rel="shortcut icon" href="<?php echo CDN_URL ?>icon/jinlai_client/icon28@3x.png">
            <link rel=canonical href="<?php echo current_url() ?>">
        <?php else: ?>
            <link rel=apple-touch-icon href="<?php echo CDN_URL ?>icon/jinlai_client/icon120@3x.png">
            <meta name=format-detection content="telephone=yes, address=no, email=no">
        <?php endif ?>

        <?php if (!empty(IOS_APP_ID) && $this->user_agent['is_ios']): ?>
            <meta name=apple-itunes-app content="app-id=<?php echo IOS_APP_ID ?>">
        <?php endif ?>
    </head>



<!-- 内容开始 -->
    <body<?php echo ( !empty($body_class) )? ' class="'.$body_class.'"': NULL ?>>
        <noscript>
            <p>您的浏览器功能加载出现问题，请刷新浏览器重试；如果仍然出现此提示，请考虑更换浏览器。</p>
        </noscript>
<?php
    /**
     * APP、微信中调用webview时配合URL按需显示相应部分
     * 此处以在APP中以WebView打开页面时不显示页面header部分为例
     */
    if ($this->user_agent['is_wechat'] || $this->user_agent['is_desktop']):
?>
        <header id=header role=banner>
            <div class=container>
                <h1>
                    <a id=logo class=none title="<?php echo SITE_NAME ?>" href="<?php echo base_url() ?>"><?php echo SITE_NAME ?></a>
                </h1>

                <a id=locate class=nav-icon>
                   <!-- <i class="fa fa-map-marker" aria-hidden="true"></i>-->
                </a>
                <a id=scan class=nav-icon>
                    <!--<i class="fa fa-qrcode" aria-hidden="true"></i>-->
                </a>
            </div>
        </header>
<?php endif ?>

        <!-- 部分功能仅在移动端非微信浏览器中可用 -->
        <?php if (!$this->user_agent['is_wechat'] && $this->user_agent['is_mobile']): ?>
            <!-- 部分功能仅在调试模式下可用 -->
            <?php if ($this->input->get('test_mode') === 'on'): ?>

                <p><?php echo $_SERVER['HTTP_USER_AGENT'] ?></p>

                <?php
                    if ( ! $this->user_agent['is_app']):

                    $scheme_url = APP_SCHEME.'://'. substr($_SERVER['REQUEST_URI'], 1);
                ?>
                <a style="font-size:.12rem;" href="<?php echo $scheme_url ?>">在<?php echo SITE_NAME ?>APP中打开</a>

                <script>
                    $(function(){
                        // 转到原生页面
                        window.location.href = '<?php echo $scheme_url ?>';
                    });
                </script>
                <?php endif ?>
            <?php endif ?>
        <?php endif ?>
            <script src="<?php echo CDN_URL ?>js/index.min.js"></script>
        </body>
