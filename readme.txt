=== Plugin Name ===
Contributors: guavaworks, elvismdev, fatmedia
Donate link: http://www.codecavalry.com/royboy789
Tags: angularjs, client side, single page application, chat, chat room, chatroom, firebase
Requires at least: 4.0
Tested up to: 4.3.1
Stable tag: 3.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Use the Chat Rooms plugin to have chat rooms added to your site, powered by Firebase and AngularJS.

== Description ==

Powered by the [AngularJS for WP](https://wordpress.org/plugins/angularjs-for-wp/) plugin and [Firebase](https://www.firebase.com), add real time communication to your site, for free. Create a new chat room (custom post type) and off you go!

* Fully CSS customizable  
* Template powered - just copy the template file in the template directory into your theme - firebase-chat/chatroom.php and override as you need.


== Installation ==

1. Download zipped archive of plugin
1. Log into your WordPress dashboard and add the new plugin via upload
1. Activate the plugin
1. Make sure you have the JSON REST API v2 (WP-API) and AngularJS for WordPress plugin activated
1. Click on Chat Settings in the menu and add your Firebase URL


== Frequently Asked Questions ==

= Why use AngularJS? =

AngularJS renders your posts client-side. WordPress is built on PHP, so every page a user visits is converted to HTML on the server, then served to the client. With ANgularJS you are only getting a JSON Object (text) from the server
then renderring that to HTML using the client's machine. This will speed up your pages as well as allow for more concurrent visitors to your site as the strain on the server is reduced.

== Screenshots ==

Nothing here yet

== Changelog ==

= 1.0 =
* Initial Build

= 1.1 =
* Adding Shortcode

= 2.0 =
* Fixed Security Issues
* Adding Template ability
* Better Scripting

= 3.0 =
* Adding in API v2 support