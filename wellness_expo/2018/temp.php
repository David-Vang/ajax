<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>
    <title>Wellness Expo 2018 Exit Quiz</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="robots" content="noindex,nofollow">
    <meta name="description" content="Quiz landing page."/>
	<link rel="shortcut icon" href="#">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
	
<body id="landing">
    <main class="display-flex flex-vert-center">
	<div class="full-width">
		<div id="heading"><img src="media/healthbusters-logo.gif" width="100%" height="auto" /></div>
		<div id="question-container" class="transition500 padding-lrg page-load">
			<h3 id="question" class="transition500 relative padding-lrg"></h3>
			<div id="button-container" class="transition500 relative">
				<button id="confirmed-button" class="submit-button margin-lrg transition250" onclick="checkIt('confirmed')">CONFIRMED</button>
				<button id="plausible-button" class="submit-button margin-lrg transition250" onclick="checkIt('plausible')">PLAUSIBLE</button>
				<button id="busted-button" class="submit-button margin-lrg transition250" onclick="checkIt('busted')">BUSTED</button>
			</div>
		</div>
	</div>
	</main>
	
	<footer class="padding-lrg">
        Powered by HODOR!
    </footer>
	<script>
		var json_data;
		var question_total;
		var question_number = 0;
		var question, answer;
		var question_container;
		
		// FETCH JSON
		fetch('media/healthbusters.json')
		.then(response => response.json())
		.then(data => json_data = data);
		
			
		window.onload = function() {
			question_total = json_data.length;
			console.log('Question Total Before: ' + question_total);
			console.log('Question Number Before: ' + question_number);
			setTimeout(function(){ document.getElementById('question-container').classList.remove('page-load'); }, 500); 
			displayQuestion(question_number);
		}
		
		function checkIt(i) {
			var response;
			
			if ( i == answer ) {
				response = 'correct';
			} else {
				response = 'incorrect';
			}
			updateFile(response, question_number);
		
			document.getElementById('question').classList.add('disabled');
			document.getElementById('confirmed-button').disabled = true;
			document.getElementById('plausible-button').disabled = true;
			document.getElementById('busted-button').disabled = true;
			
			setTimeout(function(){ 
				document.getElementById('question').classList.add('fade-out');
			}, 11500);
			
			setTimeout(function(){ 
				if (question_number < question_total-1 ) {
					question_number++;
				} else {
					question_number = 0;
				}
				updateFile('reset', 'null');
				console.log('Question Total After: ' + question_total);
				console.log('Question Number After: ' + question_number);
				displayQuestion(question_number);
				document.getElementById('question').classList.remove('disabled', 'fade-out');
				document.getElementById('confirmed-button').disabled = false;
				document.getElementById('plausible-button').disabled = false;
				document.getElementById('busted-button').disabled = false;
			}, 12500); 
			
		}
		
		function updateFile(i, j) {
			//console.log('response: ' + i);
			//console.log('question: ' + j);
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.open("GET", "open-file-2.php?response="+i+"&question="+j, true);
			xmlhttp.send();
		}
		
		function displayQuestion(i) {
			question = (json_data[i][0]).trim();
			answer = (json_data[i][1]).trim();
			document.getElementById('question').innerHTML = question;
		}
		
	</script>
</body>
	
</html>