	</div>
</div>

<footer class="footer">
	<div class="container vertical-center">
		<div class="center">
			<p>7wadata.com 版权所有 © 2017-2017</p>
			<p>浙公网安备 33010000000000号</p>
			<p>联系我们: 0571-8888 8888</p>
		</div>
	</div>
</footer>
<?php if (preg_match('/upexcel/i', $_SERVER['PHP_SELF'])) {
	echo "<script src='/assets/3rd/xlsx/xlsx.full.min.js'></script>"; //  excel
	echo "<script src='/assets/3rd/xlsx/shim.js'></script>";  //  low IE version
	echo "<script src='/assets/js/user/upexcel.js'></script>";
}?>
<script src="/assets/3rd/jquery.min.js"></script>
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<script src="/assets/js/user/common.js"></script>


</body>
</html>
