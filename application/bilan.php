<h1>Ici la page des bilans</h1>
<?php
$scan = array('prems', 'deuz');
$i = 0;
while(isset($scan[$i]))
{
	echo '<div class="bilan_file">' . $scan[$i] . '</div>';
	$i++;
}
?>


<script>
$(document).on('ready', function(){
	$('.bilan_file').on('click', function(){
		$.ajax({url:("/api?p="+$(this).html())}).done(function(data){
			var file = ""
			try{
				var p = JSON.parse(data);
				file = p.file;
			}catch(e){
				console.log(e);
				file = (data || {}).file || "";
			}
			console.log('done', data);
		});
	});
});
</script>
