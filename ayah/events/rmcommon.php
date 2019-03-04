<?php
// $Id: rmcommon.php 594 2011-02-07 20:58:31Z i.bitcero $
// --------------------------------------------------------------
// AYAH plugin for Common Utilities
// Allows to integrate AYAH with Common Utilities
// Author: Eduardo Cortés <i.bitcero@gmail.com>
// Email: i.bitcero@gmail.com
// License: GPL 2.0
// --------------------------------------------------------------

class AyahPluginRmcommonPreload
{
    public function eventRmcommonCommentsForm($form, $module, $params, $type)
    {
        global $xoopsUser;

        $config = RMSettings::plugin_settings('ayah', true);

        if ($xoopsUser && $xoopsUser->isAdmin() && !$config->show) {
            return $form;
        }

        $form['fields'] = self::get_html();

        return $form;
    }

    /**
     * This method allows to other modules or plugins to get a recaptcha field
     */
    public function eventRmcommonRecaptchaField()
    {
        global $xoopsUser;

        $config = RMSettings::plugin_settings('recaptcha', true);

        if ($xoopsUser && $xoopsUser->isAdmin() && !$config->show) {
            return;
        }

        $field = self::get_html();

        return $field;
    }

    public function eventRmcommonCommentPostdata($ret)
    {
        global $xoopsUser;

        $config = RMSettings::plugin_settings('ayah', true);

        if ($xoopsUser && $xoopsUser->isAdmin() && !$config->show) {
            return $ret;
        }

        self::set_config();

        include_once(RMCPATH . '/plugins/ayah/include/ayah.php');
        $ayah = new AYAH();
        $ayah->debug_mode($config->debug);
        $resp = $ayah->scoreResult();

        if (!$resp) {
            redirect_header($ret, 2, __('Please, confirm that you are a human!', 'ayah'));
            die();
        }
    }

    public function eventRmcommonCaptchaCheck($value)
    {
        global $xoopsUser;

        $config = RMSettings::plugin_settings('ayah', true);

        if ($xoopsUser && $xoopsUser->isAdmin() && !$config->show) {
            return $value;
        }

        self::set_config();

        include_once(RMCPATH . '/plugins/ayah/include/ayah.php');
        $ayah = new AYAH();
        $ayah->debug_mode($config->debug);
        $resp = $ayah->scoreResult();

        return $resp;
    }

    private function set_config()
    {
        $config = RMSettings::plugin_settings('ayah', true);

        if (!defined('AYAH_PUBLISHER_KEY')) {
            define('AYAH_PUBLISHER_KEY', $config->publisher);
        }

        if (!defined('AYAH_SCORING_KEY')) {
            define('AYAH_SCORING_KEY', $config->scoring);
        }
    }

    private function get_html()
    {
        $config = RMSettings::plugin_settings('ayah', true);
        self::set_config();
        require_once(RMCPATH . '/plugins/ayah/include/ayah.php');
        $ayah = new AYAH();

        $ayah->debug_mode($config->debug);

        return $ayah->getPublisherHTML();
    }
}
