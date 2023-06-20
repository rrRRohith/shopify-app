const toastSuccess = function(message){
    Swal.fire({
        toast: true,
        icon: 'success',
        title: message,
        animation: false,
        position: 'bottom',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: false,
    });
}
const toastError = function(message){
    Swal.fire({
        toast: true,
        icon: 'error',
        title: message,
        animation: false,
        position: 'bottom',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: false,
    });
}
const toastWarning = function(message){
    Swal.fire({
        toast: true,
        icon: 'warning',
        title: message,
        animation: false,
        position: 'bottom',
        showConfirmButton: false,
        timer: 6000,
        timerProgressBar: false,
    });
}