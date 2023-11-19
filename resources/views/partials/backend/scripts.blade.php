<!-- build:js assets/vendor/js/core.js -->
<script src="{{asset('backend/assets')}}/vendor/libs/jquery/jquery.js"></script>
<script src="{{asset('backend/assets')}}/vendor/libs/popper/popper.js"></script>
<script src="{{asset('backend/assets')}}/vendor/js/bootstrap.js"></script>
<script src="{{asset('backend/assets')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="{{asset('backend/assets')}}/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{asset('backend/assets')}}/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="{{asset('backend/assets')}}/js/main.js"></script>
<!-- Main JS -->
<script src="{{asset('backend/assets')}}/js/custom.js"></script>

<!-- Page JS -->
<script src="{{asset('backend/assets')}}/js/dashboards-analytics.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;
    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;
    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;
    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break;
 }
 @endif
</script>
