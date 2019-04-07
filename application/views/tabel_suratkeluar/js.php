<script>
    //Select2
    $(document).ready(function () {
        $(".select2").select2({
            theme: "classic"
        });
        $("#case-list").hide();
    });

    $('#jenis').change(function() {
       if($(this).val() == "NDRIK")
        {
         $("#case-list").show();
        } else {
         $("#case-list").hide();
        }
    });

    //Get Nomor Surat
    $(function(){
        $('#get-nomor').click(function() {
           var jenis = $('#jenis').val();
           $.get('<?= base_url()."tabel_suratkeluar/get_no_surat/" ?>'+jenis, function(data,status){
              $('#nomor').val(data);
              console.log($('#nomor').val(data));
               })
        })
    });

    //Datepicker
    $('#tgl').datepicker({
      format: "yyyy-mm-dd",
      todayHighlight: true,
      autoclose: true
    })

</script>
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/select2.min.js') ?>"></script>