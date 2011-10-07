<?php if($note = note::get('page_add')): ?>
	<script type="text/javascript">
		$(document).ready(function() {
			jQuery.noticeAdd({
				text : '<?= $note['content'];?>',
				stay : false,
				type : '<?= $note['type']; ?>'
			});
		});
	</script>
<?php endif;?>