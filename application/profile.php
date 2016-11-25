<h1>Profile</h1>
<a href="/" style="position: absolute;top: 3px;right: 10px;">home</a>

You are actually logged as : 
<?php
	// echo $user->id;
	echo $user->profile['name'];
?>

<h2>Upload</h2>
<p>The following buttons allow you to upload anything you want. Actually open the console for watching the logs</p>

<div class='container'>
	<p>
		Select File: <input type='file' id='_file'> <input type='button' id='_submit' value='Upload!'>
	</p>
	<div class='progress_outer'>
		<div id='_progress' class='progress'></div>
	</div>
</div>

<style>
	.progress_outer{
		height: 30px;
		background: grey;
		position: relative;
		width: 200px;
		max-width: 100%;
		margin: auto;
	}
	.progress{
		position: absolute;
		left: 0;
		top: 0;
		bottom: 0;
		background: yellow;
	}
</style>

<script>
$(document).on('ready', function(){
	var _submit = document.getElementById('_submit'), 
	_file = document.getElementById('_file'), 
	_progress = document.getElementById('_progress');

	var upload = function(){

		if(_file.files.length === 0){
			return;
		}
		$(_submit).hide();
		var data = new FormData();
		data.append('SelectedFile', _file.files[0]);

		var request = new XMLHttpRequest();
		request.onreadystatechange = function(){
			if(request.readyState == 4){
				try {
					var resp = JSON.parse(request.response);
				} catch (e){
					var resp = {
						status: 'error',
						data: 'Unknown error occurred: [' + request.responseText + ']'
					};
				}
				console.log(resp.status + ': ' + resp.data);
				$(".container").after(resp.data + "<br>");
				$(_submit).show();
			}
		};

		request.upload.addEventListener('progress', function(e){
			_progress.style.width = Math.ceil(e.loaded/e.total * 100) + '%';
			console.log(Math.ceil(e.loaded/e.total* 100)  + '% of ' + e.total);
		}, false);

		request.open('POST', '/upload');
		request.send(data);
	}

	_submit.addEventListener('click', upload);
});
</script>