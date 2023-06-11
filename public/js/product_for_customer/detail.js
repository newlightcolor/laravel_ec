$(document).ready(function()
{
    //日記詳細
    $('.show-diary-detail').off('click');
    $('.show-diary-detail').on('click', function(){

        let url = '{{url("/")}}/diary/detail/'+$(this).data('id');

        $.ajax({
            type: "GET",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        }).done(function( data ) {
            $('#modal-diary-detail').remove();
            $('body').append(data.modal);
        });
    });

    //日記追加
    $('.add-diary').off('click');
    $('.add-diary').on('click', function(){
        location.href = "diary/create"
    });

    //日記削除
    $('.delete-diary').off('click');
    $('.delete-diary').on('click', function(){

        let url = '{{url("/")}}/diary/'+$(this).data('id');

        $.ajax({
            type: "DELETE",
            url: url,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).done(function( data ) {
            select_page = $("#select_page").val();
            location.href = '{{url("/")}}?&select_page='+select_page;
        });
    });

    //日記編集
    $('.edit-diary').off('click');
    $('.edit-diary').on('click', function(){
        let url = '{{url("/")}}/diary/edit?id='+$(this).data('id');
        location.href = url;
    });

    //日記追加カードの表示切り替え
    toggle_add_diary_card();
    function toggle_add_diary_card(){
        if($('.card-content').length <= 0){
            $('.card-add-diary').show();
        }else{
            $('.card-add-diary').hide();
        }
    }
})