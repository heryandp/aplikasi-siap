<script>
	$(function(){
		$('#npwp').focusout(function(){
			var npwp = $('#npwp').val();
			$.get('<?= base_url()."grab/namawp/" ?>'+npwp, function(data){
				if (data == null) {
					$('#npwp-result').val('NPWP TIDAK DITEMUKAN');
				} else {
					$('#npwp-result').val(data.nama);
				}
			}, 'json')
		})
	});

	$(function(){
		$('#kode').focusout(function() {
			var kode = $('#kode').val();
			$.get('<?= base_url()."grab/getkode/" ?>'+kode,function(data){
				if(data == null){
					$('#ketkode').val('KODE TIDAK DITEMUKAN');
				} else {
					$('#ketkode').val(data.ket);
				}
			},'json');
		})
	})
</script>