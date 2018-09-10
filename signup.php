<!DOCTYPE html>
<html lang="en">
<head>
	<style>
			.error {color: #FF0000;}
	</style>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <title>Sign Up</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/index.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
  <style>
	.logback{
		padding:3% 0% 3% 0%;
	}
  
  </style>
  <script type="text/javascript">
  function confirmPass(){
        var pass = document.getElementById("pwrd").value;
        var confPass = document.getElementById("cpword").value;
		if (confPass.length==0) { 
			document.getElementById('cpwordlbl').innerHTML = '';
        return;
    }
    if(pass != confPass) {
			document.getElementById('cpwordlbl').innerHTML = 'passwords do not match!';
			document.getElementById('cpwordlbl').style.color='red';
    }
		else{
			document.getElementById('cpwordlbl').innerHTML = 'passwords match!';
			document.getElementById('cpwordlbl').style.color='#26A69A';
		}
  }

	function strongPass(){
		var pass = document.getElementById("pwrd").value;

		if(pass.length==0){ 
			document.getElementById('strength').innerHTML = 'Use 6 or more characters with a mix of letters, numbers and symbols';
      		document.getElementById('strength').style.color='#9E9EB7';
			return;
    	}

		var strongRegex = new RegExp("^(?=.{8,})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*\\W).*$", "g");
		var mediumRegex = new RegExp("^(?=.{7,})(((?=.*[A-Z])(?=.*[a-z]))|((?=.*[A-Z])(?=.*[0-9]))|((?=.*[a-z])(?=.*[0-9]))).*$", "g");
		var enoughRegex = new RegExp("(?=.{6,}).*", "g");

		if (enoughRegex.test(pass) == false) {
			document.getElementById('strength').innerHTML = 'Enter more characters';
			document.getElementById('strength').style.color='#E67E00';
		} else if (strongRegex.test(pass)) {
			document.getElementById('strength').innerHTML = 'Strong password!';
			document.getElementById('strength').style.color='#26A69A';
		} else if (mediumRegex.test(pass)) {
			document.getElementById('strength').innerHTML = 'Medium!';
			document.getElementById('strength').style.color='#5AF95A';
		} else {
			document.getElementById('strength').innerHTML = 'Weak password!';
			document.getElementById('strength').style.color='red';
		}
	}
	
	function valUName(str){
	  if (str.length==0) { 
		document.getElementById("lblUName").innerHTML="Username";
		document.getElementById("lblUName").style.color='#26A69A';
        return;
      }
	  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      } else {  // code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
			var state = this.responseText;
			var err = "Username already exists!";
          document.getElementById("lblUName").innerHTML=this.responseText;
		  if(state == err)
		  document.getElementById("lblUName").style.color='red';
		  else	document.getElementById("lblUName").style.color='#26A69A';
        }
      }
      xmlhttp.open("GET","checkUName.php?q="+str,true);
      xmlhttp.send();
	}

	function valRequired(){
			var name = document.forms["signupForm"]["name"].value;
			var gender = document.forms["signupForm"]["gender"].value;
			var staffID = document.forms["signupForm"]["staffID"].value;
			var uName = document.forms["signupForm"]["user"].value;
			var email = document.forms["signupForm"]["email"].value;
			var pass = document.forms["signupForm"]["pwrd"].value;
			var cpass = document.forms["signupForm"]["cpword"].value;
			var check = true;


			if(name==""){
				document.getElementById("reqName").innerHTML='* This is a required field!';
				check = false;
			}
			else document.getElementById("reqName").innerHTML='*';

			if(gender==""){
				document.getElementById("reqGender").innerHTML='* This is a required field!';
				check = false;
			}
			else document.getElementById("reqGender").innerHTML='*';
			
			if(staffID==""){
				document.getElementById("reqID").innerHTML='* This is a required field!';
				check = false;
			}
			else document.getElementById("reqID").innerHTML='*';

			if(uName==""){
				document.getElementById("reqUName").innerHTML='* This is a required field!';
				check = false;
			}
			else document.getElementById("reqUName").innerHTML='*';

			if(email==""){
				document.getElementById("reqEmail").innerHTML='* This is a required field!';
				check = false;
			}
			else document.getElementById("reqEmail").innerHTML='*';

			if(pass==""){
				document.getElementById("reqPass").innerHTML='* This is a required field!';
				check = false;
			}
			else document.getElementById("reqPass").innerHTML='*';

			if(cpass==""){
				document.getElementById("reqConPass").innerHTML='* This is a required field!';
				check = false;
			}
			else document.getElementById("reqConPass").innerHTML='*';

			
			return check;
			
		}
	</script>
