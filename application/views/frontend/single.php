<?php include_once('head.php');?>
<body class="skin-green layout-top-nav">
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-64290505-1', 'auto');
  ga('send', 'pageview');

</script>
	<div class="wrapper">
		<?php include_once('nav.php');?>
		<div class="content-wrapper bg-batik">
			<div class="container" style="padding:15px 15px; background-color:#FFF !important;">
				<?php echo (isset($content)) ? $content : "";?>		
			</div>
		</div>
		<?php include_once('foot.php');?>
		
	</div>
</div>

</html>