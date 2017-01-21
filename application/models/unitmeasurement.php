<?php

class Unitmeasurement extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getUMES() {
        return $this->getArrayObjects("SELECT ume_id,ume_name FROM unit_measurement");
    }
}
