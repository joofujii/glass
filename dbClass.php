<?php
ini_set( 'display_errors', "1" );
error_reporting(-1);

class DbClass{
//class showPicture{

	public function dbGet(){
		// MySQLに対する処理
		$link = mysql_connect('mysql475.db.sakura.ne.jp', 'researchstudent', '098098poi');
		if (!$link) {
			die('接続失敗です。'.mysql_error());
		}
		//$db_selected = mysql_select_db('researchstudent_ci', $link);
		$db_selected = mysql_select_db('researchstudent_glass', $link);
		if (!$db_selected){
			die('データベース選択失敗です。'.mysql_error());
		}
		mysql_set_charset('utf8');
		//$result = mysql_query('SELECT * FROM comment');
		$result = mysql_query('SELECT * FROM comm');
		if (!$result) {
			die('クエリーが失敗しました。'.mysql_error());
		}
		mysql_close($link);
        $arr_com = array();
		while($row = mysql_fetch_assoc($result)){
			//$row = mysql_fetch_assoc($result);
			if ($row['writer'] == 'XXX') {
				throw new Exception ('「Exceptionって知ってる？<br>知らないよね。<br>じゃあいいや、気にしないでねｗ」');
			}
            //TODO
	        //print_r($row);
            //echo '<hr>row<br>';
			$arr_com[ ] = $row;
			//print('<hr>id=' . $row['id']);
			//print('<br>iid=' .  $arr_com[0]['iid']);
			//print('<br>cline=' . $row['cline']);
			//print('<br>cowner=' . $row['cowner']);
		}
		//echo '<hr>';
    return $arr_com;
	//func
	}
//class
}
