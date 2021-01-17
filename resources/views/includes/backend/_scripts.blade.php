<!-- Bootstrap core JavaScript-->
<script src="/backend/vendor/jquery/jquery.min.js"></script>
<script src="/backend/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/backend/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/backend/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="/backend/vendor/chart.js/Chart.min.js"></script>

 <!--datatbles-->
 <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>

<!-- Page level custom scripts -->
<script src="/backend/js/demo/chart-area-demo.js"></script>
<script src="/backend/js/demo/chart-pie-demo.js"></script>

 {{-- ck editor --}}
 <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
 <script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
        } );
</script>