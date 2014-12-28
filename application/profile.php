<h1>Profile</h1>

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

<script>
$(document).on('ready', function(){
	var _submit = document.getElementById('_submit'), 
	_file = document.getElementById('_file'), 
	_progress = document.getElementById('_progress');

	var upload = function(){

		if(_file.files.length === 0){
			return;
		}

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