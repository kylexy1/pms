<?php require_once '../web-config/config.php';
require_once '../web-config/database.php';
require_once 'includes/encryption.php';
if (isset($_POST['save1'])) {
    $given = $database->escape_value($_POST['given_name']);
    $fnames = $database->escape_value($_POST['family_names']);
    $other = $database->escape_value($_POST['other_names']);
    $gender = $database->escape_value($_POST['gender']);
    $dob = $_POST['dob'];
    $pob = $database->escape_value($_POST['pob']);
    $nob = $_POST['nob'];
    $nop = $_POST['nop'];
    $doi = $_POST['doi'];
    $doe = $_POST['doe'];
    $email = $database->escape_value($_POST['email']);
    $telephone = $database->escape_value($_POST['telephone']);
    $pass_no = $database->escape_value($_POST['pass_no']);
    $profession = $database->escape_value($_POST['profession']);
    $occupation = $database->escape_value($_POST['occupation']);
    $employer = $database->escape_value($_POST['employer']);
    $father_name = $database->escape_value($_POST['father_name']);
    $father_nat = $database->escape_value($_POST['father_nat']);
    $mother_name = $database->escape_value($_POST['mother_name']);
    $mother_nat = $database->escape_value($_POST['mother_nat']);
    $marital_status = $database->escape_value($_POST['marital_status']);
    $embassy = $_POST['embassy'];

    if (isset($_POST['update'])){
        $update_id = $_POST['update'];
        $sql = "UPDATE diplomats SET given_names='$given',family_names='$fnames',other_names='$other',gender='$gender',dob='$dob',pob='$pob',nob='$nop',email='$email',telephone='$telephone',pass_no='$pass_no',nop='$nop',doi='$doi',doe='$doe',profession='$profession',occupation='$occupation',father_name='$father_name',father_nat='$father_nat',mother_name='$mother_name',mother_nat='$mother_nat',marital_status='$marital_status',embassy='$embassy' WHERE id=$update_id";
        if ($database->query($sql)) {
            $id=$Hash->encrypt($update_id);
            header("location:register-ambassador-step2?id=$id");
        }
    }

    $sql= "INSERT INTO diplomats(given_names,family_names,other_names,gender,dob,pob,nob,email,telephone,pass_no,nop,doi,doe,profession,occupation,father_name,father_nat,mother_name,mother_nat,marital_status,embassy,type) VALUES('$given','$fnames','$other','$gender','$dob','$pob','$nob','$email','$telephone','$pass_no','$nop','$doi','$doe','$profession','$occupation','$father_name','$father_nat','$mother_name','$mother_nat','$marital_status','$embassy','ambassador')";

    if ($database->query($sql)) {
        $id=$database->inset_id();
        $id=$Hash->encrypt($database->inset_id());
        header("location:register-ambassador-step2?id=$id");
    }


}
if (isset($_POST['save2'])){
    $request_date = $database->escape_value($_POST['request-d']);
    $arrival = $database->escape_value($_POST['arrival']);
    $departure = $database->escape_value($_POST['departure']);

    $cred= $database->escape_value($_POST['cred']);
    $ambassador=$Hash->decrypt($_POST["ambassador"]);
    if (isset($_POST['ambass'])){
        $id_add = $_POST['ambass'];
        $sql = "UPDATE add_info_amb SET request_date='$request_date',arrival='$arrival',departure='$departure',presentation_date='$cred' WHERE id=$id_add ";
        header("location:displayperson?id=$ambassador");
    }else{
    if ($database->query($sql)) {
        $sql = "INSERT INTO add_info_amb(request_date,arrival,departure,presentation_date) VALUES ('$request_date','$arrival','$departure','$cred')";
        header("location:displayperson?id=$ambassador");
    }
    }
}

