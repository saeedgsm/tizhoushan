import toastr from 'toastr';
import 'toastr/build/toastr.min.css';
toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
};
class Notification {
    static success(msg){
        return toastr.success(msg);
    }

    static error(msg){
        return toastr.error(msg);
    }
}

export default Notification;
