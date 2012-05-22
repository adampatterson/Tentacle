<?php 
// create a function that takes the note key and sets the type as well as the message.

if($note = note::get('page_add')): ?>
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