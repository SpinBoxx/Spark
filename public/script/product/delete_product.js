$('#delete-product').click(function(){
    var url = $(this).attr("data-url")
    var thiss = $(this);
    $.ajax({
        url : url,
        method : 'GET',
        success: function (){
            $(thiss).parents('td').parents('tr').remove()
            toastr.success('Annonce supprimé')
        },
        error: function (){
            toastr.error('Impossible de supprimer l\'annonce.')
        },
    })
})