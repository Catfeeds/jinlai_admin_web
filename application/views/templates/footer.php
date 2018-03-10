
            <p class="container bg-info text-center">使用中如发现问题，请联系刘亚杰<a class="btn btn-info" href="tel:+8617664073966"><i class="far fa-mobile"></i>176-6407-3966</a></p>
        </main>
<!-- End #maincontainer -->

		<footer id=footer role=contentinfo>
			<div id=copyright>
				<div class=container>
					<p>&copy;<?php echo date('Y') ?>

					<a title="<?php echo SITE_DESCRIPTION ?>" href="<?php echo base_url() ?>"><?php echo SITE_NAME ?></a>

					<?php if ( !empty(ICP_NUMBER)): ?>
					<a title="工业和信息化部网站备案系统" href="http://www.miitbeian.gov.cn/" target=_blank rel=nofollow><?php echo ICP_NUMBER ?></a>
					<?php endif ?>
				</div>
			</div>

			<a id=totop title="回到页首" href="#"><i class="far fa-chevron-up" aria-hidden=true></i></a>
		</footer>

		<script>
			$(function(){
				// 回到页首按钮
				$('a#totop').click(function()
				{
					$('body,html').stop(false, false).animate({scrollTop:0}, 800);
					return false;
				});
			});
		</script>
	</body>
</html>