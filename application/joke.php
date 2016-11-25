<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
<div class="joke">
	<h2>What the <span class="word"></span>?</h2>
</div>
<a href="/">retour</a>

<style>
	.joke{
		margin-top: 200px;
		cursor:pointer;
	   -moz-user-select: none;
	   -khtml-user-select: none;
	   -webkit-user-select: none;
	   -ms-user-select: none;
   user-select: none;
	}
	a {
		position: absolute;
		display: block;
		text-align: center;
		right: 0;
		bottom: 20px;
		left: 0;
	}
	/* *{ font-family: ‘Metrophobic’, Arial, serif; font-weight: 400; } */
	*{ font-family: 'Lobster', cursive, serif; font-weight: 400; }
</style>

<script>
"use strict";

$(document).on('ready', function(){
	
	var word = "fuck",
		maxIteration = 4;
	
	init();
	
	window.setInterval(randomDisplay, 2000);
	
	$('.joke').click(randomize);
	
	function init(){
		var i = 0;
		while(i < word.length)
		{
			$('.word').append('<span>' + word[i] + '</span>');
			i ++;
		}
		randomDisplay();
	}
	
	function randomDisplay(){
		var n = 0;
		var elts = $('.word span');
		elts.each(function(i, span){
			var r = Math.round(Math.random() * 3) + 1;
			if(n < 2 && (r > 2 || (i === (elts.length-1) && n === 0)))
			{
				$(span).html('*');
				n++;
			}else
			{
				$(span).html(word[i]);
			}
		});
	}
	
	var initialContent = $('.joke h2').html(),
		colors = "0123456789ABCDEF";
	
	function randomize(){
		var iteration = 0;
		incrementMax();
		
		var timer = setInterval(function(){
			action();
			iteration++;
			if(iteration >= maxIteration)
			{
				clearInterval(timer);
				reset();
			}
		}, 200);
		
		function action(){
			console.log('do');
			if(Math.random() > 0.5)
			{
				$('.joke h2').html("What the fuck?");
			}else
			{
				$('.joke h2').html("**************");
			}
			$('body').css("background-color", getColor());
		};
		
		function reset(){
			$('body').css("background", "");
			$('.joke h2').html(initialContent);
		}
		
		function getColor(){
			var i = 0;
			var value = "#";
			while(i < 3)
			{
				value += colors[Math.floor(Math.random()*colors.length)];
				i++;
			}
			return value;
		}
	}
	
	function incrementMax(){
		maxIteration += (maxIteration + 1 + 0.1 * maxIteration) / maxIteration;
	}
});
</script>