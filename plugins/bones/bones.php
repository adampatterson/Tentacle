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

#event::on('plugin_navigation', 'bones::settings_nav', 7);
#event::on('content', 'bones::barnacle', 7);

#event::on('activate', 'bones::__install', 7);
#event::on('deactivate', 'bones::__uninstall', 7);

//class bones
//{
//
//    static function __install()
//    {
//
//    }
//
//    static function __uninstall()
//    {
//
//    }

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