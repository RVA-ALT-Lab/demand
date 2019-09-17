<?php
/**
 * Template Name: Heurist Template
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<?php if ( is_front_page() && is_home() ) : ?>
	<?php get_template_part( 'global-templates/hero', 'none' ); ?>
<?php endif; ?>

<div class="jumbotron header-img" style="background-image: linear-gradient(
      rgba(0, 0, 0, 0.45),
      rgba(0, 0, 0, 0.45)
    ), url(<?php echo get_the_post_thumbnail_url(); ?>);">

<div class="header-text">
	<h1><?php the_title(); ?></h1>
</div>

</div>


<div class="wrapper" id="wrapper-index">
	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">
        <div class="row">
            <div class="col-lg-8">
        <div class="container" id="heurist">
        	<div class="row">
	        	<div class="col-md-3">
              <h2>Search</h2>
              <ul class="list-group">
                <li  class="list-group-item" v-for="type in database.rectypes">
                  <input type="checkbox" v-model="typeFacets" :value="type.name">
                  {{type.name}} <span class="badge badge-pill badge-secondary">{{type.count}}</span>
                </li>
              </ul>
	        	</div>
		        <div class="col-md-9">
              <div v-for="record in filteredRecords" class="card">
                <div class="card-body">
                  <h5 class="card-title">{{record.rec_Title}}</h5>
                  <p>{{record.rec_RecType.name}}</p>
                  <table class="table">
                    <thead>Details</thead>
                    <tr v-for="thing in record.details" v-if="thing.">
                      <td>{{thing.fieldName}}</td>
                      <td>{{thing.value}}</td>
                    </tr>
                  </table>
                </div>
              </div>
		        </div>
		     </div>
	    </div>
            </div>
            <!-- Sidebar brings in col-md-4 automatically, does not need container -->
            <?php get_template_part( 'global-templates/right-sidebar-check' ); ?>
        </div><!-- .row -->
    </div><!-- Container end -->
</div><!-- Wrapper end -->

<?php get_footer(); ?>
