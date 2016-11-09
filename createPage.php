<?php
//namespace home\researchstudent\www\i;
ini_set( 'display_errors', "1" );
error_reporting(-1);

//DBアクセス
require_once '/home/researchstudent/www/sql/dbClass.php';
// Class名と member関数名が同じ2クラスを取得（但しnamespace付き）
require_once '/home/researchstudent/www/i/show1.php';
require_once 'show2.php';
// trait付きクラス
require_once 'dateView.php';
//
require_once 'showPicture.php';

/*
 * 各ページの生成クラス
 */
class CreatePage {

    /*
     * ページの表示
     * @param コメント者名
     * @param 画像名称
     *
     */
    public function showHeader($pid){

    //$input_width = 200;
    //$pid = 1;

echo <<< EOM
<head><meta http-equiv='X-UA-Compatible' content='IE=edge'>
<meta charset='utf-8'><title>.......</title>
<meta name="Robots" content="noindex,nofollow">

<script language="javascript">
var s=$pid;
function openWin(){
window.open("./inputComment.html?s=" +s);
}
</script>
</head>
EOM;

//TODO
//"subWin.getElementById('glassid').innerHTML='3' ");
//"subWin.document.comm_form.glass.value='2' ");
//subWin.document.getElementById("ichi").innerHTML="

    }

    /*
     * ページの表示
     * @param コメント者名
     * @param 画像名称
     *
     */
    public function showTop(){

    echo <<< EOM
<body bgcolor=#FFFFFF>
<table cellpadding=0 bgcolor=#FFFFFF  width=100% height=150>
<tr><td align=left><a href='javascript:alert("ここがhomeです。")' style='margin-left:20px;color:#446699; text-decoration: none;'><img src='./files/camera.jpg' width=75></a></td>
<td align=center style='font-style:italic; color:#808080; font-size:16pt'><form><input type=text value='検索' style='border:0;
padding:10px;
font-size:14pt;
font-family:Arial, sans-serif;
color:#aaa;
border:solid 1px #ccc;
margin:2 20 1 60px;
width:300px;' /></form></font></td>
<td align=right><a style='color:#000000; font-size:20pt; text-decoration: none;' href='javascript:alert("ごめん！無理！")'>ログイン</a></td>
</tr>
</table>
EOM;
    }


    /*
     * showBlackブロックの表示
     * @param コメント者名
     * @param 画像名称
     *
     */
    public function showBlack(){

    echo <<< EOM
    <!-- BLACK head -->
<table cellpadding=10 bgcolor=#000000 width=100% border=0 height=150>
<tr><td align=left><a href='javascript:alert("ここがhomeです。")' style='color:#446699; text-decoration: none;'></a></td>
<td align=left style='font-style:italic; color:white; font-size:22pt; margin-top:20px;'>Instaglass<br>GeeglePlayとは関係ありません。</font></td>
<td align=right>
<table cellpadding=3 style='border: 1px #FFFFFF solid; '>
<tr><td>
<a style='color:#FFFFFF; font-size:20pt; text-decoration: none;' href='javascript:alert("じゅ・・準備中です・・")'>ダウンロード</a>
</td></tr>
</table>
</td>
</tr>
</table>
EOM;
    }

    /*
     * showWhiteブロックの表示
     * @param コメント者名
     * @param 画像名称
     *
     */
    public function showWhite($spk){

echo <<< EOM
<!-- WHITE PERSON -->
<table cellpadding=0 bgcolor=#FFFFFF  width=100% height=250px border=0>
<tr><td align=left>
<a href='javascript:alert("ここがhomeです。")' style='margin-left:20px;color:#446699; text-decoration: none;'>
EOM;

//Speaker
//    $showOwner = new Speaker\Show();
//    $showOwner->showOwner($spk);
echo '<img src="./mark/fox.jpg" width=75>';

echo <<< EOM
</a>
<span style='font-style:italic; color:#000000; font-size:20pt; margin-left:20px;vertical-align:top;'>
EOM;

//Speaker
    $showSpeaker = new Speak\Show();
    //$showSpeaker = new Speaker\Show();

    $showSpeaker->showList($spk);
//    if($spk == 11){
//        echo'Joe';
//    }else{
//        echo 'Unknown';
//    }

echo <<< EOM
</span></td>
<td align=left style='font-style:italic; color:#000000; font-size:20pt'></font></td>
<td align=right>
<table cellpadding=3 style='border: 2px blue solid; '>
<tr><td>
<a style='color:blue; text-decoration: none; font-size:20pt;' href='javascript:alert("ごめん！するとは思わなかったｗ")'>フォローする</a>
</td></tr>
</table>
</td>
</tr>
</table>
EOM;
    }

