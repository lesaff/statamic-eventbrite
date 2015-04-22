<?php
/**
 * Plugin_eventbrite
 * Eventbrite API integration 
 *
 * @author     Rudy Affandi <rudy@adnetinc.com>
 * @copyright  2015
 * @link       https://github.com/lesaff
 * @license    http://opensource.org/licenses/MIT
 *
 * Versions
 * 1.0.0       Initial release
 */

/* Load API client library, V1 */
include 'vendor/Eventbrite.php';

class Plugin_eventbrite extends Plugin {

  public function search()
  {

    /* Get Eventbrite login credentials from add-on settings */
    $app_name = 'eventbrite';
    $app_key  = $this->fetchConfig('app_key');
    $user_key = $this->fetchConfig('user_key');

    /* Basic Eventbrite authentication */
    $eb_client = new Eventbrite( 
      array(
        'app_key'  => $app_key, 
        'user_key' => $user_key
      )
    );

    /* Get attributes from addon */
    $keywords          = $this->fetchParam('keywords', NULL, NULL, FALSE, FALSE);
    $category          = $this->fetchParam('category', NULL, NULL, FALSE, FALSE);
    $address           = $this->fetchParam('address', NULL, NULL, FALSE, FALSE);
    $city              = $this->fetchParam('city', NULL, NULL, FALSE, FALSE);
    $region            = $this->fetchParam('region', NULL, NULL, FALSE, FALSE);
    $category          = $this->fetchParam('category', NULL, NULL, FALSE, FALSE);
    $address           = $this->fetchParam('address', NULL, NULL, FALSE, FALSE);
    $postal_code       = $this->fetchParam('postal_code', NULL, NULL, FALSE, FALSE);
    $country           = $this->fetchParam('country', NULL, NULL, FALSE, FALSE);
    $within            = $this->fetchParam('within', NULL, NULL, FALSE, FALSE);
    $within_unit       = $this->fetchParam('within_unit', NULL, NULL, FALSE, FALSE);
    $latitude          = $this->fetchParam('latitude', NULL, NULL, FALSE, FALSE);
    $longitude         = $this->fetchParam('longitude', NULL, NULL, FALSE, FALSE);
    $date              = $this->fetchParam('date', NULL, NULL, FALSE, FALSE);
    $date_created      = $this->fetchParam('date_created', NULL, NULL, FALSE, FALSE);
    $date_modified     = $this->fetchParam('date_modified', NULL, NULL, FALSE, FALSE);
    $organizer         = $this->fetchParam('organizer', NULL, NULL, FALSE, FALSE);
    $max               = $this->fetchParam('max', NULL, NULL, FALSE, FALSE);
    $count_only        = $this->fetchParam('count_only', NULL, NULL, FALSE, FALSE);
    $sort_by           = $this->fetchParam('sort_by', NULL, NULL, FALSE, FALSE);
    $page              = $this->fetchParam('page', NULL, NULL, FALSE, FALSE);
    $since_id          = $this->fetchParam('since_id', NULL, NULL, FALSE, FALSE);
    $tracking_link     = $this->fetchParam('tracking_link', NULL, NULL, FALSE, FALSE);
    $cache_length      = $this->fetchParam('cache', 18000, NULL, FALSE, FALSE);

    /* API search parameters */
    $search_params     = [
      'keywords'       => $keywords,
      'category'       => $category,
      'address'        => $address,
      'city'           => $city,
      'region'         => $region,
      'category'       => $category,
      'address'        => $address,
      'postal_code'    => $postal_code,
      'country'        => $country,
      'within'         => $within,
      'city'           => $city,
      'within_unit'    => $within_unit,
      'latitude'       => $latitude,
      'longitude'      => $longitude,
      'date'           => $date,
      'date_created'   => $date_created,
      'date_modified'  => $date_modified,
      'organizer'      => $organizer,
      'max'            => $max,
      'count_only'     => $count_only,
      'sort_by'        => $sort_by,
      'page'           => $page,
      'since_id'       => $since_id,
      'tracking_link'  => $tracking_link
    ];

    $results = $eb_client->event_search( $search_params );

    if (isset($results)) {

      $events = getNestedVars($results->events);

      $output = array(
        "events" => array()
      );

      foreach ($events as $event) {
        array_push($output["events"], $event);
      }
    }

    $this->storage->putYAML($app_name, $output);
    return $output;
  }
}

/* Associative/object array parser */
function getNestedVars($d) {
  if (is_object($d)) {
    $d = get_object_vars($d);
  }
  if (is_array($d)) {
    return array_map(__FUNCTION__, $d);
  } else {
    return $d;
  }
}