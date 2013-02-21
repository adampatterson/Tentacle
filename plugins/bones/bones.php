<?php
/**
name: Bare Bones
url: http://tentaclecms.com
version: 1.0
description: Tentacles core Plugin
author:
  name: Adam Patterson
  url: http://adampatterson.ca
*/

#event::on('plugin_navigation', 'barnacles::settings_nav', 7);

//class barnacles
//{
//    static function settings_nav() {
//		$nav[] = array(
//            'title'     => 'Barnacles',
//            'rout'      => 'barnacle_settings',
//            'uri'       => 'barnacles/view'
//        );
//
//		$nav[] = array(
//            'title'     => 'Barnacles Two',
//            'rout'      => 'barnacle_settings_two',
//            'uri'       => 'barnacles/view'
//        );
//
//    	return $nav;
//    }
//
//    static function barnacle()
//    {
//        return 'Incy Wincy spider climbed up the water spout.';
//    }
//}