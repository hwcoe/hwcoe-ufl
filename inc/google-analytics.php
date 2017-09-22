<?php 
	$opt_analytics_acct = get_theme_mod( 'analytics_acct', false );
	if ( $opt_analytics_acct && !is_user_logged_in () ):
?>
<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $opt_analytics_acct; ?>', 'auto');
  ga('send', 'pageview');
</script>
<?php endif; ?>