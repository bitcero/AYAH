<?php
// $Id$
// --------------------------------------------------------------
// AYAH plugin for Common Utilities
// Allows to integrate "Are You A Human" with Common Utilities
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

$options['publisher'] = array(
        'caption'   =>  __('Your publisher key','ayah'),
        'desc'      =>  __('You can get it directly from your ayah account.','ayah'),
        'fieldtype'      =>  'textbox',
        'size'      =>  50,
        'valuetype' =>  'text',
        'value'   =>  ''
);

$options['scoring'] = array(
        'caption'   =>  __('Your scoring key','ayah'),
        'desc'      =>  __('You can get it directly from your ayah account.','ayah'),
        'fieldtype'      =>  'textbox',
        'size'      =>  50,
        'valuetype' =>  'text',
        'value'   =>  ''
);

$options['show'] = array(
        'caption'   =>  __('Show field to site administrators?','ayah'),
        'desc'      =>  '',
        'fieldtype'      =>  'yesno',
        'valuetype' =>  'int',
        'value'   =>  1
);

$options['debug'] = array(
        'caption'   =>  __('Enable debug mode?','ayah'),
        'desc'      =>  '',
        'fieldtype'      =>  'yesno',
        'valuetype' =>  'int',
        'value'   =>  0
);