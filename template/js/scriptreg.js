let subform = document.getElementById("form-sub");
let Name = document.getElementById("Name");
let login = document.getElementById("login");

let inputs = document.querySelectorAll(".in");

let errorMessage = document.getElementById('error-message');

document.getElementById("forma").addEventListener('submit', function(event) {
    event.preventDefault();
    
    errorMessage.textContent = "Произошла ошибка!";

    let formData = new FormData(this);

    const truename = Name.value.trim();
    const truemail = Email.value.trim();
    const regExpName = /^[а-яА-Я\s]*\s[а-яА-Я\s]*\s[а-яА-Я\s]*$/;
    const regExp1Mail = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)*(\.[a-zA-Z]{2,})$/;
    const regExpPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

    let truef = 0;

    for(let i = 0; i < inputs.length; i++){
        if(i == 0){
            if(regExpName.test(truename)){
                inputs[i].classList.remove('border-danger');
                truef++;
            }
            else{
                showErrorMessage();
                inputs[i].classList.add('border-danger');
                truef--;
                errorMessage.textContent += " Имя должно быть записано полностью и через пробелы.";
            }
        }
        if(i == 1){
            if (inputs[i].value == ""){
                showErrorMessage();
                inputs[i].classList.add('border-danger');
                truef--;
                errorMessage.textContent += " Поле Логин не должно быть пустым.";
            } 
            else{
                inputs[i].classList.remove('border-danger');
                truef++;
            }
        }
        if(i == 2){
            if(regExp1Mail.test(inputs[i].value.trim())){
                inputs[i].classList.remove('border-danger');
                truef++;
            }
            else{
                showErrorMessage();
                inputs[i].classList.add('border-danger');
                truef--;
                errorMessage.textContent += " Почта должна быть рабочего вида.";
            }
        }
        if(i == 3){
            if(regExpPassword.test(inputs[i].value.trim())){
                inputs[i].classList.remove('border-danger');
                truef++;
            }
            else{
                showErrorMessage();
                inputs[i].classList.add('border-danger');
                truef--;
                errorMessage.textContent += " Пароль должен быть минимум 8 символов, англ языка и с минимум одной зашлавной буквой и цифрой.";
            }
        }
        if(i == 4){
            if(inputs[i].value == inputs[i - 1].value && regExpPassword.test(inputs[i].value.trim())){
                inputs[i].classList.remove('border-danger');
                truef++;
            }
            else{
                showErrorMessage();
                inputs[i].classList.add('border-danger');
                truef--;
                errorMessage.textContent += " Пароль и Повтор пароля не совпадают.";
            }
        }if(i == 5){
            if(inputs[i].checked){
                truef++;
            }
            else{
                showErrorMessage();
                truef--;
                errorMessage.textContent += " Нажмите на галочку напротив Согласия на обработку персональных данных.";
            }
        }
    }
    
    if(truef == 6){
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "register.php", true);
        xhr.onreadystatechange = function() {
    if (xhr.readyState == 4 && xhr.status == 200) {
        window.location.href = 'succes.php?login=' + login.value; 
    }
  };
  xhr.send(formData);
    }
});


function showErrorMessage() {
    errorMessage.classList.remove('d-none');
}