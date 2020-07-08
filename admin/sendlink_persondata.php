<?php
    include 'includes/session.php';
    
	if(isset($_POST['sendlink'])){

		$sendmember = $_POST['sendmember'];
        $str = explode("_", $sendmember);
        $sendmember=$str[0];
        $proid= $str[1];
        $proid= intval($proid);

        $id=$_GET['id'];
        $provideno=$_GET['pno'];
        
        $amount=0;
        $sendname="";
        $sendphoneno="";
        $getname = "";
        $getphoneno = "";
        $get_count=0;
        $provide_count=0;
        $sendamount = 200;

        $date = date('Y-m-d H:i:s');

        $sql = "SELECT * FROM provide_help WHERE id = '$proid'";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $provide_count = $row['provide_count'];
        }
        
        $sql="SELECT * FROM provide_help WHERE provide_help_no='$provideno'";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $amount = $row['amount'];
            $get_count=$row['get_count'];
        }

        $sql = "SELECT * FROM members WHERE member_id='$id'";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $sendname = $row['name'];
            $sendphoneno=$row['mobile'];
        }
        $sql = "SELECT * FROM members WHERE member_id='$sendmember'";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
            $getname = $row['name'];
            $getphoneno = $row['mobile'];
        }

        if($get_count==1){
            $get_count = $get_count - 1;
            $sql = "UPDATE provide_help SET complete = 'true',status='approved',get_count='$get_count' WHERE provide_help_no = '$provideno'";
            if ($conn->query($sql)) {
                $sql = "INSERT INTO send_donation (member_id,send_id,name,phoneno,amount,date) 
                            VALUES('$sendmember','$id','$sendname','$sendphoneno','$sendamount','$date'";
                $conn->query($sql);
                $sql = "INSERT INTO get_donation (member_id,get_id,name,phoneno,amount,provide_id,get_help_no,date) 
                            VALUES('$id','$sendmember','$getname','$getphoneno','$sendamount','$proid','$provideno','$date')";
                $conn->query($sql);

                if ($provide_count == 1) {
                    $provide_count = $provide_count - 1;
                    $sql = "UPDATE provide_help SET status='Sent' , provide_count = '$provide_count' WHERE id = '$proid'";
                    $conn->query($sql);
                } else {
                    $provide_count = $provide_count - 1;
                    $sql = "UPDATE provide_help SET provide_count = '$provide_count' WHERE id = '$proid'";
                    $conn->query($sql);
                }

                $_SESSION['success'] = 'Sent successfully';
            } else {
                $_SESSION['error'] = "Error";
            }
        }else{
            $get_count = $get_count - 1;
            $sql = "UPDATE provide_help SET get_count = '$get_count' WHERE provide_help_no = '$provideno'";
            if ($conn->query($sql)) {
                $sql = "INSERT INTO send_donation (member_id,send_id,name,phoneno,amount,date) 
                        VALUES('$sendmember','$id','$sendname','$sendphoneno','$sendamount','$date'";
                $conn->query($sql);
                $sql = "INSERT INTO get_donation (member_id,get_id,name,phoneno,amount,provide_id,get_help_no,date) 
                        VALUES('$id','$sendmember','$getname','$getphoneno','$sendamount','$proid','$provideno','$date')";
                $conn->query($sql);

                if ($provide_count == 1) {
                    $provide_count = $provide_count - 1;
                    $sql = "UPDATE provide_help SET status='Sent' , provide_count = '$provide_count' WHERE id = '$proid'";
                    $conn->query($sql);
                } else {
                    $provide_count = $provide_count - 1;
                    $sql = "UPDATE provide_help SET provide_count = '$provide_count' WHERE id = '$proid'";
                    $conn->query($sql);
                }

                $_SESSION['success'] = 'Sent successfully';
            } else {
                $_SESSION['error'] = "Error";
            }
        }
        
        //Sending PH sms
        $newphone = '91' . $getphoneno;
        // Authorisation details.
        $username = "clubminibank@gmail.com";
        $hash = "ed5bdeba90f28aa5d973bf3cb54863dd0b4ae39f3a6dd7e85087803376046499";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "TXTLCL"; // This is who the message appears to be from.
        $numbers = $newphone; // A single number or a comma-seperated list of numbers
        $message = "Hello " . $sendmember . " ,\n" . "You have a PH Link(200).\n" . "From  " . $id . ", (" . $sendphoneno . "). \nRegards,\n https://minibank.tech/";
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);

        //sending GH sms
        $newphone = '91' . $sendphoneno;
        // Authorisation details.
        $username = "clubminibank@gmail.com";
        $hash = "ed5bdeba90f28aa5d973bf3cb54863dd0b4ae39f3a6dd7e85087803376046499";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "TXTLCL"; // This is who the message appears to be from.
        $numbers = $newphone; // A single number or a comma-seperated list of numbers
        $message = "Hello " . $id . " ,\n" . "You have a GH Link(200).\n" . "From  " . $sendmember . ", (" . $getphoneno . "). \nRegards,\n https://minibank.tech/";
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = urlencode($message);
        $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);
        
	}else{
        $_SESSION['error'] = "Error";
    }

	header('location: gethelpconfirm_list.php');
