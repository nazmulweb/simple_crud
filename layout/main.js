$(document).on("click", '.delete-obj', function(){
    var id = $(this).attr('delete-id')
    bootbox.confirm({
        message: "<h4> Are you sure?",
        buttons:{
            confirm:{
                label: "Yes",
                className : "btn-danger"
            },
            cancel: {
                label: "No",
                className: "btn-primary"
            }
        },
        callback: function (result) {
            if(result==true){
                $.post('delete_product.php', {
                    object_id: id
                }, function(data){
                    location.reload();
                }).fail(function() {
                    alert('Unable to delete.');
                });
            }
        }
    })
    return false
})