<?php
//namespace Comment;

//class Show {
class CreatePicture {

    //
    public function showMain($pict_id){

    echo <<< EOM
<table cellpadding=0 bgcolor=#FFFFFF width=100% border=0>
<tr>
<td align=center bgcolor=#FFFFFF><img src='./files/
EOM;

    //picture id の画像指定（ページ指定）を持ってくる。
// $pname= DB(pid = $pict_id)
//このクラスはどこに入れるか？

// $pict_name = $pname;
// echo "$pname";

    echo "shimokita";

    echo <<< EOM
.jpg'' width=100%></td>
</tr>
</table>
EOM;

    }
}


