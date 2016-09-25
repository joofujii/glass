<?php
namespace Comment;

//class Show {
class showComment {

    //
    public function showList($comm_arr){

        $comm_head = "<div style='margin-left:50px;'><div style='font-size:22pt;text-align:left;margin-bottom:20px;><span style='margin-left:20px;'><b>";
        $comm_mid = "</b> </span><span style='margin-left:20px;'>";
        $comm_tail = "</span></div></div>";

        foreach($comm_arr as $key => $comm_val){
        	//print_r($val);
            //foreach($val as $speaker_key => $comm_val){
                //echo $comm_head.$comm_val['cowner'].$comm_mid.$comm_val['cline'].$comm_tail;
                echo $comm_head.$comm_val['writer'].$comm_mid.$comm_val['comment'].$comm_tail;
                //};
        };
    }
}

