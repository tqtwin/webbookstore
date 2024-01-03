<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập tổng hợp</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <!-- <link rel="stylesheet" href="../CSS/signup.css"> -->
    <style>
        .signup-container {
            margin-left: 210px;
            margin-top: 100px;
            width: 1200px;
            height: 1000px;
            background-color: #3b414b;
            display: flex;
            border: 1px solid red;
        } 
        .hidden {
            display: none;
        }
        .left-signup {
            width: 60%;
        }

        .right-signup {
            width: 40%;
        }
        
        label {
    width: 150px;
    margin-right: 20px;
    color: white;
    text-align: right; /* Thêm dòng này để chữ hiển thị từ phải sang trái */
}
        .hien
        {
            color: blue;
            background-color: white;
            border: none;
            outline: none;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .row1 {
            padding: 10px;
            display: flex;
            
        }

        input[type="text"],
        input[type="date"],
        input[type="password"],
        input[type="tel"],
        select[type="country"] {
            width: 400px;
            border-radius: 10px;
          height: 35px;
        }

        div[id*="error"] {
            margin-left: 180px;
            color: red;
            font-size: 12px;
            height: 10px;
        }

        div[id^="div_"] {
            position: relative;
        }



        .fa-check {
            opacity: 1;
            color: green;
        }

        .fa-times {
            opacity: 1;
            color: red;
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
            border: 2px solid red;
        }
        .border-success {
            border: 2px solid green;
        }

        .color-error {
            color: red;
        }

        .color-success {
            color: green;
        }
       .password{position: absolute;right: 1px;top: 2px;}
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="left-signup">
        <form id="signupForm" action="./Pages/customer-signup.php" class="was-validated" method="post" enctype="multipart/form-data">
            <p style="text-align: center; color:white; font-size:20px">Đăng ký</p><hr>
            <div class="row1">
                    <label class="label">Tên đăng nhập</label>
                    <div id="div_username" class="div-container input">
                        <input type="text" autofocus name="txt_username" id="txt_username" style="outline: none;" placeholder="Nhập vào tên tài khoản" onblur="ValidateUsername();" maxlength="30"> 
                    </div>
                    <i id="i_username" class="fa fa-times" aria-hidden="true" style="display: none;"></i>
                    </div>
                    <div id="error_username" class="error-message"></div>
            <div class="row1">
                    <label class="label">Mật khẩu</label>
                    <div id="div_password">
                        <input type="password" name="txt_password" id="txt_password"style="outline: none;" onblur="ValidatePassword();" maxlength="20">
                        <input type="button" id="bt_AnHien" name="bt_AnHien" value="Hiện" class="hien password" onclick="AnHien();">
                    </div>
                        <i id="i_password" class="fa fa-times" aria-hidden="true" style="display: none;" ></i></div>
                <div id="error_password"></div>  
            <div class="row1">
                    <label class="label">Xác nhận mật khẩu</label>
                    <div id="div_repassword" class="input">
                        <input type="password" name="txt_repassword" id="txt_repassword" style="outline: none;" onblur="ValidateRepassword();" maxlength="20">
                    </div>
                    <i id="i_repassword" class="fa fa-times" aria-hidden="true" style="display: none;"></i>
                </div>
                <div id="error_repassword"></div>
            <div class="row1">
                    <label class="label">Họ & Tên</label>
                    <div id="div_name" class="input">
                        <input type="text" name="txt_name" id="txt_name" style="outline: none;" onblur="ValidateName();">
                    </div>
                    <i id="i_name" class="fa fa-times" aria-hidden="true" style="display: none;"></i>
                </div>
                <div id="error_name" style="font-size: 12px;"></div>
            <div class="row1">
                    <label class="label">Ngày sinh</label>
                    <div id="div_birthday" class="input">
                        <input type="date" name="txt_birthday" id="txt_birthday" style="outline: none;" onblur="ValidateBirthday();">
                    </div>
                    <i id="i_birthday" class="fa fa-times" aria-hidden="true" style="display: none;"></i>
                </div>
                <div id="error_birthday"></div>
            <div class="row1">
                <label class="label">Giới tính</label>
                    <div id="div_gender" class="input">
                    <select name="txt_gender" id="txt_gender" style="outline: none;" onblur="ValidateGender();">
                        <option value="" selected disabled>Chọn giới tính</option>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                </select>
            </div>    <i id="i_gender" class=" fa fa-times " aria-hidden="true" style="display: none;"></i>
                </div> 
                    <div id="error_gender"></div>
                <!-- Modify the input for phone number to use type="tel" -->
        <div class="row1">
            <label class="label">Số điện thoại</label>
            <div id="div_phone" class="input">
                <input type="tel" name="txt_phone" id="txt_phone" style="outline: none;"maxlength="10" oninput="validatePhoneNumber();" >
            </div>
            <i id="i_phone" class="fa fa-times " aria-hidden="true" style="display: none;"></i>
        </div>
        <div id="error_phone" class="error-message"></div>
                <div id="error_phone"></div>
                <div class="row1">
                    <label class="label">Email</label>
                    <div id="div_email" class="input">
                        <input type="text" name="txt_email" id="txt_email" style="outline: none;" onblur="ValidateEmail();">  
                    </div>
                    <i id="i_email" class=" fa fa-times" aria-hidden="true" style="display: none;"></i>
                </div>
                <div id="error_email" style="font-size: 12px;"></div>
                <div class="row1">
                    <label class="label">Địa chỉ</label>
                    <div id="div_address" class="input">
                        <input type="text" name="txt_address" id="txt_address" style="outline: none;" onblur="ValidateAddress();">
                    </div>
                    <i id="i_address" class="fa fa-times" aria-hidden="true" style="display: none;"></i>
                </div>
                <div id="error_address"></div>
                <div class="row1">
                    <div><input type="checkbox" id="check" name="check">Tôi đồng ý với các điều khoản</div>
                    <div id="error_check" class="error-message"></div>
                    <label >avatar</label>
                    <div style="margin-top: 20px; margin-left:20px">
                        <div id="div_avatar" class="input">
                            <input type="file" name="picture" id="picture" style="outline: none;">
                            <i id="i_avatar" class="fa fa-times" aria-hidden="true" style="display: none;"></i>
                        </div>
                        <div id="error_avatar" class="error-message"></div>
                    </div>
                </div>

                <div class="row1">
                    <div id="button">
                        <input type="reset" value="Reset form" onclick="confirmReset();">
                        <button type="button" onclick="submitForm();">Đăng ký</button>
                    </div>
            </div>
                </div>
            <div class="right-signup">
                <br><hr>
                

        </div>     
    </div>
</body>
<script>
    function submitForm() {
    event.preventDefault(); 
    Validate();
    ValidateAddress();
    ValidateUsername();
    ValidatePassword();
    ValidateEmail();
    ValidateRepassword();
    ValidateBirthday();
    ValidateGender();
    ValidateName();
    validatePhoneNumber();
    // Nếu tất cả kiểm tra thành công, submit form
    if (document.querySelectorAll('.border-error').length === 0) {
        document.getElementById('signupForm').submit();
    }
}
function confirmReset() {
    // Hiển thị hộp thoại xác nhận
    var isConfirmed = confirm("Bạn có chắc muốn xóa tất cả dữ liệu đã nhập?");

    // Nếu người dùng chọn OK (đồng ý), thực hiện reset form
    if (isConfirmed) {
        // Đặt lại giá trị của tất cả các trường input trong form
        document.getElementById('signupForm').reset();

        // Tải lại trang
        window.location.reload();
    }
}
function Validate(){
	 //check box
	input= document.getElementById("check").checked;
	error=document.getElementById("error_check");
   if (!input) {
	error.innerHTML="Please check on checked above";
	 } else {
	  error.innerHTML="";
	 }
  }
  function Add_Class_Error(input, i, error, text) {
    input.classList.remove("border-success");
    input.classList.add("border-error");
    i.classList.remove("color-success");
    i.classList.remove("fa-check");
    i.classList.add("color-error");
    i.classList.add("fa-times");
    error.innerHTML = text;
    i.style.display = 'inline';

}

function Add_Class_Success(input, i, error) {
    input.classList.remove("border-error");
    input.classList.add("border-success");
    i.classList.remove("color-error");
    i.classList.remove("fa-times");
    i.classList.add("color-success");
    i.classList.add("fa-check");
    error.innerHTML = "";
    i.style.display = 'inline';
}
function ValidateAddress(){
      input=document.getElementById("txt_address");
	 i=document.getElementById("i_address");
	 error=document.getElementById("error_address");

    if (!input.value) {
        Add_Class_Error(input,i,error, "Địa chỉ không được bỏ trống.");	
      } else {
        Add_Class_Success(input,i,error);
      }
    }
    function ValidateUsername() {
    let input = document.getElementById("txt_username");
    let i = document.getElementById("i_username");
    let error = document.getElementById("error_username");

    const usernameValue = input.value;
    // Check if the username meets the criteria
    if (usernameValue.length < 6 || !/[a-zA-Z]/.test(usernameValue)) {
        Add_Class_Error(input, i, error, "Tên đăng nhập phải có ít nhất 6 ký tự và chứa ít nhất 1 chữ cái.");
    } else {
        Add_Class_Success(input, i, error);
    }
}

    function ValidatePassword1(password) {
    const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
	return passwordRegex.test(password);
}
function ValidatePassword() {
    let input = document.getElementById("txt_password");
    let i = document.getElementById("i_password");
    let error = document.getElementById("error_password");

    if (!input.value ) {
        Add_Class_Error(input, i, error, "Vui lòng nhập chính xác mật khẩu!.");
    } else if(!ValidatePassword1(input.value))
    {
        Add_Class_Error(input, i, error, "Mật khẩu phải bao gồm chữ cái đầu viết hoa bao gồm 1 ký tự đặc biệt(@$!%*?&).");
    }
    else {
        Add_Class_Success(input, i, error);
    }
}
    function ValidateEmail1(mail) {
	if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
		return true;
	return false;
}
    function ValidateEmail(){
        let input=document.getElementById("txt_email");
	
	let i=document.getElementById("i_email");
	let error=document.getElementById("error_email");
	if(!input.value|| !ValidateEmail1(input.value)){
		Add_Class_Error(input,i,error,"Vui lòng nhập vào email!");
	}
	else{
		Add_Class_Success(input,i,error);
	}
    }
    function validatePhoneNumber() {
    let input = document.getElementById("txt_phone");
    let i = document.getElementById("i_phone");
    let error = document.getElementById("error_phone");

    // Remove non-numeric characters from the input
    let cleanedInput = input.value.replace(/\D/g, '');

    // Check if the cleaned input is a valid phone number with exactly 10 digits
    const phoneRegex = /^(0[0-9]{9})$/;

    if (!cleanedInput || !phoneRegex.test(cleanedInput)) {
        Add_Class_Error(input, i, error, "Số điện thoại không hợp lệ.");
    } else {
        // Update the input value with the cleaned version
        input.value = cleanedInput;
        Add_Class_Success(input, i, error);
    }
}
        function ValidateRepassword(){
        input = document.getElementById("txt_repassword");
        i = document.getElementById("i_repassword");
        error = document.getElementById("error_repassword");

        if (!input.value) {
            Add_Class_Error(input, i, error, "Xác nhận mật khẩu không được bỏ trống.");
        } else if (input.value !== document.getElementById("txt_password").value) {
            Add_Class_Error(input, i, error, "Xác nhận mật khẩu không khớp với mật khẩu ban đầu.");
        } else {
            Add_Class_Success(input, i, error);
        }
    }
   function ValidateBirthday()
   {input = document.getElementById("txt_birthday");
    i = document.getElementById("i_birthday");
    error = document.getElementById("error_birthday");

    if (!input.value) {
        Add_Class_Error(input, i, error, "Vui lòng chọn ngày sinh.");
    } else {
        let NgayHienTai = new Date();
        let NgayDuocChon = new Date(input.value);
        if (NgayHienTai.getFullYear() - NgayDuocChon.getFullYear() < 14) {
            Add_Class_Error(input, i, error, "Bạn phải từ 14 tuổi trở lên.");
        } else {
            Add_Class_Success(input, i, error);
        }
    }
}
    function ValidateGender(){
    select = document.getElementById("txt_gender");
    i = document.getElementById("i_gender");
    error = document.getElementById("error_gender");

    if (!select.value) {
        Add_Class_Error(select, i, error, "Vui lòng chọn giới tính.");
    } else {
        Add_Class_Success(select, i, error);
    }
}
    function ValidateName() {
    input = document.getElementById("txt_name");
    i = document.getElementById("i_name");
    error = document.getElementById("error_name");

    if (!input.value) {
        Add_Class_Error(input, i, error, "Tên không được bỏ trống.");
    } else {
        Add_Class_Success(input,i,error);
    }
}
function AnHien()
{
    let nutDangNhap = document.getElementById('bt_AnHien');
    let matkhau=document.getElementById('txt_password');
    if(nutDangNhap.value=="Hiện")
    {
        matkhau.type = "text";
        nutDangNhap.value ="Ẩn";
    }
    else{
        matkhau.type = "password";
        nutDangNhap.value ="Hiện";}
}
</script>
    </body>
</html>
