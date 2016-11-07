<!DOCTYPE html>
<html lang="zh-TW" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">

<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head();?>
</head>
<body itemscope="itemscope" itemtype="http://schema.org/Blog">
<div class="mdl-layout mdl-js-layout ">
      <header class="mdl-layout__header mdl-layout__header--scroll">
         <div class="mdl-layout__header-row">
         <!-- Title -->
            <span class="mdl-layout-title"><?php echo get_bloginfo('name'); ?></span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation -->
			<?php Mxp_theme::mxp_theme_get_custom_menu('main-menu');?>
            <!-- Navigation -->
             <!--Search-->
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable mdl-textfield--floating-label mdl-textfield--align-right mdl-textfield--full-width">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search-field">
              <i class="material-icons">search</i>

            </label>
            <div class="mdl-textfield__expandable-holder">
            <form id="search" method="get" action="<?php echo home_url('/'); ?>">
              <input class="mdl-textfield__input" placeholder="搜尋" type="text" name="s" id="search-field">
              </form>
          </div>
          <!--Search-->
         </div>
      </header>
      <div class="mdl-layout__drawer">
         <span class="mdl-layout-title"><?php echo get_bloginfo('name'); ?></span>
         <!-- Navigation -->
		 <?php Mxp_theme::mxp_theme_get_custom_menu('side-menu');?>
         <!-- Navigation -->
      </div>
      <main class="mdl-layout__content">
         <div class="page-content">
