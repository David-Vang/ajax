<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <title>Wellness Expo 2018 Exit Quiz</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="Quiz results page."/>
	<meta name="robots" content="noindex,nofollow">
	<link rel="shortcut icon" href="#">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<script>
	
</script>
<body id="results" class="overflow-hidden">
    <header>
	<!--<h1>Results Page</h1>-->
	</header>
	
    <main>
		<div id="video-preload" class="hide">
			<video id="preload-correct" width="100%" height="100%" preload="auto"></video>
			<video id="preload-incorrect" width="100%" height="100%" preload="auto"></video>
		</div>
		<div id="video-container" class="transition500 relative display-flex flex-vert-center">
		</div>
		<div id="why-container" class="transition500 fixed display-flex flex-vert-center flex-horz-center">
		</div>
		
		
	</main>
	
	<script>
	// Set our videos attributes.
	var windowWidth = window.innerWidth;
	var windowHeight = window.innerHeight;
	
	var calcAspectRatio = windowHeight/windowWidth;
	var aspectRatio;
	if(calcAspectRatio >= .58) {
		aspectRatio = '_43';
	} else {
		aspectRatio = '';
	}
	
	// Preload the videos to improve responsiveness.
	document.getElementById('preload-correct').innerHTML='<source src="media/correct' + aspectRatio + '.mp4" type="video/mp4">';
	document.getElementById('preload-incorrect').innerHTML='<source src="media/incorrect' + aspectRatio + '.mp4" type="video/mp4">';
	
	// Set our variables.
	var answer, question, result, why, resultsArray, questionNum, fadeTimeout, json_data;
	var response = '';
	var videoContainer = document.getElementById('video-container');
	var whyContainer = document.getElementById('why-container');
	
	// Fetch JSON data.
	fetch('media/healthbusters.json')
	.then(response => response.json())
	.then(data => json_data = data);
		
	// Check the text file for changes every second.
	var checkFile = setInterval(function() {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				if (this.responseText != response) {
					response = this.responseText;
					resultsArray = response.split(',');
					result = resultsArray[0];
					questionNum = resultsArray[1];
					console.log('video_name: ' + result);
					console.log(questionNum);
					switch(result) {
						case 'correct':
							playVideo(result);
						break;
						case 'incorrect':
							playVideo(result);
						break;
						case 'busted2':
							playVideo(result);
						break;
						default:
							fadeVideo();
					}
					if(questionNum != 'null') {
						displayWhy(questionNum);
					}
				}
			}
		};
		// Text file location.
		xmlhttp.open("GET", "http://sandbox.smscmarketing.org/wellness_expo/2018/media/ajax_info.csv?q=" + Math.random(), true);
		xmlhttp.send();
	}, 1000);
	
	// Play the video based on the response.
	function playVideo(i) {
		clearTimeout(fadeTimeout);
		videoContainer.innerHTML = '<video  width="100%" height="100%" autoplay><source src="media/' + i + aspectRatio + '.mp4" type="video/mp4"></video>';
		setTimeout(function(){ 
			videoContainer.classList.add('fade-in');
		}, 250);
		setTimeout(function(){ 
			fadeVideo();
		}, 5000);
	}
	
	// Clear video function.
	function fadeVideo() {
		videoContainer.classList.remove('fade-in');
		setTimeout(function(){ 
			videoContainer.innerHTML = '';
		}, 500);
	}
	
	function displayWhy(i) {
		question = (json_data[i][0]).trim();
		answer = (json_data[i][1]).trim();
		why = (json_data[i][2]).trim();
		whyContainer.innerHTML = '<div id="why-text"><div id="question">' + question + '</div><div id="why-heading"> <span class="answer ' + answer + '">' + answer + '</span></div><div id="why">' + why + '</div></div>';
		// Fade in why container.
		setTimeout(function(){
			whyContainer.classList.add('fade-in');
			// Remove "why" overlay after 5 seconds.
			setTimeout(function() {
				whyContainer.classList.remove('fade-in');
				setTimeout(function() {
					whyContainer.innerHTML='';
				}, 500);
			}, 6000);
		}, 5000);
	}
	
	</script>

</body>
</html>

