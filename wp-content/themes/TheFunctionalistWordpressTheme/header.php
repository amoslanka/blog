<?php require 'helpers.php'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=7, IE=9">
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    
	<title><?php wp_title( ' --- ', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ) ?></title>
    <meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <link href="<?php bloginfo('template_url'); ?>/mobile.css" media="only screen and (max-device-width: 480px) and (-webkit-min-device-pixel-ratio: 2)" rel="stylesheet">
    <link href="<?php bloginfo('template_url'); ?>/mobile.css" media="only screen and (max-device-width: 1024px)" rel="stylesheet">
    
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
    <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js.js"></script>
    <?php wp_head(); ?>
</head>
<body class="<?php sandbox_body_class(true); ?>">
    <div id="container">
        <div id="title">
            <div id="titleleft"></div>
            <h1><a href="<?php bloginfo('url'); ?>"><?php bloginfo('title'); ?></a></h1>
            <div id="titleright"></div>
        </div>
        -