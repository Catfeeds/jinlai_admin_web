<link rel=stylesheet media=all href="<?php echo CDN_URL ?>highcharts/v6.0.7/highcharts.css">
<style>

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

<script defer src="<?php echo CDN_URL ?>highcharts/v6.0.7/highcharts.js"></script>

<div id=breadcrumb>
	<ol class="breadcrumb container">
		<li><a href="<?php echo base_url() ?>">首页</a></li>
		<li class=active><?php echo $this->class_name_cn ?></li>
	</ol>
</div>

<div id=content class=container>
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

<script>
    // 图表所需数据
    var data_pv_total = <?php echo $items['data_pv_total'] ?>;
    var data_uv_total = <?php echo $items['data_uv_total'] ?>;
    var data_uv_biz = <?php echo $items['data_uv_biz'] ?>;
    var data_order_total = <?php echo $items['data_order_total'] ?>;

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
			softMax: 15,
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
	        text: '进来商城主要数据概览'
	    },
	    xAxis: [{
	        categories: ['50min', '45min', '40min', '35min', '30min', '25min', '20min', '15min', '10min', '5min'],
			labels: {
				padding: 18,
				style: {
					"color": theme_colors[3],
					"fontSize": "18px"
				}
			}
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
		            text: '平台总订单量',
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
				lineColor: Highcharts.getOptions().colors[0]
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
		        opposite: true
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
		        name: '平台总订单量',
		        type: 'column',
				color: Highcharts.getOptions().colors[0],
		        data: data_order_total,
		        tooltip: {
		            valueSuffix: ' 单'
		        },
				yAxis: 1
		    },
			{
		        name: '平台总流量',
		        type: 'spline',
				color: Highcharts.getOptions().colors[2],
		        data: data_uv_total,
		        tooltip: {
		            valueSuffix: ' 人次'
		        },
				yAxis: 2
		    },
			{
		        name: '商家总流量',
		        type: 'spline',
				color: Highcharts.getOptions().colors[1],
		        data: data_uv_biz,
		        tooltip: {
		            valueSuffix: ' 人次'
		        }
		    }
		]
	});

    // 动态更新线形图
    var refresh_interval = 1000 * 5; // 更新间隔毫秒数
    var url_api = 'https://api.517ybang.com/data/detail'
    var params = {'id':1}
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
                    setInterval(
                        function (){
                            $.post(
                                url_api, // API URL
                                params, // API参数
                                function(data){
                                    var x = (new Date()).getTime(), // current time
                                        y = Number(data.content.value);
                                    series.addPoint([x, y], true, true);
                                }, // 对返回数据进行处理
                                'json' // 对返回数据以JSON格式进行解析
                            );
                        },
                        refresh_interval
                    );
                }
            }
        },
        credits: {
            enabled: false
        },
        title: {
            text: '平台实时页面浏览量'
        },
        subtitle: {
            text: '不含商家中心、管理中心'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150
        },
        yAxis: {
            title: {
                //text: '浏览量'
                text: null
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#ddd'
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
                    var data_y = data_pv_total[(i+19)];

                    data.push({
                        x: time + i * refresh_interval,
                        y: data_y
                    });
                }
                return data;
            }())
        }]
    });

});
</script>