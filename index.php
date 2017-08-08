<!doctype html>
<html lang=zh-cn>
	<head>
		<meta charset=utf-8>
		<meta http-equiv=x-dns-prefetch-control content=on>
		<!--<link rel=dns-prefetch href="https://cdn.key2all.com">-->
		<title>进来商城流量数据</title>
		<meta name=description content="<?php echo $description ?>">
		<meta name=keywords content="<?php echo $keywords ?>">
		<meta name=version content="revision20170725">
		<meta name=author content="刘亚杰Kamas">
		<meta name=copyright content="青岛意帮网络科技有限公司">
		<meta name=contact content="kamaslau@dingtalk.com">

		<meta name=viewport content="width=device-width,user-scalable=0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<script src="https://cdn.key2all.com/js/jquery/new.js"></script>
		<script defer src="/js/highcharts-5.0.12.js"></script>
		<!--<script defer src="/js/xx.js"></script>-->
		<!--<script asnyc src="/js/xx.js"></script>-->

		<link rel=stylesheet media=all href="https://cdn.key2all.com/css/reset.css">
		<!--<link rel=stylesheet media=all href="https://cdn.key2all.com/bootstrap/css/bootstrap-3_3_7.min.css">-->
		<link rel=stylesheet media=all href="https://cdn.key2all.com/flat-ui/css/flat-ui.min.css">
		<link rel=stylesheet media=all href="https://cdn.key2all.com/font-awesome/css/font-awesome.min.css">
		<style>
			.container {padding:0;/* 去掉BootStrap默认的左右内边距 */}

			/* 修复BootStrap样式 */
				ul,ol {margin-bottom:0;}
				.row {margin-left:0;margin-right:0;}
					.row>* {padding-left:0;padding-right:0;}
				.label {margin-right:1rem;}
					.label>a {color:#fff;}
				.panel-body {padding:15px 45px;}
		</style>
	</head>

	<body>
		<main id=main-container>
			<div class=container>
				<section class=row>
					<figure id=chart-main class="col-xs-12 col-md-6 col-lg-4"></figure>
				</section>
				
				<section class=row>
					<figure id=chart-vice class="col-xs-12 col-md-6 col-lg-4"></figure>
				</section>
				
				<section class=row>
					<figure id=demo class="col-xs-12 col-md-6 col-lg-4"></figure>
				</section>
			</div>
		</main>

	<script>
//alert('您正在查看敏感数据，请注意数据安全性');
$(function(){
	// Highcharts全局配置
	var theme_colors = ['#348ea9', '#53bb9b', '#f48c37', '#9fa0a0', '#b5b5b5', '#8085e9', '#f15c80', '#e4d354']; // 常用颜色
	Highcharts.setOptions({
        global: {
            useUTC: false
        },
		credits: {
            enabled: false
        },
	    tooltip: {
	        shared: true
	    },
		colors: theme_colors,
		xAxis: {
			gridLineColor: theme_colors[4],
			gridLineDashStyle: 'ShortDash',
			gridLineWidth: 1,
			crosshair: true,
		},
		yAxis: {
			gridLineColor: theme_colors[4],
			gridLineDashStyle: 'ShortDash',
			gridLineWidth: 1,
			lineWidth: 1,
			crosshair: true,
			softMax: 500,
		},
    });
		
	// 商家数据图
	var chart_main = Highcharts.chart(
		'chart-main',
		{
	    chart: {
	        zoomType: 'xy'
	    },
	    title: {
	        text: '进来商城流量数据'
	    },
	    xAxis: [{
	        categories: ['10min', '9min', '8min', '7min', '6min', '5min', '4min', '3min', '2min', '1min'],
			labels: {
				padding: 18,
				style: {
					"color": theme_colors[3],
					"fontSize": "18px"
				}
			},
	    }],
	    yAxis: [
			{ // 右Y轴(左)
		        labels: {
		            format: '{value}',
		            style: {
		                color: Highcharts.getOptions().colors[1]
		            }
		        },
				title: {
		            text: '商家总流量',
					text: null,
		            style: {
		                color: Highcharts.getOptions().colors[1]
		            }
		        },
				lineColor: Highcharts.getOptions().colors[1],
				opposite: true
		    },
			{ // 左Y轴
		        title: {
		            text: '商家总咨询量',
					text: null,
		            style: {
		                color: Highcharts.getOptions().colors[0]
		            }
		        },
		        labels: {
		            format: '{value}',
		            style: {
		                color: Highcharts.getOptions().colors[0]
		            }
		        },
				lineColor: Highcharts.getOptions().colors[0],
		    },
			
			{ // 右Y轴(右)
		        title: {
		            text: '平台总流量',
					text: null,
		            style: {
		                color: Highcharts.getOptions().colors[2]
		            }
		        },
		        labels: {
		            format: '{value}',
		            style: {
		                color: Highcharts.getOptions().colors[2]
		            }
		        },
				lineColor: Highcharts.getOptions().colors[2],
		        opposite: true,
		    }
		],
	    legend: {
	        //layout: 'vertical',
	        //align: 'left',
	        //x: 44,
	        //verticalAlign: 'top',
	        //y: 44,
	       	//floating: true,
			align: 'center',
	        verticalAlign: 'top',
	        x: 0,
	        y: 20,
	        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#fff'
	    },
		plotOptions: {
		        column: {
		            dataLabels: {
		                enabled: true,
						//enabled: false,
						color: Highcharts.getOptions().colors[0]
		            }
		        }
		    },
	    series: [
			{
		        name: '商家总咨询量',
		        type: 'column',
				color: Highcharts.getOptions().colors[0],
		        data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 14.5, 18.2, 21.5],
		        tooltip: {
		            valueSuffix: ' 万人次'
		        },
				yAxis: 1,
		    },
			{
		        name: '平台总流量',
		        type: 'spline',
				color: Highcharts.getOptions().colors[2],
		        data: [69.9, 87.5, 186.4, 178.2, 164.0, 246.0, 173.6, 178.2, 189.0, 224.0],
		        tooltip: {
		            valueSuffix: ' 万人次'
		        },
				yAxis: 2,
		    },
			{
		        name: '商家总流量',
		        type: 'spline',
				color: Highcharts.getOptions().colors[1],
		        data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 129.2, 144.0, 176.0],
		        tooltip: {
		            valueSuffix: ' 万人次'
		        },
		    },
		]
	});
	


	var refresh_interval = 1000 * 5; // 更新间隔毫秒数
		// 动态更新线形图
	    Highcharts.chart(
			'chart-vice',
			{
	        chart: {
	            type: 'spline',
	            animation: Highcharts.svg, // don't animate in old IE
	            marginRight: 10,
	            events: {
	                load: function () {
	                    // set up the updating interval
	                    var series = this.series[0];
	                    setInterval(function () {
	                        var x = (new Date()).getTime(), // current time
	                            y = Math.random() * 10;
	                        series.addPoint([x, y], true, true);
	                    }, refresh_interval);
	                }
	            }
	        },
			credits: {
                enabled: false
            },
	        title: {
	            text: '平台商家实时咨询量'
	        },
	        xAxis: {
	            type: 'datetime',
	            tickPixelInterval: 150
	        },
	        yAxis: {
	            title: {
	                //text: '咨询量'
					text: null
	            },
	            plotLines: [{
	                value: 0,
	                width: 1,
	                color: '#aaa'
	            }]
	        },
	        tooltip: {
	            formatter: function () {
	                return '<b>' + this.series.name + Highcharts.numberFormat(this.y, 0) + '次</b><br>' + Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x);
	            }
	        },
	        legend: {
	            enabled: false
	        },
	        exporting: {
	            enabled: false
	        },
	        series: [{
	            name: '实时咨询量',
	            data: (function () {
	                // generate an array of random data
	                var data = [],
	                    time = (new Date()).getTime(),
	                    i;

	                for (i = -19; i <= 0; i += 1) {
						// 生成一个随机数
						var data_y = Math.round( Math.random() * 7 );

	                    data.push({
	                        x: time + i * refresh_interval,
	                        y: data_y
	                    });
	                }
	                return data;
	            }())
	        }]
	    });
	

}); // end jQuery
	</script>

	</body>

</html>