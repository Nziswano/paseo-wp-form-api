<?php
/**
 * Created by IntelliJ IDEA.
 * User: themartins
 * Date: 2017/10/31
 * Time: 23:28
 */

namespace Paseo\Admin\Listings;


class Listings
{
  /**
   * @var \wpdb
   */
  private $db;

  /**
   * @var string
   */
  private $table_name;

  /**
   * @var singleton
   */
  private static $listing = null;

  /**
   * Listings constructor.
   */
  private function __construct() {
    global $wpdb;
    $this->db = $wpdb;
    $this->table_name = $wpdb->prefix . \DB_TABLE;
  }

  /**
   * Get list of contact-us entries
   * @return mixed
   */
  public function getList() {
    $list = $this->wpdb->get_results('SELECT * FROM '. $this->table_name);
    return $list;
  }

  /**
   * Get one contact
   * @param $contact_id
   * @return mixed
   */
  public function getContact( $contact_id ) {
    $query = "SELECT * FROM " . $this->table_name . " WHERE id = %d";
    $contact = $this->db->get_row( $this->db->prepare( $query, $contact_id));
    return $contact;
  }

  /**
   * @param $contact_id
   * @return false|int
   */
  public function updateContact( $contact_id ) {

    $result = $this->db->update(
      $this->table_name,
      array(
        'is_processed' => 1
      ),
      array( 'id' => $contact_id),
    array( '%d' ),
      array('%')
    );

    return $result;
  }

  /**
   * Process rest request
   * @param \WP_REST_Request $request
   * @return \WP_REST_Response
   */
  public static function process_listings( \WP_REST_Request $request ) {
    $result = new \WP_REST_Response();
    if( self::$listing == NULL ) {
      self::$listing = new Listings();
    }

    if ( GET == $request->get_method() ) {
      $result->set_data( self::$listing->getList());
    }

    return $result;
  }
}