</head>
<body>
	<!--navigation bar-->
  <nav class="black" id="nav" role="navigation">
    <div class="nav-wrapper container">
      <a id="logo-container" href="index.php" class="brand-logo"><img src = "MainLogo.png"></a>
      <ul class="right hide-on-med-and-down">
        <li><a class="navi" href="https://www.facebook.com/vazdilanson.mathalamuthu" style = "color : white">Contact us</a></li>
      </ul>
    </div>
  </nav>
  
	<br>
	<div class ="center" style="width:80%">
		<div class = "titleBar">
			<h4 class="frontTitle">SIGN UP</h4>
			<div class = "titleLine"></div>
		</div>
		<br><br>
	</div>

	<form class="col s12" onsubmit="return valRequired()" action="page3.php" method="POST" name="signupForm">	
	<div class="row center" style="width:80%">	
		<p><span class="error">* required field</span></p>
		<div class="left" style="width:40%">
			
				<div class="row">
					<div class="input-field col s12">
						<input name="name" id="name" type="text" >
						<label for="name" >Name<span class="error" id="reqName">* </span></label>
					</div>
				</div>
			
		</div>
	
		<div class="left" style="width:60%">
			
				<div class="row">
					<div class="input-field col s12">
						<input id="address" name="address" type="text" >
						<label for="address" >Address</label>
					</div>
				</div>
			
		</div>
	</div>
	<div class="row center" style="width:60%">
		<div class="left" style="width:33%">
			
				<div class="row">
					<div >
					<label class="left"><font size="2">Gender</font><span class="error" id="reqGender">* </span></label><br>
					<p>
      		<input class="with-gap" name="gender" value="Male" type="radio" id="test1" />
      		<label for="test1">Male</label>
    		
      		<input class="with-gap" name="gender" value="Female" type="radio" id="test2" />
      		<label for="test2">Female</label>
    		
      		<input class="with-gap" name="gender" value="Other" type="radio" id="test3"  />
      		<label for="test3">Other</label>
    			</p>
				
					</div>
				</div>
			
		</div>
		
		<div class="left" style="width:33%">
			
				<div class="row">
					<div class="input-field col s12">
						<input id="staffID" type="text" name="staffID">
						<label for="staffID" >Staff ID No.<span class="error" id="reqID">* </span></label>
					</div>
				</div>
			
		</div>
		
		<div class="left" style="width:33%">
			
				<div class="row">
					<div class="input-field col s12">
						<input name="positn" id="positn" type="text" >
						<label for="positn" >Position in Library</label>
					</div>
				</div>
			
		</div>
        
        <div class="left" style="width:33.3%">
			
				<div class="row">
					<div class="input-field col s12">
						<input name="user" id="user" type="text" onblur="valUName(this.value)">
						<label id="lblUName" for="user" >Username<span class="error" id="reqUName">* </span></label>
					</div>
				</div>
			
		</div>
		<div class="left" style="width:66.7%">
			
				<div class="row">
					<div class="input-field col s12">
						<input id="email" name="email" type="email" class="validate">
						<label for="email" data-error="wrong" data-success="right">Email<span class="error" id="reqEmail">* </span></label>
					</div>
				</div>
			
		</div>
	</div>	
	
	<div class="row center" style="width:30%">
		<div class="center" style="width:100%">
			<div class="row">
				<div class="input-field col s12">
					<input name="pwrd" id="pwrd" type="password" onkeyup="strongPass()">
					<label for="pwrd">Password<span class="error" id="reqPass">* </span></label>
					</div>
					<label id="strength">Use 6 or more characters with a mix of letters, numbers and symbols</label>
				</div>
		</div>
		
		<div class="center" style="width:100%">
			<div class="row">
				<div class="input-field col s12">
					<input id="cpword" name="cpword" type="password" onkeyup="confirmPass()">
					<label  for="cpword">Confirm Password<span class="error" id="reqConPass">* </span></label>
				</div>
				<label id="cpwordlbl"></label>
			</div>
		</div> 
	</div><br>
	<div class="center">
		<input id = "submit" name="submit" class="SerButton waves-effect lighten-1" value="Sign Up" type="submit"/>
	</div>
	</form>
	
	
	<br><br>
    <div class="footer1">
      <div class="container">
      Made by <a style="color:#ffffff" href="https://www.facebook.com/vazdilanson.mathalamuthu">Team Imperium</a>
     </div>
    </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
