<!-- jQuery 3 -->
<script src="{{asset('LTE/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('LTE/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Select2 -->
<script src="{{asset('LTE/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('LTE/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('LTE/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('LTE/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>


<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('LTE/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
{{--<!-- Morris.js charts -->
<script src="{{asset('LTE/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{asset('LTE/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('LTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('LTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('LTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>


<!-- jQuery Knob Chart -->
<script src="{{asset('LTE/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('LTE/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('LTE/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
--}}
<!-- datepicker -->
<script src="{{asset('LTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
{{--<script src="{{asset('LTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>--}}
<!-- Slimscroll -->
<script src="{{asset('LTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('LTE/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('LTE/dist/js/adminlte.min.js')}}"></script>
<!-- DataTables -->
{{--<script src="{{asset('LTE/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('LTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>--}}

<script type="text/javascript" src="{{asset('LTE/DataTables/datatables.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('LTE/dist/js/demo.js')}}"></script>
{{-- <script src="{{asset('js/script.js')}}"></script> --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(Route::is('projets.projet.show'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7"></script>
@endif



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>



<!-- Scripts For code generator -->

{{--<script src="https://code.jquery.com/jquery-1.12.4.min.js"
        integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
        crossorigin="anonymous"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js"></script>

{{-- <script src="{{ asset('js/app.js') }}"></script> --}}
<script type="text/javascript">
    $(function(){

        // sends the uploaded file file to the fielselect event
        $(document).on('change', ':file', function() {
            var input = $(this);
            var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

            input.trigger('fileselect', [label]);
        });

        // Set the label of the uploaded file
        $(':file').on('fileselect', function(event, label) {
            $(this).closest('.uploaded-file-group').find('.uploaded-file-name').val(label);
        });

        // Deals with the upload file in edit mode
        $('.custom-delete-file:checkbox').change(function(e){
            var self = $(this);
            var container = self.closest('.input-width-input');
            var display = container.find('.custom-delete-file-name');

            if (self.is(':checked')) {
                display.wrapInner('<del></del>');
            } else {
                var del = display.find('del').first();
                if (del.is('del')) {
                    del.contents().unwrap();
                }
            }
        }).change();

        // Sets the validator defaults
        $.validator.setDefaults({
            errorElement: "span",
            errorClass: "help-block",
            highlight: function (element, errorClass, validClass) {
                $(element).closest('.form-group').addClass('has-error');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).closest('.form-group').removeClass('has-error');
            },
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if(element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                    error.appendTo(element.closest(':not(input, label, .checkbox, .radio)').first());
                } else {
                    error.insertAfter(element);
                }
            }
        });

        // Makes sure any input with the required class is actually required
        $('form').each(function(index, item){
            var form = $(item);
            form.validate();

            form.find(':input.required').each(function(i, input){
                $(input).attr('required', true);
            });
        });

    });


</script>

<script>

    $( function() {
        /* Activate jquery ui date picker */
        $(".datetime-picker").datepicker({
            format: 'yyyy-mm-dd'
        });

        /* Afficher le menu du dropdown sans toucher visiblement le div container */
        flowDropdown()
    } );

    /**
     * Permet au menu du dropdown de souvrir en haut du div avec
     * pour classe .table-responsive
     */
    function flowDropdown() {

        $('.dropdown').on('show.bs.dropdown', function() {
            $('.table-responsive').css('overflow-x', 'visible');
        });

        $('.dropdown').on('hidden.bs.dropdown', function() {
            $('.table-responsive').css('overflow-x', 'auto');
        });
    }

    /**
    *       Masque de date
    */
    function dateMask(id) {
        /* var el = document.getElementById(id);
        var date = el.value;
        if (date.match(/^\d{4}$/) !== null) {
            el.value = date + '-';
        } else if (date.match(/^\d{4}\-\d{2}$/) !== null) {
            el.value = date + '-';
        } */
    }

    $(document).ready(function(){
        $('.datetime-picker').mask('0000-00-00');
    });
</script>


