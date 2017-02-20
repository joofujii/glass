<?php
$paramdata = '１月';
class Setuse {
  function setone($paramd){
    print('<p>試し出し<br>2行目'.$paramd.'</p>');
  } 

  function getParam() {

/*
		$link = mysql_connect('mysql475.db.sakura.ne.jp', 'researchstudent', '098098poi');
		if (!$link) {
			die('接続失敗です。'.mysql_error());
		}
		$db_selected = mysql_select_db(TB_NAME, $link);
		if (!$db_selected){
			die('データベース選択失敗です。'.mysql_error());
		}
*/
  }
} 
$paramdata = new Setuse;
$paramdata -> getParam();

echo 'arr_set=' . "<br>";

$arr_set = 
 array(
  'db_audio' => 
  array(
   'name_list' => 
   array(
   'table1a' => 'name1a',
   'table1b' => 'name1b'
  )
 ),
 'db_kata' => 
 array(
  'name_list' => 
  array(
   'table2a' => 'name2a',
   'table2b' => 'name2b'
  )
 )
);

foreach($arr_set as $key => $value)
{ $next_arr[  ]  = $value; };
print_r($next_arr, false);
// {  }  [  ]
