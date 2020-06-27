<?php
include 'includes/session.php';

if (isset($_POST['getdonation'])) {
    $senddonationid = $_GET['id'];
    $status = $_POST['status'];

    $sql = "UPDATE donation_reciept SET status = '$status' WHERE send_donation_id = '$senddonationid'";
    if ($conn->query($sql)) {
        $sql = "UPDATE get_donation SET status = '$status' WHERE id = '$senddonationid'";
        $conn->query($sql);

        $sql = "UPDATE send_donation SET status = '$status' WHERE id = '$senddonationid'";
        $conn->query($sql);

        $sql = "SELECT * FROM get_donation WHERE id='$senddonationid'";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();
        $m_id = $row['get_id'];
        $amount = $row['amount'];
        $proid = $row['provide_id'];
        $get_mem_id = $row['member_id'];
        $provideno=$row['get_help_no'];
        $g_amont = $amount;

        $provide_count=0;
        $sql = "SELECT * FROM provide_help WHERE id = '$proid'";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $provide_count = $row['provide_count'];
        }

        if($status=='approved'){
            // $sql = "INSERT INTO growth(member_id,provided_to,provide_amount) VALUES('$m_id','$get_mem_id','$amount')";
            // $conn->query($sql);
    
            $sql = "SELECT * FROM wallet WHERE member_id='$m_id'";
            $query = $conn->query($sql);
            $row = $query->fetch_assoc();
            $grow_am = $row['growth'];
            $grow_am=$grow_am+$g_amont;
    
            // $sql = "UPDATE wallet SET growth ='$grow_am' WHERE member_id='$m_id'";
            // $conn->query($sql);
    
            $prevdate = date("Y-m-d H:i:s");
            $date = new DateTime($prevdate);
            $date->add(new DateInterval('P4DT4H'));
            $date = $date->format('Y-m-d H:i:s');
            
            if($provide_count==0){
                $sql="UPDATE provide_help SET status = 'pendingGet' , approved_datetime = '$date' WHERE id='$proid'";
                $conn->query($sql);
            }
            
            //$memberid=$user['member_id'];
            $memberid = $m_id;
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
        }else{
            //increasing getcount if get donation is rejected
            if($provide_count==0){
                $sql = "UPDATE provide_help SET status = 'Donation Rejected' WHERE id='$proid'";
                $conn->query($sql);
            }

            $get_count = 0;
            $sql = "SELECT * FROM provide_help WHERE provide_help_no='$provideno'";
            $query = $conn->query($sql);
            while ($row = $query->fetch_assoc()) {
                $get_count = $row['get_count'];
            }
            $get_count=$get_count+1;
            $sql = "UPDATE provide_help SET complete = 'false' , status = 'approved' , get_count = '$get_count' WHERE provide_help_no = '$provideno'";
            $conn->query($sql);
        }

        $_SESSION['success'] = $status.' Successfully.';
    } else {
        $_SESSION['error'] = 'Error!!';
    }
}
header('location: home.php');
