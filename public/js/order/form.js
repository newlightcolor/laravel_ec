$(document).ready(function()
{

    //フォーム入力 イベント処理
    form_events();
    function form_events()
    {

        //注文登録
        $("#btn-order").on("click", function(){

            show_loading();
            hide_error();

            let formData = new FormData($('#form-order').get(0));

            $.ajax(
                {
                    url: '/order',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                }
            )
            .done(function(data) {
                console.log(data);
                if(data.result === 'error'){
                    show_error(data.html);
                }
                if(data.result === 'success'){
                    location.href = '/'
                }
                hide_loading();
            });
        });

        //都道府県変更
        $("#prefecture").on("change", function(){
            reload_order_form();
        });
    }

    //フォームリロード
    function reload_order_form()
    {
        show_loading();

        $.ajax('order/create',
            {
                type: 'GET',
                data: $('#form-order').serialize() ,
                dataType: 'json'
            }
        )
        .done(function(data) {
            $("#form-order").replaceWith(data.html);
            form_events();
        })
        .always(function() {
            hide_loading();
        });
    }
})