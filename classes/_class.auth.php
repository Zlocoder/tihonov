<?php

Class Auth{

    public static function auth1(){
        if(isset($_POST["log_email"])){

            $lmail = $func->IsMail($_POST["log_email"]);

            if($lmail !== false){

                $db->Query("SELECT id, user, pass, referer_id, banned FROM db_users_a WHERE email = '$lmail'");
                if($db->NumRows() == 1){

                    $log_data = $db->FetchArray();

                    if($log_data["pass"] == md5($_POST["pass"])){

                        if($log_data["banned"] == 0){

                            # ������� ���������
                            $db->Query("SELECT COUNT(*) FROM db_users_a WHERE referer_id = '".$log_data["id"]."'");
                            $refs = $db->FetchRow();

                            $db->Query("UPDATE db_users_a SET referals = '$refs', date_login = '".time()."', ip = INET_ATON('".$func->UserIP."') WHERE id = '".$log_data["id"]."'");

                            $_SESSION["user_id"] = $log_data["id"];
                            $_SESSION["user"] = $log_data["user"];
                            $_SESSION["referer_id"] = $log_data["referer_id"];
                            Header("Location: /account");

                        }else echo "<center><font color = 'black'><b>������� ������������</b></font></center><BR />";

                    }else echo "<center><font color = 'black'><b>Email �/��� ������ ������ �������</b></font></center><BR />";

                }else echo "<center><font color = 'black'><b>��������� Email �� ��������������� � �������</b></font></center><BR />";

            }else echo "<center><font color = 'black'><b>Email ������ �������</b></font></center><BR />";

        }
    }

}