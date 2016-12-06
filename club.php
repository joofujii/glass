<?php
ini_set( 'display_errors', "1" );
error_reporting(-1);

class imageup{
    var $x = 0;
    var $y = 0;
    var $weight;
    var $first_weight;

// *************************
    function up_red(){
    $input_width = (int)$_POST['width'];
    $input_qua = (int)$_POST['qua'];
    $input_filen = $_POST['filen'];
//    $input_opt = $_POST['opt'];

    if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
      if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/" . $_FILES["upfile"]["name"])) {
        chmod("files/" . $_FILES["upfile"]["name"], 0644);
        $file_org = "./files/" . $_FILES["upfile"]["name"];
        $outfile = "./files/" . $input_filen;
        $file_res = $this->sample_resize($file_org, $input_width, $input_width, $input_qua, $outfile);

        echo $file_org. "を<br>";
        echo $file_res. "名でアップロードしました。<br>";
        echo "<a href='http://instagrass.sakuraweb.com/club.php?mode=_d&_i=".$input_filen."'>Check</a><br /><hr
/>";
      } else {
        echo "ファイルをアップロードできません。";
      }
    } else {
      echo "ファイルが選択されていません。";
    }
  }

// *************************
  function sample_resize($orig_file, $resize_width,  $resize_height, $resize_qua, $new_fname) {
// GDライブラリがインストールされているか
    if (!extension_loaded('gd')) {
// エラー処理
      echo '----GD library error----';
      return false;
    }
// 画像情報取得 (タテヨコｅｘｔ)
    $result = getimagesize($orig_file);
    list($orig_width, $orig_height,  $image_type) = $result;

    $input_opt = $_POST['opt'];
    if($input_opt == 'original'){
      $resize_width = $orig_width;
    }

// 画像$orig_fileを＄ｉｍにコピー
// 1 IMAGETYPE_GIF
// 2 IMAGETYPE_JPEG
// 3 IMAGETYPE_PNG
    switch ($image_type) {
      case 1: $im = imagecreatefromgif($orig_file); break;
      case 2: $im = imagecreatefromjpeg($orig_file); break;
      case 3: $im = imagecreatefrompng($orig_file); break; default:
//エラー処理
      return false;
    }

// == 画像タテヨコ比率保持 ==
// ＝＝最大の辺を高さ・幅から選択して他方を調整 ＝＝
// $orig_fileから寸法を取得

//  list($width_orig, $height_orig) = getimagesize($im);
    list($width_orig, $height_orig) = getimagesize($orig_file);
    $ratio_orig = $width_orig/$height_orig;

// タテヨコ寸法の決定

// if ($width/$height > $ratio_orig) { $width = $height*$ratio_orig; } else { $height = $width/$ratio_orig; }
    if ($resize_width/$resize_height > $ratio_orig) {
      $resize_width = $resize_height*$ratio_orig;
    } else {
     $resize_height = $resize_width/$ratio_orig;
    }

// コピー先となる空の画像 $new_imageを作成
    $new_image = imagecreatetruecolor($resize_width, $resize_height);
// エラー処理 不要な画像リソースを保持するメモリを解放
    if (!$new_image) {
      imagedestroy($im);
      return false;
    }

// GIF、PNGの場合、透過処理の対応を行う
    if (($image_type == 1) OR ($image_type==3)) {
      imagealphablending($new_image, false);
      imagesavealpha($new_image, true);
      $transparent = imagecolorallocatealpha($new_image, 255, 255, 255, 127);
      imagefilledrectangle($new_image, 0, 0, $resize_width, $resize_height, $transparent);
    }

// コピー画像$new_imageを＄ｉｍから指定サイズで作成

    if (!imagecopyresampled($new_image, $im, 0, 0, 0, 0, $resize_width, $resize_height, $orig_width, $orig_height)){

// エラー処理
// 不要な画像リソースを保持するメモリを解放する
      imagedestroy($im);
      imagedestroy($new_image);
      return false;
    }

// コピー画像$new_imageを$new_fnameとして保存

// $new_image : 画像データ
// $new_fname : 保存先と画像名
// クオリティ

    echo '---Resize_width---'.$resize_width.'---<br>';
    echo '---Resize_height---'.$resize_height.'---<br>';
//    $quality = 75;
    $quality = $resize_qua;
    switch ($image_type) {
// 1 IMAGETYPE_GIF
// 2 IMAGETYPE_JPEG
// 3 IMAGETYPE_PNG
      case 1: $new_fnamex = $new_fname.'.gif'; $result = imagegif($new_image, $new_fname, $quality); break;
// case 2: $result = imagejpeg($new_image, $new_fname, $quality); break;
      case 2: $new_fnamex = $new_fname.'.jpg'; $result = imagejpeg($new_image, $new_fnamex, $quality); break;
      case 3: $new_fnamex = $new_fname.'.png'; $result = imagepng($new_image, $new_fname, $quality); break;
default:
//エラー処理
      return false;
    }

    if (!$result) {
// エラー処理
// 不要な画像リソースを保持するメモリを解放する
      imagedestroy($im);
      imagedestroy($new_image);
      return false;
    }

// 不要になった画像データ削除
    imagedestroy($im);
    echo '---new_image---'.$new_image.'---<br>';
    imagedestroy($new_image);
    echo '---orig_file---'.$orig_file.'---<br>';
//  imagedestroy($orig_file);
    unlink ("$orig_file");
    return $new_fnamex;
  }
}

