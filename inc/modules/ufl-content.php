<!-- ufl-content module -->
<div class="container content-wrap">
	<div class="row">
		<div class="col-sm-12">
			 <?php echo wpautop( wp_kses_post( get_sub_field( 'content' ) ) ); ?>
		</div>
	</div>
</div><!-- content-wrap -->
