<?php
	$biz = array(
		'name' => '青岛意帮网络科技有限公司',
		'tel_public' => '400-882-0532',
		'vi_logo' => 'https://admin.517ybang.com/liuyajie.jpg',
		'vi_color_primary' => '#4cb5ff',
		'vi_color_secondary' => '#aaa',
		'url_web' => 'https://www.ybslux.com/',
	);
	$stuff = array(
		'lastname' => '刘',
		'firstname' => '亚杰',
		'title' => '技术总监&产品总监',
		'mobile' => '176-6407-3966',
	);

	$engine = 'http://qr.topscan.com/api.php?fg='.$biz['vi_color_secondary'] .'&gc='.$biz['vi_color_primary'].'&pt='.$biz['vi_color_secondary'] .'&inpt='.$biz['vi_color_primary'].'&w=320&m=10&logo='.$biz['vi_logo'].'&text=';

	$speedAdd = 'N:'.$stuff['lastname'].';'.$stuff['firstname']."\n";

	if( isset($biz['name']) ):
		$speedAdd.= 'ORG:'.$biz['name']."\n";
		$speedAdd.= 'TEL;WORK;VOICE:'.$biz['tel_public']."\n";
	else:
		$speedAdd.= 'ORG:'.$biz['name']."\n";
	endif;
	if( isset($stuff['title']) ):
		$speedAdd.= 'TITLE:'.$stuff['title']."\n";
	endif;
	$speedAdd.= 'TEL;CELL:'.$stuff['mobile']."\n";
	$speedAdd.= 'URL;WORK:'.$biz['url_web']."\n";
	
	$speedAdd = urlencode('BEGIN:VCARD'."\n".$speedAdd.'END:VCARD');
	
	echo '<img title="'.$stuff['lastname'].$stuff['firstname'].'" src="'.$engine.$speedAdd.'">';
?>