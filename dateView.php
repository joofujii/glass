<?php
include 'colorTrait.php';


class dateView {
    use ColorTrait;

    /*
     * date display
     *
     * @return date
     */
    function dateShow(){
        echo date("Y　　mj");
    }
}

