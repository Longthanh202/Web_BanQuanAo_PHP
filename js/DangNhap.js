const btn_Dang_Nhap = document.querySelector('.btn-dangnhap');

btn_Dang_Nhap.addEventListener('mousedown', function(){
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    

    document.querySelector('#error-username').innerHTML = checkUsername(username);
    document.querySelector('#error-password').innerHTML = checkPassword(password);
});


function checkUsername(username){
    if(username == '')
        return 'Vui lòng nhập tên !';
    return '';
}
function checkPassword(password){
    if(password == '')
    return 'Vui lòng nhập password !';
return '';
}
