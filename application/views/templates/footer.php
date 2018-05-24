
        </main>
<!-- End #maincontainer -->

		<footer id=footer role=contentinfo>
            <div class="container">
                <ul id="quick-reference">
                    <li>IP <?php echo $this->input->ip_address() ?></li>
                    <li>UserAgent <?php echo $_SERVER['HTTP_USER_AGENT'] ?></li>
                    <li>企业邮箱（阿里云）https://qiye.aliyun.com <a class="style-inline" href="https://qiye.aliyun.com"><i class="far fa-external-link"></i></a></li>
                </ul>
            </div>

			<div id=copyright>
				<div class=container>
					<p>&copy;<?php echo date('Y') ?>

					<a title="<?php echo SITE_DESCRIPTION ?>" href="<?php echo base_url() ?>"><?php echo SITE_NAME ?></a>

					<?php if ( !empty(ICP_NUMBER)): ?>
					<a title="工业和信息化部网站备案系统" href="http://www.miitbeian.gov.cn/" target=_blank rel=nofollow><?php echo ICP_NUMBER ?></a>
					<?php endif ?>
				</div>
			</div>
		</footer>

        <a id=totop title="回到页首" href="#"><i class="far fa-chevron-up" aria-hidden=true></i></a>

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