// *************************
// class imagemng extends imageup{
class imagemng {
  var $weight = 6000;
//  function CAT($weight){
//    $this->ANIMAL($weight);
//  }

  function listup(){
//    $dir='../quantum/files';
    $dir='./files';
    $files = scandir($dir);
    print "= Uploaded Files List =<br>\n<br>\n";
//    print_r($files);

    foreach ($files as $file){
      if ($file == '.'){
//        print "dir<br>\n";
//        break;
      }
      else if ($file == '..'){
//        print "dir<br>\n";
      }
      else if ($file == 'index.html'){
//        print "dir<br>\n";
      }
      else{
        $fullpath = '<a href='.'http://instagrass.sakuraweb.com/files/'.$file.'>'.$file.'</a>';
        $smallpic = '<img src='.'"http://instagrass.sakuraweb.com/files/'.$file.'" height=50>';
// $fullpath = 'test';
//    print "$fullpath";
        print $fullpath.$smallpic."<br>\n";
      }
    }
    print "<br>\n<hr>\n";
  }

//////////////////////////////////
// TEST LIST

  function testup(){
//    $dir='../classmade/files';
    $dir='../i/files';
    $files = scandir($dir);
    print "<head><meta http-equiv='X-UA-Compatible' content='IE=edge'><title>Instagrass!</title></head>\n";
    print "<body>\n";

//    print_r($files);

    foreach ($files as $file){
      if ($file == '.'){
//        print "dir<br>\n";
//        break;
      }
      else if ($file == '..'){
//        print "dir<br>\n";
      }
      else if ($file == 'index.html'){
//        print "dir<br>\n";
      }
      else{
        $fullpath = '<a href='.'http://instagrass.sakuraweb.com/files/'.$file.'>'.$file.'</a>';
        $smallpic = '<img src='.'"http://instagrass.sakuraweb.com/files/'.$file.'" height=50>';

//

//print "<form action='./cls_resize.php'  method='post'  enctype='multipart/form-data'><input type='hidden' name='mode' value='imagedisp' ><input type='hidden' name='imgname' value='";
//print "$file";
//print "'><input type='submit' value='実行' /> </form>\n";

//print "<a href='./club.php?mode=imagedisp&imgname=";

$file = str_replace('.jpg', '', $file);

print "<a href='http://instagrass.sakuraweb.com/glass.php?s=11&q=";
print "$file'>";

print "http://instagrass.sakuraweb.com/glass.php?s=11&q=";
print "$file</a>";

//        print $fullpath.$smallpic."<br>\n";
        print $smallpic."<br>\n";
      }
    }
    print "<br>\n<hr>\n";
  }

//////////////////////////////////
// TEST IMG Display

