
<div class="row">
    <div class="col s12">
        <h3>���� �������</h3>
    </div>
</div>

<?PHP
    $_OPTIMIZATION["title"] = "������� - ������ ����";
    $usid = $_SESSION["user_id"];
    $refid = $_SESSION["referer_id"];
    $usname = $_SESSION["user"];


    # ���������� �� ���������
    $db->Query("SELECT * FROM db_stats_btree WHERE user_id = '$usid' ORDER BY date_del ASC");

if($_GET){

    $sort = $_GET['sort'];

    switch ($sort){

        case 'name_a':
            $db->Query("SELECT * FROM db_stats_btree WHERE user_id = '$usid' ORDER BY tree_name ASC");
            break;
        case 'name_d':
            $db->Query("SELECT * FROM db_stats_btree WHERE user_id = '$usid' ORDER BY tree_name DESC");
        break;

        case 'price_a':
            $db->Query("SELECT * FROM db_stats_btree WHERE user_id = '$usid' ORDER BY amount ASC");
            break;
        case 'price_d':
            $db->Query("SELECT * FROM db_stats_btree WHERE user_id = '$usid' ORDER BY amount DESC");
            break;

        case 'buy_a':
            $db->Query("SELECT * FROM db_stats_btree WHERE user_id = '$usid' ORDER BY date_add ASC");
            break;
        case 'buy_d':
            $db->Query("SELECT * FROM db_stats_btree WHERE user_id = '$usid' ORDER BY date_add DESC");
            break;

        case 'del_a':
            $db->Query("SELECT * FROM db_stats_btree WHERE user_id = '$usid' ORDER BY date_del");
            break;
        case 'del_d':
            $db->Query("SELECT * FROM db_stats_btree WHERE user_id = '$usid' ORDER BY date_del DESC");
            break;

    }

}



?>

<div class="row">
    <div class="col offset-s2"></div>
    <div class="col s8">
        <table class="bordered centered">
            <thead>
            <tr>
                <th><a href="/index.php?menu=account&sel=items&sort=name_a">&darr;</a> �������� <a href="/index.php?menu=account&sel=items&sort=name_d">&uarr;</a></th>
                <th><a href="/index.php?menu=account&sel=items&sort=price_a">&darr;</a> ���� <a href="/index.php?menu=account&sel=items&sort=price_d">&uarr;</a></th>
                <th><a href="/index.php?menu=account&sel=items&sort=buy_a">&darr;</a> ������� <a href="/index.php?menu=account&sel=items&sort=buy_d">&uarr;</a></th>
                <th><a href="/index.php?menu=account&sel=items&sort=del_a">&darr;</a> �������� <a href="/index.php?menu=account&sel=items&sort=del_d">&uarr;</a></th>
            </tr>
            </thead>
            <tbody>

            <?php



            while($item = $db->FetchArray()){ ?>
                <tr>
                    <td class="left"><?= $item['tree_name'] ?></td>
                    <td><?= $item['amount'] . '.00' ?></td>
                    <td><?= date('Y-M-d', $item['date_add']) ?></td>
                    <td><?= date('Y-M-d', $item['date_del']) ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="col offset-s2"></div>
</div>





