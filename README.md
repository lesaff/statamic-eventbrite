# Eventbrite Add-on for Statamic
By Rudy Affandi (2015)
Version 1.0.0

## Installation
Copy the 'add-ons/eventbrite' folder to the '_add-ons' folder in your Statamic website.
Copy the 'config/eventbrite' folder to the '_config/add-ons' folder in your Statamic website.

## How to use
Use the following tag pair in your template:

### Search events based on parameters
```
   {{ eventbrite:search max="" city="" region=" country="" cache="" }}

   {{ /eventbrite:search }}
```
## Available parameters for `eventbrite:search`
- `max` Maximum number of events to display
- `city` 
- `region`
- `country`
- `cache` Defaults to 1000 ms

## Available tag values
```
Event loop
{{ box_header_text_color }}
{{ locale }}
{{ link_color }}
{{ box_background_color }}
{{ timezone }}
{{ box_border_color }}
{{ logo }}

{{ organizer }}
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

{{ tickets }}
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

{{ venue }}
  {{ city }}
  {{ name }}
  {{ country }}
  {{ region }}
  {{ longitude }}
  {{ postal_code }}
  {{ address_2 }}
  {{ address }}
  {{ latitude }}
  {{ country_code }}
  {{ id }}
  {{ Lat-Long }}

{{ modified }}
{{ logo_ssl }}
{{ repeats }}
```

## Modifiers
You can modify the output using the Statamic standard [variable modifiers](http://statamic.com/learn/documentation/variable-modifiers).