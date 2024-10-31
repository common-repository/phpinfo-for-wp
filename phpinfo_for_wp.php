<?php
/*
Plugin Name: PHPInfo for WP
Plugin URI: http://www.netbomber.com
Description: A plugin to show your server's php info page. Can be useful for testing purposes.
Version: 1.0
Author: netbomber.com
Author URI: http://www.netbomber.com
License: GPL 2 
Copyright 2011 netbomber.com  (email : getphpinfo@netbomber.com)
*/
/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_menu', 'gpi_add_page_fn');

function gpi_add_page_fn() {
	add_options_page('PHP Info', 'PHP Info', 'administrator', __FILE__, 'gpi_options_page_fn');
}

function gpi_get_ad(){
	$prod_ver = base64_encode("1.0");
	$prod_name = base64_encode("Get PHP Info");
	$adcode = wp_remote_fopen('http://www.netbomber.com/supportinfo.php?id='.$prod_name.'&v='.$prod_ver);
	return $adcode;
}

function gpi_options_page_fn() {
	echo '<div class="wrap">';
	echo '<div class="icon32" id="icon-options-general"><br /></div>';
	echo '<h2>Get Server PHP Information</h2>';
	if(strlen($adcode)>0){
	echo $adcode;
	}
	$adcode = gpi_get_ad();
	if(strlen($adcode)>0){
	echo $adcode;
	}
	phpinfo();
	echo '</div>';
}