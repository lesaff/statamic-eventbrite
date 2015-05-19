# Eventbrite Add-on for Statamic
By Rudy Affandi (2015)
Version 2.0.0

## What is this?
Eventbrite API (V3) wrapper is an add-on that allows you to display Eventbrite dataset on your Statamic site. It requires Eventbrite API (V3) and OAuth key.

## Installation
Copy the `add-ons/eventbrite` folder to the `_add-ons` folder in your Statamic website.

Copy the `config/eventbrite` folder to the `_config/add-ons` folder in your Statamic website. Make sure to edit the `eventbrite.yaml` and enter your OAuth token. You can get your personal token from your Eventbrite account.

## How to use
Use the following tag pair in your template:

## Search events based on parameters
See http://developer.eventbrite.com/docs/event-search/ for details

```
  {{ eventbrite:search limit="" query="" organizer_id="" cache="" }}
	tags here...
  {{ /eventbrite:search }}
```
### Available parameters for `eventbrite:search`
- `query`
- `since_id`
- `sort_by`
- `popular`
- `address`
- `latitude`
- `longitude`
- `within`
- `city`
- `region`
- `country`
- `organizer_id`
- `user_id`
- `tracking_code`
- `categories`
- `formats`
- `start_date_range_after`
- `start_date_range_before`
- `start_date_keyword`
- `date_created_range_after`
- `date_created_range_before`
- `date_created_keyword`
- `date_modified_range_after`
- `date_modified_keyword`
- `date_created_keyword`
- `cache` Defaults to 18000 ms

### Available tag values

The following tags are available within the `events` tag loop.

```
{{ events }}
	{{ name }}
	{{ name:text }}
	{{ name:html }}

	{{ description }}
	{{ description:text }}
	{{ description:html }}

	{{ id }}
	{{ url }}

	{{ start }}
	{{ start:timezone }}
	{{ start:local }} returns date in ISO8601 format
	{{ start:utc }} returns date in ISO8601 format

	{{ end }}
	{{ end:timezone }}
	{{ end:local }} returns date in ISO8601 format
	{{ end:utc }} returns date in ISO8601 format

	{{ created }}
	{{ changed }}
	{{ capacity }}
	{{ status }}
	{{ currency }}
	{{ online_event }} returns either true of false

	{{ logo_id }}
	{{ organizer_id }}
	{{ venue_id }}
	{{ category_id }}
	{{ subcategory_id }}
	{{ format_id }}
	{{ subcategory }}

	{{ category }}
	{{ category:resource_uri }}
	{{ category:id }}
	{{ category:name }}
	{{ category:name_localized }}
	{{ category:short_name }}
	{{ category:short_name_localized }}

	{{ format }}
	{{ format:resource_uri }}
	{{ format:id }}
	{{ format:name }}
	{{ format:name_localized }}
	{{ format:short_name }}
	{{ format:short_name_localized }}

	{{ venue }}
	{{ venue:address }}
	{{ venue:address:address_1 }}
	{{ venue:address:address_2 }}
	{{ venue:address:city }}
	{{ venue:address:region }}
	{{ venue:address:postal_code }}
	{{ venue:address:country }}
	{{ venue:address:latitude }}
	{{ venue:address:longitude }}
	{{ venue:resource_uri }}
	{{ venue:id }}
	{{ venue:name }}
	{{ venue:latitude }}
	{{ venue:longitude }}

	{{ ticket_classes }}
	{{ ticket_classes:resource_uri }}
	{{ ticket_classes:id }}
	{{ ticket_classes:name }}
	{{ ticket_classes:description }}
	{{ ticket_classes:donation }} returns either true or false
	{{ ticket_classes:free }} returns either true or false
	{{ ticket_classes:minimum_quantity }}
	{{ ticket_classes:maximum_quantity }}
	{{ ticket_classes:maximum_quantity_per_order }}
	{{ ticket_classes:on_sale_status }}
	{{ ticket_classes:quantity_total }}
	{{ ticket_classes:quantity_sold }}
	{{ ticket_classes:sales_start }} returns date in ISO8601 format
	{{ ticket_classes:sales_end }} returns date in ISO8601 format
	{{ ticket_classes:hidden }} returns either true or false
	{{ ticket_classes:include_fee }} returns either true or false
	{{ ticket_classes:split_fee }} returns either true or false
	{{ ticket_classes:hide_description }} returns either true or false
	{{ ticket_classes:auto_hide }} returns either true or false
	{{ ticket_classes:variants }} returns array
	{{ ticket_classes:event_id }}

	{{ logo }}
	{{ logo:id }}
	{{ logo:url }}
	{{ logo:aspect_ratio }}

	{{ organizer }}
	{{ organizer:description }}
	{{ organizer:logo }}
	{{ organizer:resource_uri }}
	{{ organizer:id }}
	{{ organizer:name }}
	{{ organizer:url }}
	{{ organizer:num_past_events }}
	{{ organizer:num_future_events }}
{{ /events }}
```

## Modifiers
You can modify the output using the Statamic standard [variable modifiers](http://statamic.com/learn/documentation/variable-modifiers).

## Changelog
2.0.0 - Updated API to V3, use OAuth2.0 authentication, added PSR-1 style indentation

1.0.1 - Added caching mechanism

1.0.0 - Initial release
