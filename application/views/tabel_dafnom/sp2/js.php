<script>
            //Select2
            $(document).ready(function () {
                $(".select2").select2({
                    placeholder: "Pilih Case / Wajib Pajak"
                });
                $(".select2-pemeriksa").select2({
                    placeholder: "Pilih Pemeriksa"
                });
            });

            //Datepicker
            $('#tglsp2').datepicker({
              format: "yyyy-mm-dd",
              todayHighlight: true,
              autoclose: true
            });

		    // Remove button click
		    $(document).on(
		        'click',
		        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
		        function(e) {
		            e.preventDefault();
		            $(this).closest('.form-inline').remove();
		        }
		    );

		    // Add button click
		    $(document).on(
		        'click',
		        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
		        function(e) {
		            e.preventDefault();
		            var container = $(this).closest('[data-role="dynamic-fields"]');
		            new_field_group = container.children().filter('.form-inline:first-child').clone();
		            // new_field_group.find('input').each(function(){
		            //     $(this).val('');
		            // });
		            container.append(new_field_group);
		        }
		    );
</script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/select2.min.js') ?>"></script>