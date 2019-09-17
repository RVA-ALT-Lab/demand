<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class Heurist_API_Controller {

  public function __construct() {
    $this->heurist_url = 'https://heuristplus.sydney.edu.au/heurist/hsapi/controller/record_output.php?w=all&a=1&depth=0&q=t%3A72&db=mapan_demand&format=json&file=1&defs=1&extended=3';
    $this->namespace = 'heurist/v1';
    $this->resource = 'database';
  }

  public function init() {
    add_action('rest_api_init', array($this, 'register_routes'));
  }

  public function register_routes() {
    register_rest_route($this->namespace, '/' . $this->resource, array(
      'methods' => 'GET',
      // 'permission_callback' => array($this, 'check_is_admin'),
      'callback' => array($this, 'get_items')
    ));


  }

  public function get_items (WP_REST_Request $request) {
    try {

      $data = file_get_contents(dirname(__FILE__).'/data/database.json');
      $json = json_decode($data, true);
      return $json;

    } catch (Exception $exc) {
      return $exc;
    }
  }

}