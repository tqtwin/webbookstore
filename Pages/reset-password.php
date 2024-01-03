<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt Lại Mật Khẩu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style>
    .reset-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 60vh;
        margin-left: 500px;
    }

    .reset-form {
        width: 500px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: #fff;
        position: relative;
    }

    .reset-form h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .reset-form input {
        width: calc(100% - 30px); /* Adjusted width to accommodate icons */
        padding: 10px;
        margin-bottom: 10px;
        outline: none;
        position: relative;
    }

    .fa-check, .fa-times {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .fa-check {
        color: green;
        display: none;
    }

    .fa-times {
        color: red;
        display: none;
    }

    .reset-form button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    label {
        float: left;
        width: 150px;
        margin-right: 20px;
    }

    .row1 {
        padding: 10px;
    }

    div[id*="error"] {
        margin-left: 100px;
        color: red;
    }

    div[id^="div_"] {
        position: relative;
    }

    textarea {
        margin-left: 120px;
    }

    input[type="checkbox"] {
        margin-left: 130px;
    }

    #button {
        margin-left: 130px;
    }

    .border-error {
        border: 1px solid red;
    }

    .border-success {
        border: 1px solid green;
    }

    .color-error {
        color: red;
    }

    .color-success {
        color: green;
    }
</style>
<body>
    <?php $email = $_GET['email']; 
?>
<div class="reset-container">
<form action="Pages/reset-password-process.php?email=<?php echo $email?>" method="post" class="reset-form">
        <h2>Đặt mật khẩu mới</h2>
        <div class="row1">
            <label>Mật khẩu mới</label>
            <div id="div_password">
                <input type="password" name="txt_password" id="txt_password" style="outline: none;" onblur="ValidatePassword();" maxlength="20">
                <i id="i_password" class="fa1 fa fa-times" aria-hidden="true" style="display: none;"></i>
            </div>
            <div id="error_password"></div>
        </div>
        <div class="row1">
            <label>Xác nhận mật khẩu</label>
            <div id="div_repassword">
                <input type="password" name="txt_repassword" id="txt_repassword" style="outline: none;" onblur="ValidateRepassword();" maxlength="20">
                <i id="i_repassword" class="fa fa-check" aria-hidden="true" style="display: none;"></i>
            </div>
            <div id="error_repassword"></div>
        </div>
        <button type="submit" class="btn btn-primary">Đồng ý</button>
    </form>
</div>
</body>
<script>
    function Add_Class_Error(input, i, successIcon, error, text) {
        input.classList.remove("border-success");
        input.classList.add("border-error");
        i.classList.remove("color-success");
        i.classList.remove("fa-check");
        i.classList.add("color-error");
        i.classList.add("fa-times");
        i.style.display = 'inline';
        error.innerHTML = text;
    }

    function Add_Class_Success(input, i, successIcon, error) {
        input.classList.remove("border-error");
        input.classList.add("border-success");
        i.classList.remove("color-error");
        i.classList.remove("fa-times");
        i.classList.add("color-success");
        i.classList.add("fa-check");
        i.style.display = 'inline';
        error.innerHTML = "";
    }

    function ValidatePassword1(password) {
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return passwordRegex.test(password);
    }

    function ValidatePassword() {
        let input = document.getElementById("txt_password");
        let i = document.getElementById("i_password");
        let successIcon = document.getElementById("i_password_success");
        let error = document.getElementById("error_password");

        if (!input.value) {
            Add_Class_Error(input, i, successIcon, error, "Vui lòng nhập chính xác mật khẩu!.");
        } else if (!ValidatePassword1(input.value)) {
            Add_Class_Error(input, i, successIcon, error, "Mật khẩu phải bao gồm chữ cái đầu viết hoa và ít nhất 1 ký tự đặc biệt (@$!%*?&).");
        } else {
            Add_Class_Success(input, i, successIcon, error);
        }
    }

    function ValidateRepassword() {
        let input = document.getElementById("txt_repassword");
        let i = document.getElementById("i_repassword");
        let successIcon = document.getElementById("i_repassword_success");
        let error = document.getElementById("error_repassword");

        if (!input.value) {
            Add_Class_Error(input, i, successIcon, error, "Xác nhận mật khẩu không được bỏ trống.");
        } else if (input.value !== document.getElementById("txt_password").value) {
            Add_Class_Error(input, i, successIcon, error, "Xác nhận mật khẩu không khớp với mật khẩu ban đầu.");
        } else {
            Add_Class_Success(input, i, successIcon, error);
        }
    }
</script>
</html>
