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
<!-- header-page -->
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

        <script src="<?php echo CDN_URL ?>js/jquery-3.3.1.min.js"></script>
        <script defer src="<?php echo CDN_URL ?>font-awesome/v5.0.13/fontawesome-all.min.js"></script>
        <script defer src="<?php echo CDN_URL ?>jquery/jquery.lazyload.min.js"></script>

        <meta name=viewport content="width=750,user-scalable=0">

    <?php
        if ($this->user_agent['is_wechat']):
            require_once(VIEWS_PATH.'templates/wechat.php');
    ?>
        <script>
        <?php if ($this->test_mode != 'on'): ?>
        // 百度统计
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "https://hm.baidu.com/hm.js?7c5231bd92955bfd7dfd7dc3be1a0206";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
        <?php endif ?>
        </script>
    <?php endif ?>

		<!--清除浏览器默认样式css-->
		<link rel=stylesheet media=all href="<?php echo CDN_URL ?>css/reset.css">

        <script>
            var phoneScale = parseInt(window.screen.width) / 750;
            console.log(phoneScale);

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
                    "h+": this.getHours() > 10? this.getHours(): '0'+this.getHours(), // 补足两位数字，下同
                    "m+": this.getMinutes() > 10? this.getMinutes(): '0'+this.getMinutes(),
                    "s+": this.getSeconds() > 10? this.getSeconds(): '0'+this.getSeconds(),
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

        <meta name=format-detection content="telephone=yes, address=no, email=no">
    </head>

<?php
    // 将head内容立即输出，让用户浏览器立即开始请求head中各项资源，提高页面加载速度
    ob_flush();flush();
?>

<!-- 内容开始 -->
    <body<?php echo ( !empty($body_class) )? ' class="'.$body_class.'"': NULL ?>>
		<noscript>
			<p>您的浏览器功能加载出现问题，请刷新浏览器重试；如果仍然出现此提示，请考虑更换浏览器。</p>
		</noscript>

		<main id=maincontainer role=main>