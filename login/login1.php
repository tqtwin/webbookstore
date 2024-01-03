<?php
session_start();
require_once '../vendor/autoload.php';

// Lấy những giá trị này từ https://console.google.com
$client_id = '357554465855-ugqt898er6k8jft6e2nm0bbr1p7krrl2.apps.googleusercontent.com'; 
$client_secret = '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';
$redirect_uri = 'http://bookstore.com:8080/websitebookstore/google-api/login/login1.php';

//Thông tin kết nói database
$db_username = "root"; //Database Username
$db_password = ""; //Database Password
$host_name = "localhost"; //Mysql Hostname
$db_name = 'Webbookstore'; //Database Name
###################################################################

$client = new Google_Client();
$client->setClientId($client_id);
$client->setClientSecret($client_secret);
$client->setRedirectUri($redirect_uri);
$client->addScope("email");
$client->addScope("profile");
$service = new Google_Service_Oauth2($client);

// Nếu kết nối thành công, sau đó xử lý thông tin và lưu vào database
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
    $client->setAccessToken($_SESSION['access_token']);
    $user = $service->userinfo->get();

    // connect to the database
    $mysqli = new mysqli($host_name, $db_username, $db_password, $db_name);
    if ($mysqli->connect_error) {
        die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
    }

    // Kiểm tra xem nếu user này đã tồn tại, sau đó nên login tự động
    $result = $mysqli->query("SELECT COUNT(email) as customercount FROM customer WHERE email= '{$user->email}'");
    $user_count = $result->fetch_object()->customercount; //will return 0 if the user doesn't exist

    // show user picture
    echo '<img src="'.$user->picture.'" style="float: right;margin-top: 33px;" />';

    if ($user_count) // Nếu user tồn tại thì show thông tin hiện có
    {
       
        $_SESSION['email'] = $user->email;
        $_SESSION['google_picture_link'] = $user->picture;
        $_SESSION['google_name'] = $user->name;
        header("Location: ../../index.php");
    } else // Ngược lại tạo mới 1 user vào database
    { 
        $statement = $mysqli->prepare("INSERT INTO customer( name, email, gender, avatar) VALUES (?,?,?,?)");
        $statement->bind_param('ssss', $user->name, $user->email, $user->gender, $user->picture);
        $statement->execute();
        
        // Check for errors after executing the statement
        if ($statement->error) {
            echo "Error: " . $statement->error;
        }

        // Close the statement
        $statement->close();
       
        $_SESSION['email'] = $user->email;
        $_SESSION['google_picture_link'] = $user->picture;
        $_SESSION['google_name'] = $user->name;
        header("Location: ../../index.php");
    }

    // Close the database connection
    $mysqli->close();
    exit;
}
if (isset($_GET['code'])) {
    $client->authenticate($_GET['code']);
    $_SESSION['access_token'] = $client->getAccessToken();
    header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
    exit;
}
// Nếu sẵn sàng kết nối, sau đó lưu session với tên access_token
$authUrl = $client->createAuthUrl();

// Redirect the user to the Google login page
header("Location: " . $authUrl);
exit;
