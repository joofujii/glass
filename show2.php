<?php
namespace Comment;
//DBアクセス
require_once '/home/researchstudent/www/sql/dbClass.php';
// Class名と member関数名が同じ2クラスを取得（但しnamespace付き）
require_once '/home/researchstudent/www/i/show1.php';

//class Show {
class showComment {

    //
    public function showList(){

    // MySQLに対する処理
    try{
    	$dbTake = new DbClass;
    	$arr_comment = $dbTake->dbGet();
    }
    catch(Exception $e){
    	echo '<hr>';
    	print $e->getMessage();
    	echo '<hr>';
    }

    date_default_timezone_set('Asia/Tokyo');

    echo <<< EOM
<!-- IINE ! -->
<div style='margin-top:20px;margin-bottom:20px;'>
<div style='font-size:22pt;float:left;text-align:left;margin-left:50px;'>いいね ！
EOM;

echo count($arr_comment);

echo <<< EOM
件</div>
<div style='font-size:20pt;text-align:right;margin-right:50px;'>
EOM;

echo date( "H", getlastmod() );

echo <<< EOM
時間前</div>
</div>
<div style='clear:both;'></div>
EOM;

    	$comm_head = "<div style='margin-left:50px;'><div style='font-size:22pt;text-align:left;margin-bottom:20px;><span style='margin-left:20px;'><b>";
        $comm_mid = "</b> </span><span style='margin-left:20px;'>";
        $comm_tail = "</span></div></div>";

        foreach($arr_comment as $key => $comm_val){
        	//print_r($val);
            //foreach($val as $speaker_key => $comm_val){
                echo $comm_head.$comm_val['cowner'].$comm_mid.$comm_val['cline'].$comm_tail;
            //};
        };
    }
}

