<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
   
    <title>Đăng nhập</title>
    <style>
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 60vh;
            margin-left: 150%;
            margin-top: 70px;
        }

        .login-form {
            width: 500px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            outline: none;
        }

        .login-form button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .login-form .error-message {
            color: red;
            margin-top: 5px;
        }

        .form-button {
            width: 250px;
            margin-left: 100px;
            display: flex;
            justify-content: space-between;
        }

        @media (max-width: 768px) {
            .login-container {
                margin-left: 0;
            }

            .login-form {
                width: 80%;
            }

            .form-button {
                width: 100%;
                margin-left: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
<div class="login-container">
    <form action="./Control/customer-login.php" method="post" onsubmit="return validateForm()" class="login-form">
        <h2>ĐĂNG NHẬP</h2>

        <div class="row">
            <label for="username">Tên đăng nhập</label>
            <input autofocus type="text" name="txt_username" id="txt_username" oninput="updateHiddenUsername()">
            <input type="hidden" name="hidden_username" id="hidden_username" value="">
        </div>

        <div id="error_username" class="error-message"></div>

        <div class="row">
            <label for="password">Mật khẩu</label>
            <input type="password" name="txt_password" id="txt_password" oninput="validatePassword()">
        </div>
        <div id="error_password" class="error-message"></div>

        <div class="form-button">
            <button type="submit" class="btn btn-primary">Đăng nhập</button>
            <a href="?Page=signup"><button type="button" class="btn btn-primary">Đăng ký</button></a>
        </div>

        <a href="?Page=forgot-password&username=" id="forgotPasswordLink" style="margin-left: 180px;">Quên mật khẩu</a>
    </form>
    <a href="./google-api/login/login1.php">Đăng nhập bằng google</a>
</div>

<script type="text/javascript" src="./JS/login.js">



</script>


</body>
</html>
