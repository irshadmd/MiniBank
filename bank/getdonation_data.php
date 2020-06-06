<?php
include 'includes/session.php';

if (isset($_POST['getdonation'])) {
    $senddonationid = $_GET['id'];
    $status = $_POST['status'];

    $sql = "UPDATE donation_reciept SET status = '$status' WHERE send_donation_id = '$senddonationid'";
    if ($conn->query($sql)) {
        $sql = "UPDATE get_donation SET status = 'approved' WHERE id = '$senddonationid'";
        $conn->query($sql);

        $sql="SELECT * FROM get_donation WHERE id='$senddonationid'";
        $query=$conn->query($sql);
        $row=$query->fetch_assoc();
        $m_id=$row['get_id'];
        $amount=$row['amount'];
        $proid=$row['provide_id'];
        $get_mem_id=$row['member_id'];
        $g_amont=$amount;
        
        $sql = "INSERT INTO growth(member_id,provided_to,provide_amount) VALUES('$m_id','$get_mem_id','$amount')";
        $conn->query($sql);

        $sql = "SELECT * FROM wallet WHERE member_id='$m_id'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $grow_am = $row['growth'];
        $grow_am=$grow_am+$g_amont;

        $sql = "UPDATE wallet SET growth ='$grow_am' WHERE member_id='$m_id'";
        $conn->query($sql);

        $prevdate = date("Y-m-d H:i:s");
        $date = new DateTime($prevdate);
        $date->add(new DateInterval('P4DT4H'));
        $date = $date->format('Y-m-d H:i:s');

        $sql="UPDATE provide_help SET status='pendingGet',approved_datetime = '$date' WHERE id='$proid'";
        $conn->query($sql);
        
        $memberid=$user['member_id'];
        $sql = "SELECT * FROM members WHERE member_id='$memberid'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $sponcer_info = $row['sponcer_info'];
        $str = explode(",", $sponcer_info);

        foreach ($str as $val) {
            if ($val == 'admin') {
                // echo "this is admin";
            } else {
                // echo "this is not admin";
                $sql="SELECT * FROM members WHERE member_id='$val'";
                $query = $conn->query($sql);
                $row = $query->fetch_assoc();
                $level = $row['level'];

                $sql = "SELECT * FROM wallet WHERE member_id='$val'";
                $query = $conn->query($sql);
                $row = $query->fetch_assoc();
                $walletmoney = $row['money'];

                if($level==1 or $level==0){
                    //10% share
                    $c_amount=$amount*0.1;
                    $moneyupdated=$walletmoney+$c_amount;
                    $narration='Level income got by '.$memberid;

                    $sql = "UPDATE wallet SET money='$moneyupdated' WHERE member_id='$val'";
                    $conn->query($sql);

                    $sql = "INSERT INTO working_wallet(member_id,credit,narration) VALUES('$val','$c_amount','$narration')";
                    $conn->query($sql);

                }else if($level==2){
                    //5% share
                    $c_amount = $amount * 0.05;
                    $moneyupdated = $walletmoney + $c_amount;
                    $narration = 'Level income got by ' . $memberid;

                    $sql = "UPDATE wallet SET money='$moneyupdated' WHERE member_id='$val'";
                    $conn->query($sql);

                    $sql = "INSERT INTO working_wallet(member_id,credit,narration) VALUES('$val','$c_amount','$narration')";
                    $conn->query($sql);
                }else{
                    //1% share
                    $c_amount = $amount * 0.01;
                    $moneyupdated = $walletmoney + $c_amount;
                    $narration = 'Level income got by ' . $memberid;

                    $sql = "UPDATE wallet SET money='$moneyupdated' WHERE member_id='$val'";
                    $conn->query($sql);

                    $sql = "INSERT INTO working_wallet(member_id,credit,narration) VALUES('$val','$c_amount','$narration')";
                    $conn->query($sql);
                }
            }
        }

        $_SESSION['success'] = 'Approved Successfully.';
    } else {
        $_SESSION['error'] = 'Error!!';
    }
}
header('location: home.php');
