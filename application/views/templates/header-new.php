<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// 生成SEO相关变量，一般为页面特定信息与在config/config.php中设置的站点通用信息拼接
$title = isset($title)? $title: SITE_NAME.' - '.SITE_SLOGAN;
$keywords = isset($keywords)? $keywords.',': NULL;
$keywords .= SITE_KEYWORDS;
$description = isset($description)? $description: NULL;
$description .= SITE_DESCRIPTION;
?>
<!doctype html>
<html lang=zh-cn>
<head>
    <meta charset=utf-8>
    <meta http-equiv=x-dns-prefetch-control content=on>
    <link rel=dns-prefetch href="<?php echo CDN_URL ?>">
    <title><?php echo $title ?></title>
    <meta name=description content="<?php echo $description ?>">
    <meta name=keywords content="<?php echo $keywords ?>">
    <meta name=version content="revision20180312">
    <meta name=author content="刘亚杰Kamas,青岛意帮网络科技有限公司产品部&技术部">
    <meta name=copyright content="进来商城,青岛意帮网络科技有限公司">
    <meta name=contact content="kamaslau@dingtalk.com">

    <meta name=viewport content="width=device-width,user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php
    if (!empty($this->session->stuff_id) && empty($this->stuff)):
        ?>
        <script>
            alert('员工关系状态异常，请重新登录')
            location.href = "<?php echo base_url('logout') ?>";
        </script>
        <?php exit();endif; ?>

    <?php if ($this->user_agent['is_wechat']): ?>
        <script src="https://res.wx.qq.com/open/js/jweixin-1.3.0.js"></script>
        <script>
            <?php
            function curl($url, $params = NULL, $return = 'array', $method = 'get')
            {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);

                // 设置cURL参数，要求结果保存到字符串中还是输出到屏幕上。
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');

                // 需要通过POST方式发送的数据
                if ($method === 'post'):
                    $params['app_type'] = 'biz'; // 应用类型默认为biz
                    curl_setopt($curl, CURLOPT_POST, count($params));
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
                endif;

                // 运行cURL，请求API
                $result = curl_exec($curl);

                // 输出CURL请求头以便调试
                //var_dump(curl_getinfo($curl));

                // 关闭URL请求
                curl_close($curl);

                // 转换返回的json数据为相应格式并返回
                if ($return === 'object'):
                    $result = json_decode($result);
                elseif ($return === 'array'):
                    $result = json_decode($result, TRUE);
                endif;

                return $result;
            }

            // 获取access_token
            function get_access_token()
            {
                $params = NULL;
                $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.WECHAT_APP_ID.'&secret='.WECHAT_APP_SECRET;
                $result = curl($url, $params, 'array');
                return $result['access_token'];
            }

            // 获取jsapi_ticket
            function get_jsapi_ticket($access_token)
            {
                $params = NULL;
                $url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$access_token.'&type=jsapi';
                $result = curl($url, $params, 'array');
                return $result['ticket'];
            }

            $access_token = get_access_token();
            $wesign['timestamp'] = time();
            $wesign['noncestr'] = 'Wm3WZYTPz0wzccnW';
            $wesign['jsapi_ticket'] = get_jsapi_ticket($access_token);
            $current_url = 'https://'. $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
            if (strpos($current_url, '#') !== FALSE) $current_url = substr($current_url, 0, strpos($current_url, '#'));
            $wesign['url'] = $current_url;

            // 微信JSAPI签名过程
            function wechat_sign_generate($params)
            {
                // 对参与签名的参数进行排序
                ksort($params);

                // 拼接字符串
                $param_string = '';
                foreach ($params as $key => $value)
                    $param_string .= '&'. $key.'='.$value;
                $param_string = trim($param_string, '&'); // 清除开头的“&”

                // 计算字符串SHA1值
                $sign = SHA1($param_string);
                return $sign;
            }
            ?>

            wx.config({
                debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                appId: '<?php echo WECHAT_APP_ID ?>', // 必填，公众号的唯一标识
                timestamp: <?php echo $wesign['timestamp'] ?>, // 必填，生成签名的时间戳
                nonceStr: '<?php echo $wesign['noncestr'] ?>', // 必填，生成签名的随机串
                signature: '<?php echo wechat_sign_generate($wesign) ?>',// 必填，签名，见附录1
                jsApiList: [
                    'onMenuShareTimeline',
                    'onMenuShareAppMessage',
                    'hideMenuItems',
                ] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
            });

            wx.ready(function(){
                // 隐藏部分按钮
                wx.hideMenuItems({
                    menuList:[
                        'menuItem:share:qq', 'menuItem:share:QZone', 'menuItem:share:facebook', 'menuItem:copyUrl', 'menuItem:readMode', 'menuItem:openWithQQBrowser', 'menuItem:openWithSafari', 'menuItem:share:email',
                    ] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
                });

                // 分享到朋友圈
                wx.onMenuShareTimeline({
                    title: '<?php echo $title ?>', // 分享标题
                    link: '<?php echo 'https://'. $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: null, // 分享图标
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        alert('分享成功');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        alert('您未完成分享');
                    }
                });

                // 分享给朋友
                wx.onMenuShareAppMessage({
                    title: '<?php echo $title ?>', // 分享标题
                    desc: '<?php echo $description ?>', // 分享描述
                    link: '<?php echo 'https://'. $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
                    imgUrl: null, // 分享图标
                    type: '', // 分享类型,music、video或link，不填默认为link
                    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                    success: function () {
                        // 用户确认分享后执行的回调函数
                        alert('分享成功');
                    },
                    cancel: function () {
                        // 用户取消分享后执行的回调函数
                        alert('您未完成分享');
                    }
                });
            });
        </script>
    <?php endif ?>


    <script src="<?php echo CDN_URL ?>js/jquery-3.3.1.min.js"></script>

        <script src="/js/common.js"></script>
		<script defer src="<?php echo CDN_URL ?>js/js.cookie.js"></script>
    <!--
        <script defer src="<?php echo CDN_URL ?>bootstrap/v4.0.0/bootstrap.min.js"></script>
        -->
        <script defer src="<?php echo CDN_URL ?>font-awesome/v5.0.8/fontawesome-all.min.js"></script>
        <?php if (isset($this->session->time_expire_login) ): ?>
            <script defer src="/js/file-upload.js"></script>
            <script defer src="<?php echo CDN_URL ?>jquery/jquery.qrcode.min.js"></script>
            <script defer src="<?php echo CDN_URL ?>jquery/jquery.lazyload.min.js"></script>
            <script defer src="<?php echo CDN_URL ?>jquery/stupidtable.min.js"></script>
        <?php endif ?>


    <script>
        var user_agent = new Object();
        user_agent.is_wechat = <?php echo ($this->user_agent['is_wechat'])? 'true': 'false' ?>;
        user_agent.is_ios = <?php echo ($this->user_agent['is_ios'])? 'true': 'false' ?>;
        user_agent.is_android = <?php echo ($this->user_agent['is_android'])? 'true': 'false' ?>;
    </script>

    <link rel=stylesheet media=all href="<?php echo CDN_URL ?>css/reset.css">
    <!--
        <link rel=stylesheet media=all href="<?php echo CDN_URL ?>bootstrap/v4.0.0/bootstrap.min.css">
        <link rel=stylesheet media=all href="<?php echo CDN_URL ?>css/flat-ui.min.css">
        <link rel=stylesheet media=all href="/css/style.css">

        -->
    <link rel=stylesheet media=all href="/beagle/v1.4.2/assets/lib/perfect-scrollbar/css/perfect-scrollbar.min.css">
    <link rel=stylesheet media=all href="/beagle/v1.4.2/assets/lib/material-design-icons/css/material-design-iconic-font.min.css">
    <link rel=stylesheet media=all href="/beagle/v1.4.2/assets/css/app.css">
    <?php if (isset($this->session->time_expire_login) ): ?>
        <link rel=stylesheet media=all href="/css/file-upload.css">
    <?php endif ?>

    <?php if ($this->user_agent['is_desktop']): ?>
        <link rel="shortcut icon" href="<?php echo CDN_URL ?>icon/jinlai_client/icon28@3x.png">
        <link rel=canonical href="<?php echo current_url() ?>">
    <?php else: ?>
        <link rel=apple-touch-icon href="<?php echo CDN_URL ?>icon/jinlai_client/icon120@3x.png">
        <meta name=format-detection content="telephone=yes, address=no, email=no">
    <?php endif ?>
