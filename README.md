# geographic_centroid_of_a_city
A small piece of code which identifies the resident geographic centroid of a city from a database.
The goal of this script is to found the coordinate of a point where there is the minimal distance as the crow flies for the maximum amount of people. The example code is built around the city of Estavayer-le-lac in Switzerland. The code divide the city into zones and addresses wich are stored into the database to customize the query. 

To make it work you need to have:
- A Linux Server with Curl and PhpMyAdmin preinstalled
- A Database with all addresses, zone and resident of your city.
- Google api key for Geocode
- Google api key for Javascript

Differents languages used:
HTML, CSS, PHP, MYSQL, JAVASCRIPT

Installation:
- Manage a LAMP Server with Curl (for asynchronous query)
- Create your Database with zone.sql and add data (resident per address and addresses and zone)
- Update username and password in database.php with your current pswd and usrname from your db
- Get all API keys and update it into zones.php (Geocode is stocked into a php variable, Javascript is on a link for the map)
- Update the data in your database for getting lattitude and longitude (currently you have to decomment into zones.php)
- Enjoy! and discover

