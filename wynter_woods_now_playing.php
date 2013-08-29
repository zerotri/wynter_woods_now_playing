<?php
/*
Plugin Name: Wynter Woods - Now Playing
Plugin URL: http://amarant.co.vu
Description: This Now Playing plugin inserts "Now Playing" functionality into each post with a 'listening' custom field.
Version: 1.0
Author: Wynter Woods
Author URI: http://amarant.co.vu
License: MIT
*/

/*
Copyright (C) 2013 Wynter Woods

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// If the function doesn't exist in this namespace, define and implement it
if( !function_exists("wynter_woods_now_playing")){

	// This function is hooked into each post
	function wynter_woods_now_playing($content){

		// Get the custom field 'listening' for post.
		$post_meta = get_post_meta(get_the_ID(), "listening", true);

		// Make sure we're working with a string value
		if(is_string($post_meta)) {

			// Sanitize string from custom field.
			$now_playing_data = sanitize_text_field($post_meta);

			// If the sanitized string is empty, don't output it
			if(trim($now_playing_data) != "" ) {

				// Build up the final output. It would be better here to implement
				// a settings page for this plugin to allow templating of the output.
				$now_playing_output = "<p class=\"now-playing\">Now Playing: ".$now_playing_data."</p>";
				$content .= $now_playing_output;
			}
		}
		return $content;
	}
}

add_filter('the_content', 'wynter_woods_now_playing');
