# Eventbrite Add-on for Statamic
By Rudy Affandi (2015)
Version 1.0.0

## What is this?
Eventbrite API wrapper is an add-on that allows you to display Eventbrite dataset on your Statamic site. It requires Eventbrite API and user key.

## Installation
Copy the 'add-ons/eventbrite' folder to the `_add-ons` folder in your Statamic website.
Copy the 'config/eventbrite' folder to the `_config/add-ons` folder in your Statamic website.

If you want to use enter the search parameters from fieldset, use the following as a guideline or, just include it to your existing fieldsets.
Copy the fieldset/eventbrite.yaml to the `_config/fieldsets` folder in your Statamic website. You either need to include this fieldset using the `include: ` or copy and paste what you need to your existing fieldset(s)

## How to use
Use the following tag pair in your template:

## Get event based on event ID
```
  {{ eventbrite:get id="" cache="" }}

  {{ /eventbrite:get }}
```
### Available parameters for `eventbrite:get`
- `id` Event ID
- `cache` Defaults to 18000 ms

## Search events based on parameters
```
  {{ eventbrite:search max="" city="" region=" country="" cache="" }}

  {{ /eventbrite:search }}
```
### Available parameters for `eventbrite:search`
- `keywords`
- `category`
- `address`
- `city`
- `region`
- `category`
- `address`
- `postal_code`
- `country`
- `within`
- `city`
- `within_unit`
- `latitude`
- `date`
- `date_created`
- `date_modified`
- `organizer`
- `max`
- `count_only`
- `sort_by`
- `page`
- `since_id`
- `tracking_link`
- `cache` Defaults to 18000 ms

### Available tag values
```
Event loop
{{ box_header_text_color }}
{{ locale }}
{{ link_color }}
{{ box_background_color }}
{{ timezone }}
{{ box_border_color }}
{{ logo }}

{{ organizer }} (use this as tag loop or singleton like below)
  {{ organizer:url }}
  {{ organizer:description }}
  {{ organizer:long_description }}
  {{ organizer:id }}
  {{ organizer:name }}

{{ background_color }}
{{ id }}
{{ category }}
{{ box_header_background_color }}
{{ capacity }}
{{ num_attendee_rows }}
{{ title }}
{{ start_date }}
{{ status }}
{{ description }}
{{ tags }}
{{ timezone_offset }}
{{ text_color }}
{{ title_text_color }}

{{ tickets }} (use this as tag loop or singleton like below)
  {{ ticket }}
    {{ tickets:ticket:description }}
    {{ tickets:ticket:end_date }}
    {{ tickets:ticket:min }}
    {{ tickets:ticket:max }}
    {{ tickets:ticket:price }}
    {{ tickets:ticket:visible }}
    {{ tickets:ticket:currency }}
    {{ tickets:ticket:display_price }}
    {{ tickets:ticket:type }}
    {{ tickets:ticket:id }}
    {{ tickets:ticket:include_fee }}
    {{ tickets:ticket:name }}

{{ distance }}
{{ created }}
{{ url }}
{{ box_text_color }}
{{ privacy }}

{{ venue }} (use this as tag loop or singleton like below)
  {{ venue:city }}
  {{ venue:name }}
  {{ venue:country }}
  {{ venue:region }}
  {{ venue:longitude }}
  {{ venue:postal_code }}
  {{ venue:address_2 }}
  {{ venue:address }}
  {{ venue:latitude }}
  {{ venue:country_code }}
  {{ venue:id }}
  {{ venue:Lat-Long }}

{{ modified }}
{{ logo_ssl }}
{{ repeats }}
```

## Modifiers
You can modify the output using the Statamic standard [variable modifiers](http://statamic.com/learn/documentation/variable-modifiers).