</head>
<?php
// 将head内容立即输出，让用户浏览器立即开始请求head中各项资源，提高页面加载速度
ob_flush();flush();

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
<body class="<?php echo !empty($body_class)? $body_class: NULL ?>">

<div class="be-wrapper">
    <noscript class="bg-info text-info">
        <p>您的浏览器功能加载出现问题，请刷新浏览器重试；如果仍然出现此提示，请考虑更换浏览器。</p>
    </noscript>

    <nav class="navbar navbar-expand fixed-top be-top-header">
        <div class="container-fluid">

            <!-- Navbar Header -->
            <div class="be-navbar-header">
                <!-- Brand Logo -->
                <?php
                // 移动端仅显当前页面标题，不跳转
                if ($this->user_agent['is_mobile']):
                    echo '<h1 class="navbar-brand">'.$title.'</h1>';
                else:
                    ?>
                    <a id=logo class=navbar-brand title="<?php echo SITE_NAME ?>" href="<?php echo base_url() ?>">
                        <?php echo SITE_NAME ?>
                    </a>
                <?php endif ?>
            </div>

            <?php $username = empty($this->session->lastname)? $this->session->nickname: $this->session->lastname ?>
            <div class="be-right-navbar">
                <ul class="nav navbar-nav float-right be-user-nav">
                    <li class="nav-item dropdown">
                        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                            <?php if ( ! empty($this->session->avatar)): ?>
                                <img src="<?php echo MEDIA_URL.'user/avatar/'.$this->session->avatar ?>" alt="<?php echo $username ?>">
                            <?php endif ?>
                            <span class=user-name><?php echo $username ?></span>
                        </a>

                        <div role="menu" class="dropdown-menu">
                            <a href="<?php echo base_url('mine') ?>" class="dropdown-item"><span class="icon mdi mdi-face"></span> 个人中心</a>
                            <a href="<?php echo base_url('logout') ?>" class="dropdown-item"><span class="icon mdi mdi-power"></span> 退出</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="be-left-sidebar">
        <div class="left-sidebar-wrapper"><a href="#" class="left-sidebar-toggle"><?php echo $title ?></a>
            <div class="left-sidebar-spacer">
                <div class="left-sidebar-scroll">
                    <div class="left-sidebar-content">
                        <ul class="sidebar-elements">
                            <li><a title="回到首页" href="<?php echo base_url() ?>">首页</a></li>

                            <li class=parent>
                                <a href="<?php echo base_url() ?>">
                                    <i class="icon mdi mdi-home"></i><span>投票活动</span>
                                </a>
                                <ul class=sub-menu>
                                    <li><a title="投票活动列表" href="<?php echo base_url('vote') ?>">所有投票活动</a></li>
                                    <li><a title="创建投票活动" href="<?php echo base_url('vote/create') ?>">创建投票活动</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main id=maincontainer class=be-content role=main>
