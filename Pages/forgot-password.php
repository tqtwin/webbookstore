<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vandor/PHPMailer/PHPMailer-master/src/Exception.php';
require './vandor/PHPMailer/PHPMailer-master/src/PHPMailer.php';
require './vandor/PHPMailer/PHPMailer-master/src/SMTP.php';

// Khởi tạo biến để kiểm tra xem đã gửi mã hay chưa
$sentCode = false;
$email1 = $_POST['enteredUsername'];
require("./Database/connect-mysql.php");

if (isset($_GET['username'])) {
    $usernameFromLogin = $_GET['username'];
    $sql = "SELECT email FROM `customer` WHERE `username` = '$usernameFromLogin'";
}

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Lỗi lấy dữ liệu sách, lỗi: " . mysqli_error($conn));
}
while ($row = mysqli_fetch_array($result)) {
    $email1 = $row['email'];
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thangtran081003@gmail.com';
        $mail->Password = 'hdjk hrwt fxvu hfjs';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('thangtran081003@gmail.com', 'bookstore');
        $mail->addAddress($email1, $usernameFromLogin);

        // Content
        $mail->isHTML(true);
        // Tạo mã xác nhận gồm 6 số
        $resetCode = rand(100000, 999999);
        $_SESSION['resetCode'] = $resetCode; // Set session variable

        $mail->Subject = 'Websitebookstore';
        $mail->Body = 'Mã xác minh của bạn là:<b> ' . $resetCode . '</b><br>Vui lòng không cung cấp mã xác minh cho bất kỳ ai khác.';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        // Đánh dấu là đã gửi mã thành công
        $sentCode = true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên Mật Khẩu</title>
    <style>
        .forgot-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 60vh;
            margin-left: 50%;
        }

        .forgot-form {
            width: 500px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        .forgot-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .forgot-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            outline: none;
        }

        .forgot-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="forgot-container">
    <form action="./index.php?Page=reset-password&email=<?php echo $email1; ?>" method="post" class="forgot-form" onsubmit="return checkEnteredCode()">
            <?php if ($sentCode): ?>
                <!-- If the code has been sent, display the input for confirmation -->
                <p>Chúng tôi đã gửi mã xác minh đến gmail: <?php echo Anthongtin($email1) ?></p>
                <label for="enteredCode">Mã xác nhận:</label>
                <input type="text" name="enteredCode" id="enteredCode" required autocomplete="off">
                <button type="submit">Xác nhận</button>
            <?php else: ?>
                <!-- If the code has not been sent, display a script alert and redirect -->
                <script>
                    alert('Gửi mã xác minh không thành công, vui lòng thử lại');
                    window.location.href = './index.php?Page=login';
                </script>
            <?php endif; ?>
        </form>
    </div>

    <script>
        function checkEnteredCode() {
            var enteredCode = document.getElementById('enteredCode').value;
            var resetCode = <?php echo $resetCode; ?>;

            if (enteredCode === resetCode.toString()) {
                // Redirect to reset-password page
                return true;
            } else {
                // Display an alert and stay on the current page
                alert('Mã xác nhận không đúng. Vui lòng kiểm tra lại.'<?php echo $enteredCode;echo $resetcode;?>);
                return false;
            }
        }
        <?php
function Anthongtin($soDienThoai) {
    $doDai = strlen($soDienThoai);

    if ($doDai < 4) {
        return $soDienThoai;
    }
    $soKyTuCanCheGiau = $doDai - 4;
    $soDau = substr($soDienThoai, 0, 2);
    $soCuoi = substr($soDienThoai, -2);

    $chuoiMoi = $soDau . str_repeat('*', $soKyTuCanCheGiau) . $soCuoi;

    return $chuoiMoi;
}
?>
    </script>
</body>
</html>
