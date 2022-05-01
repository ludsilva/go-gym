//CPF alerts
const cpfAlerts = (error) => {
  let divMessage = document.getElementById('cpfMessage');
  let message = ``;

  if(error === 1){
    message = 'CPF inválido!';
  } else {
    message = 'CPF Inválido! É esperado 11 dígitos numéricos.'
  }

  let content = `
    <div class="alert alert-danger d-flex align-items-center" role="alert">
      <div>
      <strong>Erro: </strong>${message}
      </div>
    </div>
  ` 
  divMessage.innerHTML = content;

  setTimeout(() => {
    divMessage.innerHTML = '';
    location.reload();
  }, 5000);
}

//Date alert
const dateAlert = (error) => {
  let dateAlert = document.getElementById('dateAlert');
  let message = ``;

  if (error === 1){
    message = 'A data de nascimento é maior que 100 anos.'
  } 
  if (error === 2){
    message = 'A data informada é menor que a data atual.'
  }

  let content = `
    <div class="alert alert-danger d-flex align-items-center py-3" role="alert">
      <div>
      <strong>Erro: </strong>${message}
      </div>
    </div>
  ` 
  dateAlert.innerHTML = content;

  setTimeout(() => {
    dateAlert.innerHTML = '';
    location.reload();
  }, 5000);
}