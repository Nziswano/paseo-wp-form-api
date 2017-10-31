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
  private $db;

  private $table_name;

  /**
   * Listings constructor.
   */
  public function __construct()
  {
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

    return $contact;
  }
}


/**
 * $charset_collate = $wpdb->get_charset_collate();
$table_name = $wpdb->prefix . DB_TABLE;

$sql = "CREATE TABLE $table_name (
id mediumint(9) NOT NULL AUTO_INCREMENT,
fingerprint VARCHAR(75) NOT NULL,
contact_info JSON,
created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
UNIQUE KEY id (id)
 */
