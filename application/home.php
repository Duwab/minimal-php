<h1>Home</h1>
<ul id="items">
    <li>item 1</li>
    <li>item 2</li>
    <li>item 3</li>
</ul>
<div style="width:400px;border-bottom:1px dotted black;margin:20px auto 30px"></div>
<ul id="items" class="inline-demo">
    <li>item 1</li>
    <li>item 2</li>
    <li>item 3</li>
</ul>
<script>
$(document).on('ready', function(){
	console.log('ready');
	var el = document.getElementById('items');
	new Sortable(el);
	var el = document.getElementsByClassName('inline-demo')[0];
	new Sortable(el);
});
</script>