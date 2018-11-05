<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

    // 生成SEO相关变量，一般为页面特定信息与在config/config.php中设置的站点通用信息拼接
    $title = isset($title)? $title: SITE_NAME.' - '.SITE_SLOGAN;
    $keywords = (isset($keywords)? $keywords.',': NULL). SITE_KEYWORDS;
    $description = (isset($description)? $description: NULL). SITE_DESCRIPTION;
?>
<!DOCTYPE html>
<html lang=zh-cn>
	<head>
		<meta charset=utf-8>
		<meta http-equiv=x-dns-prefetch-control content=on>
		<link rel=dns-prefetch href="<?php echo CDN_URL ?>">
		<title><?php echo $title ?></title>
		<meta name=description content="<?php echo $description ?>">
		<meta name=keywords content="<?php echo $keywords ?>">
		<meta name=version content="revision20180619">
		<meta name=author content="刘亚杰Kamas,青岛意帮网络科技有限公司产品部&amp;技术部">
		<meta name=copyright content="进来商城,青岛意帮网络科技有限公司">
		<meta name=contact content="kamaslau@dingtalk.com">

        <?php if ($this->user_agent['is_wechat']): ?>
        <meta name=viewport content="width=750,user-scalable=0">
        <?php else: ?>
        <meta name=viewport content="width=device-width,user-scalable=0">
        <?php endif ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

        <script src="<?php echo CDN_URL ?>js/jquery-3.3.1.min.js"></script>

        <script defer src="<?php echo CDN_URL ?>font-awesome/v5.0.13/fontawesome-all.min.js"></script>
        <script defer src="<?php echo CDN_URL ?>jquery/jquery.lazyload.min.js"></script>
        <script defer src="/js/vote.js"></script>

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
		<link rel=stylesheet media=all href="<?php echo CDN_URL ?>css/reset.css?<?php echo time() ?>">
		<!--公用部分css-->
        <link rel=stylesheet media=all href="/css/vote.css?<?php echo time() ?>">

        <meta name=format-detection content="telephone=yes, address=no, email=no">
    </head>

<?php
    // 生成body的class
    $body_class = ( isset($class) )? $class: NULL;
    $body_class .= ($this->user_agent['is_wechat'] === TRUE)? ' is_wechat': NULL;
    $body_class .= ($this->user_agent['is_ios'] === TRUE)? ' is_ios': NULL;
    $body_class .= ($this->user_agent['is_android'] === TRUE)? ' is_android': NULL;
    $body_class .= ($this->user_agent['is_mobile'])? ' is_mobile': NULL; // 移动端设备

    $body_class .= ($this->user_agent['is_macos'] === TRUE)? ' is_macos': NULL;
    $body_class .= ($this->user_agent['is_windows'] === TRUE)? ' is_windows': NULL;
    $body_class .= ($this->user_agent['is_desktop'])? ' is_desktop': NULL; // 非移动端设备
?>

<!-- 内容开始 -->
    <body<?php echo ( !empty($body_class) )? ' class="'.$body_class.'"': NULL ?>>
		<noscript>
			<p>您的浏览器功能加载出现问题，请刷新浏览器重试；如果仍然出现此提示，请考虑更换浏览器。</p>
		</noscript>

		<main id=maincontainer role=main>