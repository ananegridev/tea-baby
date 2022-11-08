function msg(){
    var msg=document.querySelector('.msg');
    if(msg){
        setTimeout(
            function alteraStyle(){
                msg.style.opacity=0;


            }, 3000
        );


    }
}

function mais(){

    var contador=document.querySelector('.lanchescont').value;

    var id=document.querySelector('.id').value;
for(var i=1;i<=contador;i++){




    var atual = document.querySelector(".total"+i).value;
    var novo = atual - (-1); //Evitando Concatenacoes
    document.querySelector(".total"+i).value = novo;
    var preco=document.querySelector(".valor"+i);
    var quantidade=document.querySelector(".total"+i).value;
    var mostrar=document.querySelector(".totalCompra"+i);
    var total=parseFloat(preco.innerHTML)*quantidade;
    mostrar.innerHTML="Total R$ "+total.toFixed(2);
}

  }

  function menos(){
    var contador=document.querySelector('.lanchescont').value;

    var id=document.querySelector(".id").value;
    for(var i=1;i<=contador;i++){


    var atual = document.querySelector(".total"+i).value;
    if(atual > 0) { //evita números negativos
      var novo = atual - 1;
      document.querySelector(".total"+i).value = novo;
      var preco=document.querySelector(".valor"+i);
      var quantidade=document.querySelector(".total"+i).value;
      var mostrar=document.querySelector(".totalCompra"+i);
      var total=parseFloat(preco.innerHTML)*quantidade;
      mostrar.innerHTML="Total R$ "+total.toFixed(2);
    }
}

  }

