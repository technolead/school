<?php

class MY_Controller extends Controller {

    var $current_culture = '';

    function MY_Controller() {

        parent::Controller();

        if ($this->session->userdata('language')) {

            $this->config->set_item('language', $this->session->userdata('language'));

            $this->config->set_item('language_code', $this->session->userdata('language_code'));
        }

        $this->current_culture = $this->config->item('language');

        $this->culture_code = $this->config->item('language_code');
    }

    function set_current_culture($language) {

        $this->session->set_userdata('language', strtolower($language));
    }

}
?>