<?php
ini_set( 'display_errors', "1" );
error_reporting(-1);

	require_once('upDb.php');

class UpRegist{
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

//new return
    $ret_pname = $input_filen;

    if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
      if (move_uploaded_file($_FILES["upfile"]["tmp_name"], "files/" . $_FILES["upfile"]["name"])) {
        chmod("files/" . $_FILES["upfile"]["name"], 0644);
        $file_org = "./files/" . $_FILES["upfile"]["name"];
        $outfile = "./files/" . $input_filen;
        $file_res = $this->sample_resize($file_org, $input_width, $input_width, $input_qua, $outfile);
         $filen_rev = strrev($input_filen);
        echo $file_org. "を<br>";
        echo $file_res. "名でアップロードしました。<br>";
        echo "<a href='http://instaglass.halfmoon.jp/?_=".$filen_rev."'>Check Pict Page</a><br /><hr/>";
        echo "<a href='https://mobile.twitter.com/'>Twitter</a><br /><hr/>";
      } else {
        echo "ファイルをアップロードできません。";
      }
    } else {
      echo "ファイルが選択されていません。";
    }
    return $ret_pname;
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
// 画像一覧表示

  function testup(){
    $dir='./files';
    $files = scandir($dir);
    print "<head><meta http-equiv='X-UA-Compatible' content='IE=edge'><title>Instagrass!</title></head>\n";

    print "<body>\n";
    print "<br><hr>\n";
    print "<table border=1>\n";

    foreach ($files as $file){
      if ($file == '.'){
      }
      else if ($file == '..'){
      }
      else if ($file == 'index.html'){
      }
      else{
      print "<tr>\n";

      $fullpath = '<a href='.'http://instagrass.sakuraweb.com/files/'.$file.'>'.$file.'</a>';
      $smallpic = '<img src='.'"http://instagrass.sakuraweb.com/files/'.$file.'" height=50>';
      $file = str_replace('.jpg', '', $file);
      //print "<td><a href='http://instagrass.sakuraweb.com/glass.php?s=11&q=".$file."'>".$file."</a></td>";
      print "<td><a href='http://instagrass.sakuraweb.com/glass.php?s=11&q=".$file."'>".$file."</a></td>";
      print "<td>".$smallpic."</td>\n";
      print "</tr>\n";
      }

    }
    print "</table>\n";

    print "<br>\n<hr>\n";
  }

//////////////////////////////////
// TEST IMG Display

    function imgdisp(){
    print "<br>\n<hr>\n";
  }


//////////////////////////////////
//
    function createUrl($ret_pname){

    $url = strrev($ret_pname);
//    print_r($url);
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
    //画像の縮小、upload
    $photoup = new UpRegist();
//TODO
    //$photoup->up_red();
    $ret_pname = $photoup->up_red();
    //return $ret_pname;
    echo '<hr>image name=' . $ret_pname . '<hr>' ;

    //画像名の反転
//    $url = $photoup->createUrl($ret_pname);

    //画像の登録
    $uploadDb = new UpDb();
    $ret_set = $uploadDb->registPictName($ret_pname);
echo'<hr>';
    print $ret_set[0];
echo'<hr>';
print $ret_set[1];
$uploadDb->registOwnerName($ret_set[0], $ret_set[1]);
}

?>
