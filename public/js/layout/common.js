
//ローディング表示
function show_loading()
{
    $("#modal-loading").modal('show');
}

//ローディング非表示
function hide_loading()
{
    $("#modal-loading").modal('hide');
}

//エラー表示
function show_error(html)
{
    $('.alert-wrapper').html(html);
    $('.alert-wrapper').show();
}

//エラー非表示
function hide_error()
{
    $('.alert-wrapper').hide();
}