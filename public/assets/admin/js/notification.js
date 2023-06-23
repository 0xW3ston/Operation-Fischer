toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick":() => {window.location.href = "/admin/commandes"},
    "showDuration": "300",
    "hideDuration": "2000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut",
}

const notificationEndpoint = new EventSource('http://localhost:8080/sse-endpoint',{withCredentials:true});

notificationEndpoint.onmessage = (res) => {
    showNotification(
        JSON.parse(res.data).data
    );
};

function showNotification(message){
    toastr["success"](message, "New Commande");
}

