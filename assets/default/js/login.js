$(function() {
	$('#username').focus();
	$('input').keyup(function(e) {
		$(this).removeClass('errorfield');
		var code = e.keyCode || e.which;
		if(code==13) {
			loggingin();
		}
	});
	$('#do_login').click(function() {
		loggingin();
	});
});

function loggingin() {
	var uname = $('#username').val();
	var passwd = $('#password').val();
	var passprocess = true;
	if(uname=='') {
		passprocess = false;
		$('#username').focus().addClass('errorfield').delay(3000).queue(function(next){
			$(this).removeClass("errorfield");
			next();
		});
	}
	if(passwd=='') {
		passprocess = false;
		$('#password').focus().addClass('errorfield').delay(3000).queue(function(next){
			$(this).removeClass("errorfield");
			next();
		});
	}
	if(passprocess) {

		$.ajax({
			type  : 'post',
			url   : base_url+'auth/login/',
			data  : 'username='+uname+'&password='+passwd,
			cache : false,
			success: function(datas) {
				if(datas==0) {
					$('#password').val('').focus();
					$('#username, #password').addClass('errorfield').delay(3000).queue(function(next){
						$(this).removeClass("errorfield");
						next();
					});
				} else {
					window.location.reload();
				}
			}
		});
	}
}