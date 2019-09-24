<?php

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>




<div class="wrapper" id="wrapper-index">
	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <h1><?php echo bloginfo('description');?></h1>
          <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
              <?php wp_nav_menu(
                array(
                  'theme_location'  => 'primary',
                  'container_class' => '',
                  'container_id'    => '',
                  'menu_class'      => 'list-group list-group-flush',
                  'fallback_cb'     => '',
                  'menu_id'         => 'main-menu',
                  'depth'           => 2,
                  'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
                )
              ); ?>
              </div>
              <div class="col-lg-6">
                <h5>About DeMAND</h5>
                <p>Here is some basic about text that you can check out</p>
              </div>
            </div>
          </div>
          </div>
        </div><!-- .row -->
    </div><!-- Container end -->
</div><!-- Wrapper end -->

<?php get_footer(); ?>
