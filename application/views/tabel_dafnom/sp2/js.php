<script>
            //Select2
            $(document).ready(function () {
                $(".chosen-case").chosen({
                    placeholder: "Pilih Case / Wajib Pajak"
                });
                $(".chosen-pemeriksa").chosen({
                    placeholder: "Pilih Pemeriksa"
                });
                $(".chosen-role").chosen({
                    placeholder: "Pilih Role"
                });
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
		        	var max = 9;
		        	if ( $('.form-pemeriksa').length < max ) {
			            $(".chosen-pemeriksa,.chosen-role").chosen("destroy");
			            var container = $(this).closest('[data-role="dynamic-fields"]');
			            new_field_group = container.children().filter('.form-inline:first-child').clone();
			            new_field_group.find('input').each(function(){
			                $(this).val('');
			            });
			            container.append(new_field_group);
			            $(".chosen-pemeriksa,.chosen-role").chosen();
		        	}
		        }
		    );
		
            //Nomor
            $("#status").on("change", function() {
			  if ($(this).val() == 0) {
			    $("#nosp2").mask("PRIN-99999/WPJ.05/KP.0205/RIK.SIS/2019");
			  } else {
			    $("#nosp2").mask("PRIN-P-99999/WPJ.05/KP.0205/RIK.SIS/2019");
			  }
			});

            //Datepicker
            $('#tglsp2').datepicker({
              format: "yyyy-mm-dd",
              todayHighlight: true,
              autoclose: true
            });

</script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/chosen.jquery.min.js') ?>"></script>