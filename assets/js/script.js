const checkResponse = (dados) => {
  let mensagem = '';

  if(dados === 'Foi!'){
    mensagem = "Usuário cadastrado com sucesso";
  } else if (dados === 'Erro!'){
    mensagem = "Não foi possível cadastrar o usuário, tente novamente";
  }
  window.alert(mensagem);
  window.location.reload();
}


//Formulario
const formulario = document.getElementById('formulario');

  formulario.addEventListener('submit', function(e){
    e.preventDefault();
    
    const url = 'src/crud/create.php';
    let dados = new FormData(formulario);

    fetch(url,{
      method: 'POST',
      body: dados
    }).then(response => response.json())
      .then(dados => {
        checkResponse(dados);
    });
})