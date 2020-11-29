function deleteRecord(itemName,url,id){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this "+  itemName+ "!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        })
        .then((willDelete) => {
        if (willDelete) {
            axios.delete(url+"/"+id, {
                id: id,
                _token:'{{ csrf_token() }}'
            })
            .then(function (response) {
                if(response.data.code == "200"){
                    swal(response.data.message, {
                        icon: "success",
                    });
                    $("#"+itemName+id).remove()
                }
            })
            .catch(function (error) {
                console.log(error);
                swal("Error ocurred",{icon: "error"})
            });
          
        } else {
            swal("Your "+  itemName+ " is safe!");
        }
    });
}