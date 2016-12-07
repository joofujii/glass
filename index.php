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
//コメントフォーム
//dbinsComment.php
//フォーム受け取り
//その他の機能を適切に実装すること
//Utility/


//DBアクセス
//require_once '/home/researchstudent/www/sql/dbClass.php';
require_once '/home/researchstudent/www/glass/dbClass.php';
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
     * SPページの表示
     *
     * @param URLクエリ名
     *
     * @output ページ表示
     */
    public function uniteSpParts($url){

        //urlから画像名
        $pnameTake = new DbClass;
        $pictName = $pnameTake->pnameGet($url);
        $gid = $pnameTake->gidGet($url);

        //ヘッダー
        $getHeader = new CreatePage;
        $getHeader->showHeader($gid);

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
        $drawHere = new CreatePicture;
        $drawHere->showMain($pictName);

        // カウントと時間
        $showCurrent = new CreatePage();
        $arr_comment = $showCurrent->showNow($gid);

        // コメント一覧
        $showName = new Comment\showComment();
        $showName->showList($arr_comment);

        //注意書き
        $getAttention = new CreatePage;
        $getAttention->showAttention();

        //フッター
        $getFooter = new CreatePage;
        $getFooter->showFooter();
        }
        // function end

    /*
    * PCページの表示(工事中)
    * @param コメント者名
    * @param 画像名称
    *
    */
    public function unitePcParts($url){
        //urlから画像名
        $pnameTake = new DbClass;
        $pictName = $pnameTake->pnameGet($url);
        $gid = $pnameTake->gidGet($url);
        //ヘッダー
        $getHeader = new CreatePage;
        $getHeader->showHeader($gid);
        //PCトップ
        $getTop = new CreatePage;
        $getTop->showPcTop($pictName);
    }
	// function end
}
// class end

// *********** Main **************

$ua=$_SERVER['HTTP_USER_AGENT'];

//if PC
//if((strpos($ua,’iPhone’)!==false)||(strpos($ua,’iPod’)!==false)||(strpos($ua,’Android’)!==false)){
//$pict_name = isset($_GET['q']) ? $_GET['q'] : null ;

$url_name = isset($_GET['_']) ? $_GET['_'] : null ;
if($url_name == null ){
    print '正しいページよりご覧ください。';
}
else{
    $ua=$_SERVER['HTTP_USER_AGENT'];
    if((strpos($ua,'iPhone')!==false)||(strpos($ua,'iPod')!==false)||(strpos($ua,'Android')!==false)){
        //for SP
        $instantGlass = new UniteAsOne();
        $instantGlass->uniteSpParts($url_name);
    }else{
        //for PC
        $instantGlass = new UniteAsOne();
        //$instantGlass->unitePcParts($url_name);

        //for TEST
        $instantGlass->uniteSpParts($url_name);
    }
}
?>
