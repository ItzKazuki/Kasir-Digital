@if (Session::has('sweetalert.alert'))
    let config = {!! Session::pull('sweetalert.alert') !!};
    Swal.fire(config);
@endif
