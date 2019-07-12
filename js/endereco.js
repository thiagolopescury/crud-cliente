$(function () {
    function criarCamposEnderecos(id) {
        return '<div id="form-group-id-' + id + '"><div class="row"> <div class="col col-lg-12"> <div class="form-group"> <label for="enderecoNome">Nome</label> <input type="text" class="form-control" id="enderecoNome" name="enderecoNome[]"> </div></div></div><div class="row"> <div class="col col-lg-4"> <div class="form-group"> <label for="enderecoLogradouro">Logradouro</label> <input type="text" class="form-control" id="enderecoLogradouro" name="enderecoLogradouro[]"> </div></div><div class="col col-lg-4"> <div class="form-group"> <label for="enderecoNumero">Número</label> <input type="text" class="form-control" id="enderecoNumero" name="enderecoNumero[]"> </div></div><div class="col col-lg-4"> <div class="form-group"> <label for="enderecoCEP">CEP</label> <input type="text" class="form-control" id="enderecoCEP" name="enderecoCEP[]"> </div></div></div><div class="row"> <div class="col col-lg-4"> <div class="form-group"> <label for="enderecoBairro">Bairro</label> <input type="text" class="form-control" id="enderecoBairro" name="enderecoBairro[]"> </div></div><div class="col col-lg-4"> <div class="form-group"> <label for="enderecoCidade">Cidade</label> <input type="text" class="form-control" id="enderecoCidade" name="enderecoCidade[]"> </div></div><div class="col col-lg-4"> <div class="form-group"> <label for="enderecoUF">UF</label> <input type="text" class="form-control" id="enderecoUF" name="enderecoUF[]"> </div></div></div><button class="btn btn-danger removeField" type="button" data-form-group-id="' + id + '">Remover</button><hr /></div></div>';
    };

    function gerarNumeroAleatorio() {
        return Math.floor(Math.random() * 100000) + 1;
    };


    var wrapper = $('.enderecos');
    var btnAddFields = $('#btnAddCampos');

    $(btnAddFields).click(function (e) {
        e.preventDefault();

        $(wrapper).append(criarCamposEnderecos(gerarNumeroAleatorio()));
    });

    $(document).on("click", ".removeField", function (e) {
        e.preventDefault();
        $('#form-group-id-' + $(this).data('form-group-id')).remove();
        $(btnAddFields).removeClass('disabled');
    });
});