/*Validar inputs */

// Nome e sobrenome
const checkChar = (e) => {
  let char = String.fromCharCode(e.keyCode);
  let pattern = /^[A-zÀ-ú ´]+$/;

  if(char.match(pattern)){
    return true;
  }
}

const checkName = document.querySelector('#nome').addEventListener('keypress', function(e){
  if(!checkChar(e)){
    e.preventDefault();
  }
})

const checkLastName = document.querySelector('#sobrenome').addEventListener('keypress', function(e){
  if(!checkChar(e)){
    e.preventDefault();
  }
})

//CPF
function checkCPF() {
  let cpf = document.getElementById('cpf').value;
  let validarCPF = cpf.replace( /\D/g , "");

   if (validarCPF.length == 11){
    let soma = 0;
    let resto;

    if (validarCPF.length !== 11 || !!validarCPF.match(/(\d)\1{10}/)){
      cpfAlerts(1);
      return false;
    }

    for (let i = 1; i <= 9; i++){
      soma = soma + parseInt(validarCPF.substring(i-1, i)) * (11 - i);
    } 
    resto = (soma * 10) % 11;
     
     if ((resto == 10) || (resto == 11))  resto = 0;
     if (resto != parseInt(validarCPF.substring(9, 10))){
      cpfAlerts(1);
      return false;
     } 

     soma = 0;
     for (let i = 1; i <= 10; i++){
      soma = soma + parseInt(validarCPF.substring(i-1, i)) * (12 - i);
     } 
     resto = (soma * 10) % 11;

     if ((resto == 10) || (resto == 11)) {resto = 0;}
     if (resto != parseInt(validarCPF.substring(10, 11))){
      cpfAlerts(1);
      return false;
     } 

    return true;

  } else if (validarCPF.length < 11 || validarCPF.length > 11) {
    cpfAlerts(2);
    return false;
  } 
}

const valorCPF = document.querySelector("#cpf");  
valorCPF.addEventListener("keydown", function(e) {
   if (e.key >= 'a' && e.key <= 'z') {
     e.preventDefault();
   }
});

valorCPF.addEventListener("blur", checkCPF);

//Data de Nascimento
const validarDataNascimento = () => {
  let dataForm = document.getElementById('dataDeNascimento').value;
  let dataSplit = dataForm.split("-").map(Number);
  let dataHoje = new Date();
  let dataAte100 = new Date(dataSplit[0] + 100, dataSplit[1] - 1, dataSplit[2]);
  let dataNascimento = new Date(dataForm);

  if (dataAte100 < dataHoje){
    dateAlert(1);
    return false;
  } else if (dataHoje < dataNascimento){
    dateAlert(2);
    return false;
  } else {
    return true;
  }
}
document.querySelector('#dataDeNascimento').addEventListener('focusout', validarDataNascimento);
