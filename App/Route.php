<?php

namespace App;

use IvansWeb\Init\Bootstrap;

class Route extends Bootstrap {

    protected function initRoutes() {
        $routes[''] = '';
        $this->setRoute($routes);
    }

}
