function previewImagem() {
    var imagem = document.querySelector('input[name=imagem_nova').files[0];
    var preview = document.querySelector('#preview-user');

    var reader = new FileReader();
    reader.onloadend = function() {
        preview.src = reader.result;
    };
    if (imagem) {
        reader.readAsDataURL(imagem);
    } else {
        preview.src = "";
    }
}

var cont = 1;

$('#add-campo').click(function() {
    cont++;

    $('#tels').append('<div class="form-row"><div class="col-md-4" id="campo' + cont + '"><label><span class="text-danger">*</span> Telefone</label><div class="input-group"><input type="text" formato="tel" name="telefone[]" placeholder="(00) 00000-0000" class="form-control"><div class="input-group-append"> <button type="button" id="' + cont + '" class="btn-apagar btn btn-danger"><i class="fa fa-minus"></i></button></div></div></div>');
});

$('form').on('click', '.btn-apagar', function() {
    var button_id = $(this).attr("id");
    $('#campo' + button_id + '').remove();
});
$('[formato=cpf]').mask('999.999.999-99');
$('[formato=tel]').mask('(99)9 9999-9999');

