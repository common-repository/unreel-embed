<?php

/* * *
  Plugin Name: Unreel Embed Plugin
  Description: Unreel Embed Plugin
  Version: 1.0.0
  Author: Unreel Entertainment LLC, support@unreel.me
  Plugin URI: https://www.unreel.me/
 * * */

/* * *
  +---------------------------------------------------------------------------+
  | Copyright (c) 2017 Unreel Entertainment LLC.                                             |
  |                                                                           |
  | This program is free software; you can redistribute it and/or modify      |
  | it under the terms of the GNU General Public License as published by      |
  | the Free Software Foundation; either version 2 of the License, or         |
  | (at your option) any later version.                                       |
  |                                                                           |
  | This program is distributed in the hope that it will be useful,           |
  | but WITHOUT ANY WARRANTY; without even the implied warranty of            |
  | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             |
  | GNU General Public License for more details.                              |
  |                                                                           |
  | You should have received a copy of the GNU General Public License         |
  | along with this program; if not, write to the Free Software               |
  | Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA |
  +---------------------------------------------------------------------------+
 */

function unreel_embed_widget($args) {
	if(!array_key_exists ("src",$args))
		return '<span style="color:red;">src has to be provided for unreel embed widget.</span>';
	
	$src = $args["src"];
	
	if (strpos($src, '?') === false) 
		$src .="?";
	
	if (strpos($src, 'embed=') === false) 
		$src .="&embed=true";

	if (strpos($src, 'autoplay=') === false) 
		$src .="&autoplay=true";	
	
	if (strpos($src, 'autoplayMuteMobile=') === false) 
		$src .="&autoplayMuteMobile=true";	
	
	if (strpos($src, 'autoplayNext=') === false) 
		$src .="&autoplayNext=true";	
	
	if (strpos($src, 'mute=') === false) 
		$src .="&mute=false";	
	
	$args["src"] = str_replace("?&","?",$src) ;
	
	if(!array_key_exists("frameborder",$args))
		$args["frameborder"] = 0;
	
	if(!array_key_exists("scrolling",$args))
		$args["scrolling"] = "no";
	
		
	if(!array_key_exists("allowfullscreen",$args))
		$args[] = "allowfullscreen";
        
		
	if(!array_key_exists("style",$args))
		$args["style"] = "overflow: auto; -webkit-overflow-scrolling: touch;";
        
	$content = ' ';
    foreach($args as $key=>$value) {
        if($key)
			$content .= ' '.$key.'="'.$value.'"';
        else 
            $content .= ' '.$value;
    }
    
	return  '<iframe'.$content.'></iframe>';
}


function unreel_embed_add_widget_button()
{
    echo '<a title="Insert Unreel Widget" class="button insert-media add_media" id="insert-unreel-widget-button" href="#">Add Unreel Widget</a>';
    
    echo '<script type="text/javascript">
            jQuery("#insert-unreel-widget-button").click(function() {
                    send_to_editor("[unreel_embed src=\"{Enter url}\" width=\"400\" height=\"300\"]");
                    return false;
            });
         </script>';
}

function unreel_embed_install() {
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
}

add_action('media_buttons','unreel_embed_add_widget_button');
add_shortcode('unreel_embed', 'unreel_embed_widget' );
register_activation_hook(__FILE__, 'unreel_embed_install');
?>
