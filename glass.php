<?php
//namespace home\researchstudent\www\i;
ini_set( 'display_errors', "1" );
error_reporting(-1);

//ページを構成すること
//UniteAsOne/uniteParts

//ページを作成すること
//CreatePage/showHeader,showTop,showBlack,showWhite
//CreatePicture/showMain($temp)
//DbClass/dbGet()
//Comment\showComment()/showList($arr_comment);
//CreatePage/showAttention();

//CreatePage/showFooter

//画像を選んで表示すること
//CreatePicture/showMain

//（画像を受け付けて記録すること）
//（InvitePicture/receivePicture）

//コメントを選んで表示すること
//CreateComment/showComment(db)

//コメントを受け付けて記録すること
//(DbClass,dbGet)
//InviteComment/receiveComment(db)
//showForm,receiveForm,
//JavaScriptで飛ばす先のform
//inputComment.html

//その他の機能を適切に実装すること
//Utility/


//DBアクセス
require_once '/home/researchstudent/www/sql/dbClass.php';
// Class名と member関数名が同じ2クラスを取得（但しnamespace付き）
require_once '/home/researchstudent/www/i/show1.php';
require_once 'show2.php';
// trait付きクラス
require_once 'dateView.php';
//
require_once 'createPage.php';
require_once 'showPicture.php';

/*
 * ページを構成する
 */
class UniteAsOne {

    /*
     * ページの表示
     * @param コメント者名
     * @param 画像名称
     *
     */
    public function uniteParts($pictName){

    //ヘッダー
    $getHeader = new CreatePage;
    $getHeader->showHeader();

    //トップ
    $getTop = new CreatePage;
    $getTop->showTop();

    //黒帯
    $getBlack = new CreatePage;
    $getBlack->showBlack();

    //白帯
    $spk = '11';
    $getWhite = new CreatePage;
    $getWhite->showWhite($spk);

    //メイン画像
    $temp = 1;
    $drawHere = new CreatePicture;
    $drawHere->showMain($temp);

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

    // コメント
    $show_name = new Comment\showComment();
    //$show_name->showList($comm_arr);
    $show_name->showList($arr_comment);

    //注意
    $getAttention = new CreatePage;
    $getAttention->showAttention();

    //フッター
    $getFooter = new CreatePage;
    $getFooter->showFooter();

    echo <<< EOM
<br>
</body>
</html>
EOM;

    }
    // function end
}
// class end

// *************************

//$speaker = isset($_GET['s']) ? $_GET['s'] : null ;
$pict_name = isset($_GET['q']) ? $_GET['q'] : null ;
    //print "input_modo=GET ".$input_mode;

//if(($speaker == null) || ($pict_name == null) ){
if($pict_name == null ){
    print '正しいページよりご覧ください。';
}
else{
    $instantGlass = new UniteAsOne();
//    $instantGlass->uniteParts($speaker, $pict_name);
    $instantGlass->uniteParts($pict_name);
}
?>
