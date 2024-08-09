<?php
// session_start();
include('../connect.php');

$rname = $_POST['rname'];
$rnumber = $_POST['rnumber'];
$remail = $_POST['remail'];
$address = $_POST['address'];
$rpass = $_POST['rpass'];
$rbname = $_POST['rbname'];
$rcode = $_POST['rcode'];
$accno = $_POST['accno'];
$rcname = $_POST['rcname'];
$rweb = $_POST['rweb'];
$gno = $_POST['gno'];
$state = $_POST['state'];

$uploadedFiles = $_FILES['files'];
$allFilesInserted = true;
$imageArray = [];
for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
    $file = array(
        'name' => $uploadedFiles['name'][$i],
        'type' => $uploadedFiles['type'][$i],
        'tmp_name' => $uploadedFiles['tmp_name'][$i],
        'error' => $uploadedFiles['error'][$i],
        'size' => $uploadedFiles['size'][$i]
    );

    if ($file['error'] === UPLOAD_ERR_OK) {
        $targetDir = '../uploads/';
        $uploadedFilePath = upload_Profile($file['name'], $file['tmp_name'], $targetDir);

        if ($uploadedFilePath) {
            $imageArray[] = $uploadedFilePath;
        }
    }
}
$uploadedFilesString = implode(',', $imageArray);


$sql = "INSERT INTO registration (`state`,`gstNumber`,`name`, `mobile`, `email`, `address`, `password`, `bankname`, `ifscno`, `accno`, `cname`, `web`,`logo`) VALUES (?,?,?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?)";
$stmt = $con->prepare($sql);

// Adjusted bind_param to include all 11 parameters
$stmt->bind_param("sssssssssssss", $state, $gno, $rname, $rnumber, $remail, $address, $rpass, $rbname, $rcode, $accno, $rcname, $rweb, $uploadedFilesString);
$query0 = $stmt->execute();
function upload_Profile($fileName, $image, $target_dir)
{
    if ($fileName != "") {
        $target_file = $target_dir . basename($fileName);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $msg = " ";
        try {
            $check = getimagesize($image);
            $msg = array();
            if ($check !== false) {
                $uploadOk = 1;
            }
            if (file_exists($target_file)) {
                $msg[1] = "Sorry, file already exists.";
                $uploadOk = 0;
            }
            if ($imageFileType != "pdf" && $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $msg[2] = "Sorry, only PDF, JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                $msg[3] = "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($image, $target_file)) {
                } else {
                    $msg[4] = "Sorry, there was an error uploading your file.";
                }
            }
            return ltrim($target_file, '');
        } catch (Exception $e) {
        }
    } else {
        return "";
    }
}

if ($query0) {
    echo json_encode(["status" => "success", "message" => "Request has been sent successfully!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed! Please Try Again"]);
}

$stmt->close();