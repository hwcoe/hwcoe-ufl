<?php 
	$opt_analytics_acct = get_theme_mod( 'analytics_acct', false );
	if ( $opt_analytics_acct && !is_user_logged_in () ):
?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $opt_analytics_acct; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo $opt_analytics_acct; ?>');
</script>


<?php endif; ?>