    function imgdisp(){
$input_imgname = $_GET['_i'];
    $dir='./files';
    $files = scandir($dir);
    print "<head><meta http-equiv='X-UA-Compatible' content='IE=edge'>\n";
    print "<meta charset='utf-8'><title>Instagrass?</title></head>\n";
    print "<body bgcolor=#DDDDEE>\n";
// BLUE　BAR
    print "<table cellpadding=0 bgcolor=#446699  width=100%>\n";
    print "<tr><td align=left><a href='javascript:alert(\"ここがhomeです。\")' style='color:#446699; text-decoration: none;'><img src='./mark/home.jpg'></a></td>\n";
    print "<td align=center style='font-style:italic; color:white; font-size:20pt'>";
    print "Instagrass</font></td>\n";
    print "<td align=right><a style='color:#FFFFFF; text-decoration: none;' href='javascript:alert(\"ごめん！無理！\")'><img src='./mark/person.jpg'>ログイン</a></td></tr></table>\n";
// IMG　SCREEN
    print "<table cellpadding=5 bgcolor=#DDDDEE width=100% border=0>\n";
    print "<tr><td align=center bgcolor=#DDDDEE>";
    print "<table cellpadding=10 bgcolor=#FFFFFF width=60% border=0>\n";
    print "<tr bgcolor=#FFFFFF><td align=center bgcolor=#FFFFFF><img src='files/";
    print $input_imgname ;
    print "'></td></tr></table>\n";
    print "</td></tr></table>\n";
// FOOTER
    print "<table cellpadding=10 bgcolor=#DDDDEE width=100%>\n";
    print "<tr><td align=left><font color=#446699 size=10pt></font></td>\n";
    print "<td align=center style='color:#446699; text-decoration: none;'>&nbsp;&nbsp;&nbsp;<a href='javascript:alert(\"見てね\")' style='color:#446699; text-decoration: none;'>Instaclubについて</a>&nbsp;&nbsp;&nbsp;<a href='javascript:alert(\"そこそこ\")' style='color:#446699; text-decoration: none;'>サポート</a>&nbsp;&nbsp;&nbsp;<a href='javascript:alert(\"まだない。いる？\")' style='color:#446699; text-decoration: none;'>ブログ</a>&nbsp;&nbsp;&nbsp;<a style='color:#446699; text-decoration: none;' href='javascript:alert(\"しないと思う\")'>プレス</a>&nbsp;&nbsp;&nbsp;API&nbsp;&nbsp;&nbsp;<a style='color:#446699; text-decoration: none;' href='javascript:alert(\"基本規定：「利用者は私だけ」\")'>利用規約</a>&nbsp;&nbsp;&nbsp;</font></td>\n";
    print "<td align=right><font color=#446699  size=10pt></font></td></tr></table>\n";
//    print_r($files);
    print "<br>\n<hr>\n";
  }

// class end
}

//$input_mode = (int)$_POST['mode'];
//$input_mode = $_POST['mode'];
//if(isset($input_mode)){
//if(!is_null($_GET['mode'])){
if(!isset($_POST['mode'])){
    $input_mode = $_GET['mode'];
}
else{
    $input_mode = $_POST['mode'];
    print "protocol:POST input_modo: ".$input_mode."<hr>";
}
if($input_mode == 'testup'){
    $photolist = new imagemng();
    $photolist->testup();
}
else if($input_mode == '_d'){
    $photolist = new imagemng();
    $photolist->imgdisp();
}
else{
    $photoup = new imageup();
    $photoup->up_red();
}

?>
