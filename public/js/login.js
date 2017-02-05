var SITE_BASE_URL = "http://localhost:8000";

function login(argument) {
	$('#login_button').prop("disabled",true);

	var admin_roll = $('#admin_roll').val();
	var auth_obj;
	var admin_pass = $('#admin_pass').val();
	var admin_roll_regex = /^\d{9}$/;
	if(admin_roll.match(admin_roll_regex)){
		auth_obj = {
			roll_no: admin_roll,
			password: admin_pass
		};
	} else {
		alert('Invalid Entry');
		$('#login_button').prop("disabled",false);
		return;
	}

	var route = '/signin';
	var method = 'POST';

	var request = $.ajax({
		url: SITE_BASE_URL+route,
		method: method,
		data: auth_obj
	});

	request.done(function(data){
		if(data.status_code == 200) {
			location.href = SITE_BASE_URL + "/chats";
		} else if(data.status_code==401) {
			alert("login failed");
		} else {
			$('#login_button').prop("disabled",false);
			alert(data.message);
			
		}
	}).fail(function(){
		$('#login_button').prop("disabled",false);
		alert('Login failed.');
	});
}