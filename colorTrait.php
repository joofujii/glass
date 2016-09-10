<?php

trait ColorTrait {

    /*
     * color front script
     *
     * @return tag
     */
    public function setColor($font_color = 334488){
    echo "<span style=' color:".$font_color."; font-size:26pt;'>";
    }

    /*
     * color back script
     *
     * @return tag
     */
    public function closeColor(){
    echo "</span>";
    }
}

