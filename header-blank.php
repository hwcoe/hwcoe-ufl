<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<?php include get_template_directory() . '/inc/google-analytics.php'; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width,initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class('loading'); // Enable JS transitions ?>>
