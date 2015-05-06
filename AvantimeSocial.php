<?php

/*
  Plugin Name: Avantime Social Plugin
  Plugin URI: http://www.avantime.se/
  Description: A plugin for social services
  Version: 1.0
  Author: Erik Johansson
  License: GPL2
 */

/*  Copyright 2011  Erik Johansson  (email : erik.johansson@avantime.se)

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
include_once dirname(__file__).'/vendor/autoload.php';

class AvantimeSocial
{
    public static $singletonRef = NULL;

    public static function getInstance()
    {
        if (self::$singletonRef == NULL) {
            self::$singletonRef = new AvantimeSocial();
        }
        return self::$singletonRef;
    }

    public function __construct($blog_id = null)
    {
        # actions
        add_action('wp_head', array( $this, 'FacebookSDK' ));
        # shortcodes
        add_shortcode('facebook-box', array( $this, 'FacebookBox' ));

    }

    public function FacebookSDK()
    {
    	$FBC = Avantime\Social\Services\Facebook::getInstance();
    	$FBC->InsertFacebookSDK();
    }

    public function FacebookBox($atts)
    {
    	extract( shortcode_atts( array(
    		'account' => 'avantimegroup',
    		'width' => 300,
    		'height' => 525,
    		'hidecover' => 'false',
    		'showfaces' => 'false',
    		'showposts' => 'true'
    	), $atts ) );

    	$FBC = Avantime\Social\Services\Facebook::getInstance();
    	return $FBC->InsertFacebookBoxWithSettings($account, $width, $height, $hidecover, $showfaces, $showposts);
    }
}

/**
 * Register hooks with calling the class
 */
AvantimeSocial::getInstance();

/**
 * Initiate WordPress Widget Class
 */
require_once dirname(__file__).'/AvantimeSocialWidget.php';