    /*
     * 中央部（メイン画像）の表示
     * @param $comm_arr(コメント内容配列)
     * @param
     *
     */
    public function showMiddle($comm_arr){
        $temp = 1;
        $drawHere = new CreatePicture;
        $drawHere->showMain($temp);
    }

    /*
     * カウントと時間の表示
     * @param $gid(画像名）
     *
     */
    public function showNow($gid){

        // MySQLに対する処理
        try{
            $dbTake = new DbClass;
            $arr_comment = $dbTake->dbGet($gid);
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
    return $arr_comment;
    }

    /*
     * 注意の表示
     *
     * @param コメント者名
     * @param 画像名称
     *
     */
    public function showAttention(){

    echo <<< EOM
<div>
<div style='font-size:20pt;float:left;text-align:left;margin-left:50px;margin-bottom:50px;'></div>
</div>
<div>
<hr style='clear:both;'>
</div>
<div style='font-size:22pt;margin-left:50px;margin-bottom:22pt;margin-bottom:22pt'>
ログインしても「いいね！」や<a href="javascript:openWin()">コメント</a>はできません。
</div>
EOM;
        }

    /*
     * ページの表示
     * @param コメント者名
     * @param 画像名称
     *
     */
    public function showFooter(){

    //$input_width = 200;

    echo <<< EOM
<table cellpadding=10 bgcolor=#FFFFFF width=100% border=0>
<tr>
<td align=left><font color=#334488 size=10pt></font></td>
<td align=left style='font-size:22pt;color:#446699; text-decoration: none;'>&nbsp;&nbsp;&nbsp;<a href='javascript:alert("見てね")' style='color:#335588; text-decoration: none;'>
INSTAGLASSについて</a>&nbsp;&nbsp;&nbsp;<a href='javascript:alert("そこそこ")' style='color:#446699; text-decoration: none;'>
サポート</a>&nbsp;&nbsp;&nbsp;<a href='javascript:alert("まだない。いる？")' style='color:#446699; text-decoration: none;'>
ブログ</a>&nbsp;&nbsp;&nbsp;<a style='color:#446699; text-decoration: none;' href='javascript:alert("しないと思う")'>
プレス</a>&nbsp;&nbsp;&nbsp;API&nbsp;&nbsp;&nbsp;<a style='color:#446699; text-decoration: none;' href='javascript:alert("基本規定：「利用者は私だけ」")'>
利用規約</a>&nbsp;&nbsp;&nbsp;</font></td>
<td align=right><font color=#446699  size=10pt></font></td>
</tr>
<tr>
<td align=left><font color=#334488 size=10pt></font></td>
<td align=center>
EOM;


    //echo "<span style=' color:334488; font-size:26pt;'>";
    //echo date("Y　　mj");
    //echo "</span>";

$date_foot = new dateView();

$date_foot->setColor('998800');//trait
$date_foot->dateShow();
$date_foot->closeColor();//trait

    //Speaker-trait
   // $showSpeakerTrait = new Speaker\Show();
   // $showSpeakerTrait->timeNow();

    echo <<< EOM
</td>
<td align=right><font color=#446699  size=10pt></font></td>
</tr>
</table>
<br>
</body>
</html>
EOM;
    }
    // function end

    /*
     * ページの表示
    * @param コメント者名
    * @param 画像名称
    *
    */
    public function showPcTop($pic){

echo <<< EOM
<body bgcolor=#FFFFFF>
 "ごめん！PC版まだなんだｗ"
 <div >
    <div style="    filter:alpha(opacity=30);
    -moz-opacity: 0.3;
    opacity: 0.3;
  transform: rotate(-10deg);
  -ms-transform: rotate(-10deg);
  -moz-transform: rotate(-10deg);
  -webkit-transform: rotate(-10deg);
  -o-transform: rotate(-10deg);
 			" >
<img src="./files/
EOM;
echo $pic;
echo <<< EOM
.jpg" width=100px>
    </div>
</div>
EOM;
    }
    // function end
}
// class end
?>
