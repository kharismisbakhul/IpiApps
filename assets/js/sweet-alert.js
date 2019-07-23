$('.logout').on('click', function () {
    Swal.fire({
        title: 'Are you sure?',
        text: "",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Logout'
    }).then(function (result) {
        if (result.value) {
            window.location = window.location.origin + "/IpiApps/auth/logout";
        }
    })
});