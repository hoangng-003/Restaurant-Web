const username = document.getElementById("username-input");
const email = document.getElementById("email-input");
const firstName = document.getElementById("first-name-input");
const lastName = document.getElementById("last-name-input");
const phone = document.getElementById("tel-input");
const password = document.getElementById("password1-input");
const cpassword = document.getElementById("password2-input");
const address = document.getElementById("add-input");

const inputEles = document.getElementsByClassName("form-control");

function setSuccess(ele) {
    ele.classList.add("success");
    clearError(ele);
}
function setError(ele, message) {
    let parentEle = ele.parentNode;
    parentEle.classList.add('error');
    parentEle.querySelector('small').innerText = message;
}
function clearError(ele) {
    let parentEle = ele.parentNode;
    parentEle.classList.remove('error');
}
function isValidate() {
    let isCheck = true;

    //fill
    if (username.value == '') {
        setError(username, 'This field is required!');
        isCheck = false;
    } else {
        setSuccess(username);
    }

    if (email.value == '') {
        setError(email, 'This field is required!');
        isCheck = false;
    } else {
        if (!isEmail(email.value)) {
            setError(email, "Invalid email address please type a valid email!");
            isCheck = false;
        } else {
            setSuccess(email);
        }
    }

    if (firstName.value == '') {
        setError(firstName, 'This field is required!');
        isCheck = false;
    } else {
        if (!isName(firstName.value)){
            setError(firstName, 'This field is required!');
            isCheck = false;
        }else{
            setSuccess(firstName);
        }
    }

    if (lastName.value == '') {
        setError(lastName, 'This field is required!');
        isCheck = false;
    } else {
        if (!isName(lastName.value)){
            setError(lastName, 'Invalid!');
            isCheck = false;
        }else{
            setSuccess(lastName);
        }
    }

    if (phone.value == '') {
        setError(phone, 'This field is required!');
        isCheck = false;
    } else {
        if (!isPhone(phone.value)) {
            setError(phone, "Invalid phone number!");
            isCheck = false;
        } else {
            setSuccess(phone);
        }
    }

    if (password.value == '') {
        setError(password, 'This field is required!');
        isCheck = false;
    } else {
        if (password.value.toString().length < 6){
            setError(password, 'Password Must be >=6');
            isCheck = false;
        }else{
            setSuccess(password);
        }
    }

    if (cpassword.value == '') {
        setError(cpassword, 'This field is required!');
        isCheck = false;
    } else {
        if (cpassword.value!=password.value){
            setError(cpassword, 'Password not match');
            isCheck = false;
        }else{
            setSuccess(cpassword);
        }
    }

    if (address.value == '') {
        setError(address, 'This field is required!');
        isCheck = false;
    } else {
        setSuccess(address);
        clearError(address);
    }

    return isCheck;
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(
        email
    );
}

function isPhone(number) {
    const regexPhoneNumber = /(84|0[3|5|7|8|9])+([0-9]{8})\b/g;
    return number.match(regexPhoneNumber);
}

function removeAscent (str) {
    if (str === null || str === undefined) return str;
    str = str.toLowerCase();
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
    str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
    str = str.replace(/đ/g, "d");
    return str;
}

function isName (string) {
    var re = /^[a-zA-Z ]+$/g // regex here
    return re.test(removeAscent(string));
}
