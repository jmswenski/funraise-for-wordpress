# Funraise For Wordpress

The Funraise For Wordpress plugin makes it easier to embed Funraise Giving Forms on your wordpress based website.

## Features

* Use as a true widget in any widgetized area of your templates
* Use the widget anywhere via a shortcode [funraise form_id="123"]


## Usage

Install the plugin by downloading a zipped version of the project and
uploading the zip file to your Wordpress installation. Once the plugin is installed, a new Funraise menu item should
appear in Wordpress admin. You need to enter or organization UUID on this screen. 

You can then use the Funraise for Wordpress plugin as a normal Wordpress widget and drag it into any 
widgetized area of your chosen template. You can also use a shortcode to add it to any content area of 
your Wordpress (posts or pages).

Here is an example shortcode for adding the widget:

[funraise form_id="11" structured_state_country="true" default_button="true" popup="true"]

You must specify the form_id, but the rest of the parameters are optional. 

structured_state_country: [true/false] - enables or disabled structured state and country picklists for 
the donor address.

default_button: [true/false] - enableds or disables the default funraise button widget for popup forms. You should set this to false if you want to use your own custom buttons to launch the form in popup mode.

popup: [true/false] - toggles the Funraise Giving Form between popup and embedded mode.


If you want to add multiple buttons to a page or add a custom donate button, you can use the following shortcode.
You must supply the form_id, but the remainder parameters are optional.

[funraise-button form_id="11" text="DONATE" amount="5" class="styleclasses"]

text: [string] - customizes the text that is on the button

amount: [number] - allows you to default an amount when the button is clicked

class: [string] - allows you to supply custom CSS classes to style the button



## License

The Funraise For Wordpress plugin is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

> You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

## Changelog

### 1.0 (October 5, 2016)

* Official Release

## Author Information

This plugin was authored by [Jason Swenski](https://github.com/jmswenski) using 
The WordPress Widget Boilerplate project by [Tom McFarlin](http://twitter.com/tommcfarlin/) as a basis.  
