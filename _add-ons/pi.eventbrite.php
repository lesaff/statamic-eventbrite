<?php
/**
 * Plugin_eventbrite
 * Eventbrite API integration 
 *
 * @author     Rudy Affandi <rudy@adnetinc.com>
 * @copyright  2015
 * @link       https://github.com/lesaff/statamic-eventbrite
 * @license    http://opensource.org/licenses/MIT
 *
 * Versions
 * 2.0.0       Updated API to V3, use OAuth2.0 authentication, added PSR-1 style indentation
 * 1.0.1       Added caching mechanism
 * 1.0.0       Initial release
 */

/* Autoload dependencies */
require 'vendor/Eventbrite.php';

class Plugin_eventbrite extends Plugin
{

  public function search()
  {
    /* Get Eventbrite login credentials from add-on settings */
    $app_name           = 'eventbrite';
    $api_auth_endpoint  = 'https://www.eventbrite.com/oauth/authorize';
    $api_token_endpoint = 'https://www.eventbrite.com/oauth/token';
    $api_endpoint       = 'https://www.eventbriteapi.com/';
    $api_version        = 'v3';
    $api_method         = '/events/search';
    $app_key            = $this->fetchConfig('app_key');
    $client_secret      = $this->fetchConfig('client_secret');
    $oauth_token        = $this->fetchConfig('oauth_token', NULL, NULL, FALSE, FALSE);

    /* Eventbrite OAuth2.0 authentication */
    $eb_client = new Eventbrite(array('access_token' => $oauth_token));

    /* Get attributes from addon */
    $q                            = $this->fetchParam('query', NULL, NULL, FALSE, FALSE);
    $since_id                     = $this->fetchParam('since_id', NULL, NULL, FALSE, FALSE);
    $sort_by                      = $this->fetchParam('sort_by', NULL, NULL, FALSE, FALSE);
    $popular                      = $this->fetchParam('popular', 'false', NULL, FALSE, FALSE);
    $location_address             = $this->fetchParam('address', NULL, NULL, FALSE, FALSE);
    $location_latitude            = $this->fetchParam('latitude', NULL, NULL, FALSE, FALSE);
    $location_longitude           = $this->fetchParam('longitude', NULL, NULL, FALSE, FALSE);
    $location_within              = $this->fetchParam('within', NULL, NULL, FALSE, FALSE);
    $venue_city                   = $this->fetchParam('city', NULL, NULL, FALSE, FALSE);
    $venue_region                 = $this->fetchParam('region', NULL, NULL, FALSE, FALSE);
    $venue_country                = $this->fetchParam('country', NULL, NULL, FALSE, FALSE);
    $organizer_id                 = $this->fetchParam('organizer_id', NULL, NULL, FALSE, FALSE);
    $user_id                      = $this->fetchParam('user_id', NULL, NULL, FALSE, FALSE);
    $tracking_code                = $this->fetchParam('tracking_code', NULL, NULL, FALSE, FALSE);
    $categories                   = $this->fetchParam('categories', NULL, NULL, FALSE, FALSE);
    $formats                      = $this->fetchParam('formats', NULL, NULL, FALSE, FALSE);
    $start_date_range_start       = $this->fetchParam('start_date_range_after', NULL, NULL, FALSE, FALSE);
    $start_date_range_end         = $this->fetchParam('start_date_range_before', NULL, NULL, FALSE, FALSE);
    $start_date_keyword           = $this->fetchParam('start_date_keyword', NULL, NULL, FALSE, FALSE);
    $date_created_range_start     = $this->fetchParam('date_created_range_after', NULL, NULL, FALSE, FALSE);
    $date_created_range_end       = $this->fetchParam('date_created_range_before', NULL, NULL, FALSE, FALSE);
    $date_created_keyword         = $this->fetchParam('date_created_keyword', NULL, NULL, FALSE, FALSE);
    $date_modified_range_start    = $this->fetchParam('date_modified_range_after', NULL, NULL, FALSE, FALSE);
    $date_modified_range_end      = $this->fetchParam('date_modified_range_before', NULL, NULL, FALSE, FALSE);
    $date_modified_keyword        = $this->fetchParam('date_modified_keyword', NULL, NULL, FALSE, FALSE);
    $cache_length                 = $this->fetchParam('cache', 18000, NULL, FALSE, FALSE);

    /* API search parameters */
    $search_params = [
      'q'                         => $q,
      'since_id'                  => $since_id,
      'sort_by'                   => $sort_by,
      'popular'                   => $popular,
      'location.address'          => $location_address,
      'location.latitude'         => $location_latitude,
      'location.longitude'        => $location_longitude,
      'location.within'           => $location_within,
      'venue.city'                => $venue_city,
      'venue.region'              => $venue_region,
      'venue.country'             => $venue_country,
      'organizer.id'              => $organizer_id,
      'user.id'                   => $user_id,
      'tracking_code'             => $tracking_code,
      'categories'                => $categories,
      'formats'                   => $formats,
      'start_date.range_start'    => $start_date_range_start,
      'start_date.range_end'      => $start_date_range_end,
      'start_date.keyword'        => $start_date_keyword,
      'date_created.range_start'  => $date_created_range_start,
      'date_created.range_end'    => $date_created_range_end,
      'date_created.keyword'      => $date_created_keyword,
      'date_modified.range_start' => $date_modified_range_start,
      'date_modified.range_end'   => $date_modified_range_end,
      'date_modified.keyword'     => $date_modified_keyword,
    ];

    $results = $eb_client->search( $search_params );

    if (isset($results)) {

      $events = getNestedVars($results->events);

      $output = array(
        "events" => array()
      );

      foreach ($events as $event) {
        array_push($output["events"], $event);
      }
    }

    /* Cache results */
    $this->cache->putYAML($app_name, $output);

    /* Check the cache first */
    $cached_events = $this->cache->getYAML($app_name, $output);

    if ($cached_events) {
        // If there's a cache and it's older than our specified time, delete it. It'll be recreated later.
        if ($this->cache->getAge($app_name) >= $cache_length) {
            $this->cache->delete($app_name);
        }
        // There's a cache and its still new enough? Use that.
        else {
            return $cached_events;
        }
    }
    return Parse::tagLoop($this->content, $cached_events, true, $this->context);
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