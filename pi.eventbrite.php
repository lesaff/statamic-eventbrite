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

/* Load API client library */
include 'vendor/Eventbrite.php';

class Plugin_eventbrite extends Plugin {

  public function get()
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
    $id           = $this->fetchParam('id', NULL, NULL, FALSE, FALSE);
    $cache_length = $this->fetchParam('cache', 18000, NULL, FALSE, FALSE);

    // request an event by adding a valid EVENT_ID value here:
    $results = $eb_client->event_get( array('id' => $id) );
    var_dump($results);
  }

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
    $max          = $this->fetchParam('max', NULL, NULL, FALSE, FALSE);
    $city         = $this->fetchParam('city', NULL, NULL, FALSE, FALSE);
    $region       = $this->fetchParam('region', NULL, NULL, FALSE, FALSE);
    $country      = $this->fetchParam('country', NULL, NULL, FALSE, FALSE);
    $cache_length = $this->fetchParam('cache', 18000, NULL, FALSE, FALSE);

    $search_params = [
      'max'        => $max,
      'city'       => $city,
      'region'     => $region,
      'country'    => $country
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