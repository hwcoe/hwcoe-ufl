<!-- ufl-secondary-quote module -->
<div class="content-box-module content-box-module--tweet">
	<div class="container">
		<div class="row">
		<div class="col-sm-6 col-sm-push-6 col-md-5 col-md-push-5 content-box-img" style="background-image:url(<?php esc_url( the_sub_field( 'image' ) ); ?>)">
				<div class="tweet-block">
					<div class="tweet-copy">
					<p><?php esc_html_e( the_sub_field( 'quote_text' ) ); ?></p>
					<?php if ( get_sub_field( 'quote_source' ) ) : ?>
						<div class="tweet-meta">
							<a href="<?php esc_url( the_sub_field( 'quote_source_url' ) ); ?>" class="twitter-name"><?php esc_html_e( the_sub_field( 'quote_source' ) ); ?></a>
						</div>
					<?php endif ?>
					</div>
					<?php if ( get_sub_field( 'quote_category' ) ) : ?>
						<a href="<?php esc_url( the_sub_field( 'quote_category_link' ) ); ?>" class="category-tag"><?php esc_html_e( the_sub_field( 'quote_category' ) ); ?></a>
					<?php endif ?>
				</div>
			</div>
			<div class="col-sm-6 col-sm-pull-6 col-md-5 col-md-pull-5 content-box-copy">
				<h2><?php esc_html_e( the_sub_field( 'headline' ) ); ?></h2>
				<?php wp_kses_post( the_sub_field( 'content' ) ); ?>
			</div>
		</div>
	</div>
</div>

