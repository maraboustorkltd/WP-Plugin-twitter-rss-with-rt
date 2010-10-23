<?php
/*
Plugin Name: TwitterRSSWithRT
Plugin URI: http://maraboustork.co.uk/index.php/2010/10/add-retweets-to-your-twitter-blogs/
Description: Add retweets to your twitter rss feed
Version: 1.0.1
Author: MarabouStork
Author URI: http://MarabouStork.co.uk
*/

#
#  Copyright (c) 2007-2010 MarabouStork
#
#  This file is part of TwitterRSSWithRT
#
#  TwitterRSSWithRT is free software; you can redistribute it and/or modify it under
#  the terms of the GNU General Public License as published by the Free
#  Software Foundation; either version 2 of the License, or (at your option)
#  any later version.
#
#  TwitterRSSWithRT is distributed in the hope that it will be useful, but WITHOUT ANY
#  WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
#  FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more
#  details.
#
#  You should have received a copy of the GNU General Public License along
#  with TwitterRSSWithRT; if not, write to the Free Software Foundation, Inc., 59
#  Temple Place, Suite 330, Boston, MA 02111-1307 USA
#

function get_tweets_with_rt($username, $maxTweets, $elementId) {
		
	echo "<script type='text/javascript'>
				$(document).ready(function() {
	   			GetTwitterFeedIncRT('".$username."', ".$maxTweets.", '".$elementId."');
	 			});
		   </script>";
}

function load_twitter_rss_with_rt_depend() { 
    wp_deregister_script( 'jquery' ); 
    wp_register_script( 'jquery', 'http://code.jquery.com/jquery-latest.pack.js', false, '' ); 
 
    //keep jQuery and Prototype compatible 
    $url = get_bloginfo('wpurl').'/wp-content/plugins/twitter-rss-with-rt'; 
    #wp_register_script( 'jquery_no_conflict', $url . '/jquery_no_conflict.js', array( 'jquery' ), '' );     
    #wp_enqueue_script( 'jquery_no_conflict' ); 

	 wp_register_script( 'twitter-rss-with-rt', $url . '/twitter-rss-with-rt.js', false, '');
    wp_enqueue_script( 'twitter-rss-with-rt' ); 
} 

if (!is_admin()) {
	add_action( 'wp_print_scripts', 'load_twitter_rss_with_rt_depend' ); 
}

?>
