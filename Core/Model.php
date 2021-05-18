<?php
namespace mvc\Core;

class Model {
    public function getProperties() {
        $arr = get_object_vars( $this );
        return $arr;
    }
}
