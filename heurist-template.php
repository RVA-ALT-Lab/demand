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
            <div class="col-lg-12">
        <div class="container" id="heurist">

          <div class="row" id="search-interface">
            <div class="col-lg-12">
            <p>Select a record type:</p>
            <select name="recordTypes" id="recordTypes" v-model="selectedRecordType">
              <option v-for="type in database.rectypes" :value="type.name">{{type.name}}</option>
            </select>
            <div v-if="selectedRecordType">
            <p>Select a detail:</p>
              <select name="recordDetailTypes" id="recordDetailTypes" v-model="selectedDetail" >
                <option v-for="detail in selectedRecordDetails" :value="detail.fieldName">{{detail.fieldName}}</option>
              </select>

              <div>
              <p>Select a value:</p>
              <select name="selectedDetailValues" id="selectedDetailValues" >
                <option v-for="value in selectedDetailValues" :value="value">{{value}}</option>
              </select>
              <p>Or, enter a free text search</p>
              <input type="text" name="" id="">
              <button class="btn btn-primary">Show Results</button>
              </div>
            </div>
          </div>

          </div>
          <div class="row" id="records-display">
            <div class="col-lg-12">

            </div>
          </div>
          <div class="row">
	        	<div class="col-md-3">
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
                    <tr v-for="thing in record.details">
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
        </div><!-- .row -->
    </div><!-- Container end -->
</div><!-- Wrapper end -->

<?php get_footer(); ?>
