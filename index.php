<?php	
	include 'gcall-lib/Twilio/Capability.php';
	
	// put your Twilio API credentials here
	$accountSid = 'AC337b9c85813f33fe9dfa3a030d1d8117';
	$authToken  = 'cf52c7bed14343a9a7e821fffb1d3350';
	
	// put your Twilio Application Sid here
	$appSid     = 'AP49247f1fa0b6d92638aa2dbf9049682b';
	
	$capability = new Services_Twilio_Capability($accountSid, $authToken);
	$capability->allowClientOutgoing($appSid);
	$capability->allowClientIncoming('jenny');
	$token = $capability->generateToken();
	Header("content-type: application/x-javascript");
	if (isset($_GET['webid']))
	{
		switch ($_GET['webid']) {
			case 1:
			$yourSite = $_GET['webid'];
			break;
			default:
			echo "Your website hasn't been register with us, pleas contact phuc.bang@gcall.vn";
			return;
		}
		// echo 'function createGcallElement(){
		// (function(d, s, id){
		// var style = document.createElement("link");
		// style.id = id;
		// style.type = "text/css";
		// style.rel = "stylesheet";
		// style.href = "css/gcall-css.css";
		// document.head.appendChild(style);
		// }(document, "style", "style-gcall"));
		
		// (function(d, s, id){
		// var js, fjs = d.getElementsByTagName(s)[0];
		// if (d.getElementById(id)) {return;}
		// js = d.createElement(s); js.id = id;
		// js.src = "//static.twilio.com/libs/twiliojs/1.2/twilio.min.js";
		// fjs.parentNode.insertBefore(js, fjs);
		// }(document, "script", "script-gcall"));
		
		// }';
		//echo 'createGcallElement();';
		$actual_link = "//$_SERVER[HTTP_HOST]".strtok($_SERVER["REQUEST_URI"],'?');
		
		
	?>
	var urlGcall = '<?php echo $actual_link; ?>';
	var yourSite = '<?php echo $yourSite; ?>';
	function createGcallElementCss(){ (function(d, s, id) {
    var style = document.createElement("link");
    style.id = id;
    style.type = "text/css";
    style.rel = "stylesheet";
    style.href = urlGcall + "gcall-lib/gcall.css";
    document.head.appendChild(style);
	}(document, "style", "style-gcall"));
	};
	
	
	function createGcallElementTwilio(){ (function(d, s, id){
	var script = document.createElement("script");
    script.id = id;
    script.type = "text/javascript";
    script.src = "//static.twilio.com/libs/twiliojs/1.2/twilio.min.js";
    document.head.appendChild(script);
    }(document, 'script', 'script-gcall'));
	};
	
	
	createGcallElementCss();
	//createGcallElementTwilio();
	Twilio.Device.setup('<?php echo $token ?>');
	
	Twilio.Device.ready(function(device) {
    jQuery("#log").text("Ready");
	});
	Twilio.Device.error(function(error) {
	
    jQuery("#log").text("Something wrong, please reload!");
	});
	Twilio.Device.connect(function(conn) {
    // jQuery("#log").text("Successfully established call");
    jQuery("#log").text("Establing call...");
	});
	Twilio.Device.disconnect(function(conn) {
    jQuery("#log").text("Owner not online, want call to phone?");
    jQuery(".callphone").show();
	});
	Twilio.Device.incoming(function(conn) {
    jQuery("#log").text("Incoming connection from " + conn.parameters.From);
    // accept the incoming connection and start two-way audio
    conn.accept();
	});
	
	function call() {
    // get the phone number to connect the call to
    // params = {"PhoneNumber": jQuery("#number").val()};
    jQuery("#mainbtn").removeClass("call");
    jQuery("#mainbtn").addClass("connecting");
    params = {
	"PhoneNumber": "gcall"
    };
    //params = {"PhoneNumber": "+84989640802"};
    Twilio.Device.connect(params);
    jQuery(".hangup").show();
    jQuery("#log").show();
	}
	
	function call2() {
    params2 = {
	"PhoneNumber": "+84989640802"
    };
    Twilio.Device.connect(params2);
	}
	
	function hangup() {
    Twilio.Device.disconnectAll();
    jQuery("#log").text("Call ended");
    jQuery("#mainbtn").addClass("call");
    jQuery("#mainbtn").removeClass("connecting");
    jQuery(".hangup").hide();
    jQuery(".callphone").hide();
    jQuery("#log").hide();
	
	
	};
	/*Generat*/
	window.onload = function() {
	var blockGcall = document.createElement("div");
	blockGcall.id = "btn-gcall";	
	var string = '<button id="mainbtn" class="call" onclick="call();"></button> '+
	'<div id="log">Loading pigeons...</div>'+
	'<button class="callphone" onclick="call2();">Callphone</button> '+
	'<button class="hangup" onclick="hangup();">Hangup</button>';
	blockGcall.innerHTML = string;	
	blockGcall.style.color = "red";
	document.body.appendChild(blockGcall);
	
	}
	<?php
		return;
	}
	echo "Your website hasn't been register with us, pleas contact phuc.bang@gcall.vn";
	
?>		
