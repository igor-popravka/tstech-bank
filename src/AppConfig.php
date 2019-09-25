<?php

namespace App;

class AppConfig extends Config {
    public function getDefaultAction(){
        return $this['CONTROLLER']['default_action'];
    }
}