<?PHP
$_OPTIMIZATION["title"] = "������� - �������";
$user_id = $_SESSION["user_id"];
$db->Query("SELECT * FROM db_users_a, db_users_b WHERE db_users_a.id = db_users_b.id AND db_users_a.id = '$user_id'");
$prof_data = $db->FetchArray();
?>

<div class="row">
    <div class="col s12">
        <h3>���������� ��������</h3>
    </div>
</div>

<div class="row">
    <div class="col offset-s3"></div>
    <div class="col s6">
        <table class="highlight bordered">

            <tbody>
            <tr>
                <td>���� �����������</td>
                <td><?=date("d.m.Y � H:i:s",$prof_data["date_reg"]); ?></td>
            </tr>
            <tr>
                <td>ID / Login</td>
                <td><?=$prof_data["id"]; ?> / <?=$prof_data["user"]; ?></td>
            </tr>
            <tr>
                <td>E-Mail</td>
                <td><?=$prof_data["email"]; ?></td>
            </tr>
            <tr>
                <td>�������</td>
                <td><?=$prof_data["referer"]; ?></td>
            </tr>
            <tr>
                <td>EGR (Eternally Game Rub) </td>
                <td><?=sprintf("%.2f",$prof_data["money_b"]); ?></td>
            </tr>
            <tr>
                <td>EPR (Eternally Payment Rub)</td>
                <td><?=sprintf("%.2f",$prof_data["money_p"]); ?></td>
            </tr>
            <tr>
                <td>���������� �� ���������</td>
                <td><?=sprintf("%.2f",$prof_data["from_referals"]); ?></td>
            </tr>
            <tr>
                <td>�������</td>
                <td><?=sprintf("%.2f",$prof_data["insert_sum"]); ?></td>
            </tr>
            <tr>
                <td>��������</td>
                <td><?=sprintf("%.2f",$prof_data["payment_sum"]); ?></td>
            </tr>

            </tbody>
        </table>
    </div>
    <div class="col offset-s3"></div>
</div>






			
								


  



