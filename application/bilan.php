<h1>Ici la page des bilans</h1>
<?php
if(isset($_POST['html']))
	echo $_POST['html'];
$scan = array('prems', 'deuz');
$i = 0;
while(isset($scan[$i]))
{
	echo '<div class="bilan_file">' . $scan[$i] . '</div>';
	$i++;
}
?>
<script src="/assets/js/tinymce/js/tinymce/tinymce.min.js"></script>
<form method="POST" target="/bilan">
	<textarea name="html"><?php
if(isset($_POST['html']))
	echo $_POST['html'];
?></textarea>
	<input type="submit" value="OK">
</form>

<script>
$(document).on('ready', function(){
	tinymce.init({
		selector: "textarea",
		theme: "modern",
		plugins: [
			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
			"searchreplace wordcount visualblocks visualchars code fullscreen",
			"insertdatetime media nonbreaking save table contextmenu directionality",
			"emoticons template paste textcolor colorpicker textpattern"
		],
		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
		toolbar2: "print preview media | forecolor backcolor emoticons",
		image_advtab: true,
		templates: [
			{title: 'Test template 1', content: 'Test 1'},
			{title: 'Test template 2', content: 'Test 2'}
		]
	});
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
