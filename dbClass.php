<?php
namespace Comment;

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
		$db_selected = mysql_select_db('researchstudent_ci', $link);
		if (!$db_selected){
			die('データベース選択失敗です。'.mysql_error());
		}
		mysql_set_charset('utf8');
		$result = mysql_query('SELECT * FROM comment');
		if (!$result) {
			die('クエリーが失敗しました。'.mysql_error());
		}
		mysql_close($link);
        $arr_com = array();
		while($row = mysql_fetch_assoc($result)){
			if ($row['cowner'] == 'XXX') {
				throw new Exception ('「Exceptionって知ってる？<br>知らないよね。<br>じゃあいいや、気にしないでねｗ」');
			}
			$arr_com[ ] = $row;
		}
    return $arr_com;
	//func
	}
//class
}
