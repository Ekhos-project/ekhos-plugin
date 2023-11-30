<?php
/*
Plugin Name: Ekhos Sound Design
Description: Sound manager for your website
Version: 1.0
Author: Ekhos
*/

foreach (glob(plugin_dir_path(__FILE__) . 'admin/*.php') as $file) {
    include_once $file;
}
