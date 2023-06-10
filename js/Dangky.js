const btn_Dang_Ky = document.querySelector('.btn-submit');

btn_Dang_Ky.addEventListener('mousedown', function(){
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const diachi = document.getElementById('diachi').value;
    const thanhpho = document.getElementById('city').value;
    const sdt = document.getElementById('sdt').value;
    

    document.querySelector('#error-username').innerHTML = checkUsername(username);
    document.querySelector('#error-email').innerHTML = checkEmail(email);
    document.querySelector('#error-password').innerHTML = checkPassword(password);
    document.querySelector('#error-sdt').innerHTML =  checkSdt(sdt);
});


function checkUsername(username){
    if(username == '')
        return 'Vui lòng nhập tên !';
    return '';
}


function checkEmail(email){
    if (email == "") 
            return "Vui lòng nhập tên email !";
    else if (!((email.indexOf(".") > 0) &&
                (email.indexOf("@") > 0)) ||
                /[^a-zA-Z0-9.@_-]/.test(email))
        return "Email không hợp lệ.";
    return "";
    }

function checkPassword(password){
    if (password == "") 
            return "Vui lòng nhập tên password !";
    else if (password.length < 6)
        return "Passwords phải chứa ít nhất 6 kí tự.";
    else if (!/[a-z]/.test(password) 
                || ! /[A-Z]/.test(password) 
                || !/[0-9]/.test(password))
        return "Passwords bắt buộc phải có các kí tự thường, hoa và các số 0-9.";
    return "";
}

function checkSdt(sdt){
    if(sdt.length < 11 || sdt.lenth > 11){
        return 'Số điện thoại chứa tối thiểu 10 số !';
    }
    else {
        if(sdt.split('')[0] != '0')
            return 'Số điện thoại bắt đầu bằng số 0 !';
    }
    return '';
}
