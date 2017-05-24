var showmenu = 0;
var ajaxRequest = '';
var listener = 0;
var addMode;
var printMode;


$(function() {
	addMode = false;
	printMode = false;
	$('.abahsoft_header_back, .abahsoft_news_ticker_back').css({opacity:.6});
	$('.abahsoft_app_menu').css({opacity:.9});
	$('.abahsoft_app_menu').css({top:$('.abahsoft_app_menu').outerHeight()*-1});
	$('#abahsoft_right_content_petatematik').css({right:0});
	$('.abahsoft_quick_search').css({opacity:.95});
	$('#abahsoft_active_right').val('abahsoft_right_content_petatematik');
	//$('#abahsoft_active_right').val('abahsoft_right_content_pemetaan');
	$( "#abahsoft_right_content_petatematik" ).css("margin", "0px");
	$( "#abahsoft_right_content_petatematik" ).animate({width: "22%",margin: "0px"}, 200);
 
	$(window).resize(function() {
		$('.abahsoft_right_content').css({height:$(window).height()-$('.abahsoft_header_front').outerHeight()-60});
		//$('.abahsoft_right_content_data').css({height:$(window).height()-$('.abahsoft_header_front').outerHeight()-100});
		$('.abahsoft_map_area').css({height:$(window).height()-$('.abahsoft_header_front').outerHeight()-40});
		$('#abahsoft_map_view').css({height:$(window).height()-$('.abahsoft_header_front').outerHeight()-60, width:'100%'});
		$('.abahsoft_left_content').css({height:$('.abahsoft_right_content').outerHeight(), width:$(window).width()-$('.abahsoft_right_content').outerWidth()});
		//$('#abahsoft_map_view').css({position:absolute});
		//$('#abahsoft_content_responden, #abahsoft_content_dashboard').css({width:$(window).width()-40});
		//$('#abahsoft_quick_search_result').css({height:($('.abahsoft_left_content').outerHeight()-$('#abahsoft_form_quick_search').outerHeight())});
	});

	$('.abahsoft_app_logout').hover(function() {
		$(this).addClass('abahsoft_app_logout_hover');
	}, function() {
		$(this).removeClass('abahsoft_app_logout_hover');
	});
	$('.abahsoft_app_logout').click(function() {
		window.location.href=base_url+'auth/logout';
	});


	$('.abahsoft_menu_arrow').hover(function() {
		$(this).css({'background-color':'#999'});
	}, function() {
		$(this).css({'background-color':'#888'});
	});

	$('.abahsoft_app_menu ul').hover(function() { }, function() {
		showmenu = 0;
		$('.abahsoft_app_menu').stop().animate({top:$('.abahsoft_app_menu').outerHeight()*-1});
	});

	$('.abahsoft_app_menu ul li').hover(function() {
		$(this).stop().animate({'padding-left':25}, 300);
		$(this).addClass('abahsoft_app_menu_hover');
	},function() {
		$(this).stop().animate({'padding-left':20}, 200);
		$(this).removeClass('abahsoft_app_menu_hover');
	});

	$('.abahsoft_app_menu ul li').click(function() {
		$('.abahsoft_app_menu_selected').each(function() {
			$(this).removeClass('abahsoft_app_menu_selected');
		});
		$(this).addClass('abahsoft_app_menu_selected');
		var thisname = $(this).find('span').html();
		var thisicon = $(this).find('i').attr('class');

		$('.abahsoft_menu_current_icon').html('<i class="'+thisicon+'"></i>');
		$('.abahsoft_menu_current_name').html(thisname);

		var showcontent = $(this).attr('ref');
		var activeright = $('#abahsoft_active_right').val();

		//load menu content
		if(showcontent=='pemetaan') {
			clearOverlaysDraw();
	 		printMode = false;
			//aktifkan mode editing
			drawingManager.setOptions({
				drawingControl: false
			});
			onMapClick(activeright);
  
			
		} else if(showcontent=='penambahan') {
			printMode = false;
			clearOverlays();
			clearOverlaysDraw();
			//aktifkan mode editing
			drawingManager.setOptions({
				drawingControl: false
			});
	        google.maps.event.addListener(map, "click", function (event) 
			{
				marker = new google.maps.Marker({
					position: event.latLng,
					map: map
				});
			showData(event.latLng);				
			});
			onAddClick(activeright);
		} else if(showcontent=='petatematik') {
            printMode = false;
			clearOverlaysDraw();
			//aktifkan mode editing
			drawingManager.setOptions({
				drawingControl: false
			});
			onTematikClick(activeright);
			
		} else if(showcontent=='pencetakan') {
			//printMode = true;
			//aktifkan mode editing
			drawingManager.setOptions({
				drawingControl: false
			});
			onPrintClick(activeright);
		} else if(showcontent=='editpetakawasan') {
			 printMode = false;
			//onEditPetaKawasanClick(activeright);
			onPetaKawasanClick(activeright);
			//aktifkan mode editing
			  drawingManager.setOptions({
				drawingControl: true
			});
			clearOverlaysDraw();
			showKawasan('edit','1','blok',printMode);
			showKawasan('edit','1','jalan',printMode);
			showKawasan('edit','1','drainase',printMode);
			

		}
		 else if(showcontent=='petakawasan') {
			printMode = false;
			onPetaKawasanClick(activeright);
			//aktifkan mode editing
			drawingManager.setOptions({
				drawingControl: false
			});
			//show('1',thisid,printMode)
			clearOverlaysDraw();
			showKawasan('show','1','jalan',printMode);
			showKawasan('show','1','drainase',printMode);
			showKawasan('show','1','blok',printMode);
			
		}  else if(showcontent=='petajalan') {
			printMode = false;
			onPetaJalanClick(activeright);
			//aktifkan mode editing
			drawingManager.setOptions({
				drawingControl: false
			});
			//show('1',thisid,printMode)
			clearOverlaysDraw();
		    $('#daftar_kawasan').html("");
			$('#daftar_drainase').html("");
			showKawasan('show','1','jalan',printMode);
		}  else if(showcontent=='petadrainase') {
			printMode = false;
			onPetaDrainaseClick(activeright);
			//aktifkan mode editing
			drawingManager.setOptions({
				drawingControl: false
			});
			//show('1',thisid,printMode)
			clearOverlaysDraw();
			$('#daftar_kawasan').html("");
			$('#daftar_jalan').html("");
			showKawasan('show','1','drainase',printMode);
		}
		
		//hide menu
		showmenu = 0;
		$('.abahsoft_app_menu').stop().animate({top:$('.abahsoft_app_menu').outerHeight()*-1});
	});

	$('.abahsoft_menu_arrow').click(function() {
	//alert(showmenu);
		if(showmenu==0) {
			showmenu = 1;
			$('.abahsoft_app_menu').stop().animate({top:70});
		} else {
			showmenu = 0;
			$('.abahsoft_app_menu').stop().animate({top:$('.abahsoft_app_menu').outerHeight()*-1});
		}
	});


	$('#abahsoft_close_responden_detail').click(function() {
		closeRespondenDetail();
	});
	
	$('#abahsoft_close_aset_detail').click(function() {
		closeAsetDetail();
	});
	
	$('#abahsoft_close_responden_edit').click(function() {
		closeRespondenEdit();
	});
	$('#abahsoft_close_survey_edit').click(function() {
		closeSurveyEdit();
	});
	$('#abahsoft_close_option_add').click(function() {
		closeOptionAdd();
	});
	$('#abahsoft_close_pengguna_add').click(function() {
		closeUserAdd();
	});
	$('#abahsoft_close_responden_add').click(function() {
		closeRespondenAdd();
	});

	

	$('.abahsoft_right_list_menu ul li').hover(function() {
		$(this).addClass('abahsoft_right_list_menu_hover');
	}, function() {
		$(this).removeClass('abahsoft_right_list_menu_hover');
	});

	$('.abahsoft_right_list_menu ul li').click(function() {
		closeOptionAdd();
		$('.abahsoft_right_list_menu_selected').each(function() {
			$(this).removeClass('abahsoft_right_list_menu_selected');
		});

		//clear rekap
		$('#abahsoft_btn_custom_recap_clear').hide();
		$('#abahsoft_btn_custom_recap').show();
		$('#abahsoft_custom_item_active').val(0);
		$('#abahsoft_btn_summary_recap').show();
		$('#abahsoft_custom_item').val('-');
		$('#abahsoft_right_custom_recap_list').empty();
		$('.abahsoft_filter_quiz_item').removeAttr('disabled');
		$('#abahsoft_filter_quiz').show();
		$('#abahsoft_right_custom_recap').hide();

		$(this).addClass('abahsoft_right_list_menu_selected');
		var thisid = $(this).attr('id');
		var rw_selected = $('#abahsoft_filter_rw').val();
		thisid = thisid.replace('abahsoft_rekap_','');
		$('#abahsoft_right_list_menu_inload').val(thisid);
		var rwname = $('#rw_'+rw_selected).text();
		rwname = (rw_selected=='nol')?'':' '+rwname;
		$('#abahsoft_preload_rekap div').html('<div class="win-ring small"></div> Menghitung data '+$(this).html()+' semua responden'+rwname+'...');

		$('#abahsoft_preload_rekap').show();
		$('#abahsoft_loaded_rekap').hide();
		ajaxGetRekap('rekap', thisid, rw_selected);
	});
     
	 /*
	$('.abahsoft_right_petatematik_menu ul li').hover(function() {
		$(this).addClass('abahsoft_right_petatematik_menu_hover');
	}, function() {
		$(this).removeClass('abahsoft_right_petatematik_menu_hover');
	});
	 */
	
   	//$('.abahsoft_right_petatematik_menu ul li').click(function() {
	$('.dropdown-menu li').click(function() {
		closeOptionAdd();
		$('.abahsoft_right_petatematik_menu_selected').each(function() {
			$(this).removeClass('abahsoft_right_petatematik_menu_selected');
		});
		
		/*
		$('#dropdown_menu_01').removeClass('keep-open');
		$('#dropdown_menu_02').removeClass('keep-open');
		$('#dropdown_menu_03').removeClass('keep-open');
		$('#dropdown_menu_04').removeClass('keep-open');
		$('#dropdown_menu_05').removeClass('keep-open');
        */
		
		$(this).addClass('abahsoft_right_petatematik_menu_selected');
		var thisid = $(this).attr('id');	
		thisid = thisid.replace('abahsoft_tematik_','');
		$('#abahsoft_right_petatematik_menu_inload').val(thisid);		
		//$('#dropdown_menu_'+thisid.substr(0,2)).addClass('keep-open');
		//$('#dropdown_menu_'+thisid.substr(0,2)).css({'display':'block'});
		//alert(thisid);	
		/*
        if(thisid.substr(0,2)=='01'){
		   $('#dropdown_menu_01').addClass('keep-open');
		   $('#dropdown_menu_02').removeClass('keep-open');
		   $('#dropdown_menu_03').removeClass('keep-open');
			$('#dropdown_menu_04').removeClass('keep-open');
			$('#dropdown_menu_05').removeClass('keep-open');
		}
		
		if(thisid.substr(0,2)=='02'){
		   $('#dropdown_menu_02').addClass('keep-open');
		   $('#dropdown_menu_01').removeClass('keep-open');
		   $('#dropdown_menu_03').removeClass('keep-open');
			$('#dropdown_menu_04').removeClass('keep-open');
			$('#dropdown_menu_05').removeClass('keep-open');
		}
		*/
		//alert(printMode);
		//if(thisid.substr(0,2)==02){
	//		AddUnit('1',thisid,printMode);
		//}else{
			AddTematik('1',thisid,printMode);
		//}
	});
	
	//abah tambah list kawasan click function
	
	$(window).resize();

	$('.abahsoft_site_logo').hover(function() {
		$(this).css({'background-color': '#ffffff'});
	},function() {
		$(this).css({'background-color': '#f5f5f5'});
	});
	$('.abahsoft_site_logo').click(function() {
		window.location.href='';
	});

	$('#abahsoft_quick_search').keyup(function(e) {
		var code = e.keyCode || e.which;
		if(code==13) {	
			var rws = $('#abahsoft_quick_search_rw').val();		
			if(rws!='nol') {
				showQuickSearch();
			}
			else{
				$('#abahsoft_quick_search_result').html('<center><br/> Silahkan Pilih Golongan Aset!</center>');
			}
		}
	});
	$('#abahsoft_add_search').keyup(function(e) {
		var code = e.keyCode || e.which;

		if(code==13) {	
			var rws = $('#abahsoft_quick_search_rw').val();		
			if(rws!='nol') {
				showQuickSearch();
			}
			else{
				$('#abahsoft_quick_search_result').html('<center><br/> Silahkan Pilih Golongan Aset!</center>');
			}
		}
	});
/*	
	$('#abahsoft_quick_search_barang').keyup(function(v) {
		var code = v.keyCode || e.which;
		if(code==13) {	
			var rws = $('#abahsoft_quick_search_rw').val();		
			if(rws!='nol') {
				showQuickSearch();
			}
			else{
				$('#abahsoft_quick_search_result_barang').html('<center><br/> Silahkan Pilih Golongan Aset!</center>');
			}
		}
	});
*/
	$('#abahsoft_quick_search_rw').change(function() {
		var rws = $('#abahsoft_quick_search_rw').val();
		if(rws!='nol') {
			showQuickSearch();
		}
		else{
		  $('#abahsoft_quick_search_result').html('<center><br/> Silahkan Pilih Golongan Aset!</center>');
		}
	});

	$('#abahsoft_close_quick_search').click(function() {
		//$('#abahsoft_quick_search_result').empty();
		$('#abahsoft_quick_search').val('');
		$('#abahsoft_close_quick_search').fadeOut(500);
		$('.abahsoft_quick_search_list').show();
		setTimeout(function() { $('#abahsoft_quick_search').animate({'width':'260px'}, 500); }, 600);
		clearAllMarkers();
		onMapClick();
	});

	
	$("#abahsoft_quick_search_rw").change(function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_bidang_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_search_bid").html(data.list);
				$("#abahsoft_search_kel").html("<select style='width:260px' id='abahsoft_quick_search_kel'><option id='abahsoft_quick_search_kel_nol' value='nol'>-- Kelompok Aset --</option></select>");
				$("#abahsoft_search_sub").html("<select style='width:260px' id='abahsoft_quick_search_sub'><option id='abahsoft_quick_search_sub_nol' value='nol'>-- Sub-Kelompok Aset --</option></select>");
				$("#abahsoft_search_brg").html("<select style='width:260px' id='abahsoft_quick_search_brg'><option id='abahsoft_quick_search_brg_nol' value='nol'>-- Barang Aset --</option></select>");
			}
		});
    });
	
	$("#abahsoft_search_bid").delegate("#abahsoft_quick_search_bid","change",function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_kelompok_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_search_kel").html(data.list);
				$("#abahsoft_search_sub").html("<select style='width:260px' id='abahsoft_quick_search_sub'><option id='abahsoft_quick_search_sub_nol' value='nol'>-- Sub-Kelompok Aset --</option></select>");
				$("#abahsoft_search_brg").html("<select style='width:260px' id='abahsoft_quick_search_brg'><option id='abahsoft_quick_search_brg_nol' value='nol'>-- Barang Aset --</option></select>");
			}
		});
    });
	
	$("#abahsoft_search_kel").delegate("#abahsoft_quick_search_kel","change",function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_subkel_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_search_sub").html(data.list);
				$("#abahsoft_search_brg").html("<select style='width:260px' id='abahsoft_quick_search_brg'><option id='abahsoft_quick_search_brg_nol' value='nol'>-- Barang Aset --</option></select>");
			}
		});
    });
	
	$("#abahsoft_search_sub").delegate("#abahsoft_quick_search_sub","change",function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_barang_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_search_brg").html(data.list);
			}
		});
    });

	$("#abahsoft_search_brg").delegate("#abahsoft_quick_search_brg","change",function () {
		$("#noreg").val(this.value);
    });
	
	//copy paste fungsi searching untuk add point
		$('#abahsoft_add_search').keyup(function(e) {
		var code = e.keyCode || e.which;
		if(code==13) {	
			var rws = $('#abahsoft_add_search_rw').val();		
			if(rws!='nol') {				
				showAddSearch();				
			}
			else{
				$('#abahsoft_add_search_result').html('<center><br/> Silahkan Pilih Golongan Aset!</center>');
			}
		}
	});

	$('#abahsoft_add_search_rw').change(function() {
		var rws = $('#abahsoft_add_search_rw').val();
		if(rws!='nol') {
				showAddSearch();
		}
		else{
		  $('#abahsoft_add_search_result').html('<center><br/> Silahkan Pilih Golongan Aset!</center>');
		}
	});

	$('#abahsoft_close_add_search').click(function() {
		//$('#abahsoft_quick_search_result').empty();
		//$('#abahsoft_add_search_result').val('');
		$('#abahsoft_add_search').val('');
		$('#abahsoft_close_add_search').fadeOut(500);
		$('.abahsoft_add_search_list').show();
		setTimeout(function() { $('#abahsoft_add_search').animate({'width':'260px'}, 500); }, 600);
		clearAllMarkers();
		//onMapClick();
		onAddClick();
	});
	
	$("#abahsoft_add_search_rw").change(function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_bidang_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_addsearch_bid").html(data.list);
				$("#abahsoft_addsearch_kel").html("<select style='width:260px' id='abahsoft_add_search_kel'><option id='abahsoft_add_search_kel_nol' value='nol'>-- Kelompok Aset --</option></select>");
				$("#abahsoft_addsearch_sub").html("<select style='width:260px' id='abahsoft_add_search_sub'><option id='abahsoft_add_search_sub_nol' value='nol'>-- Sub-Kelompok Aset --</option></select>");
				$("#abahsoft_addsearch_brg").html("<select style='width:260px' id='abahsoft_add_search_brg'><option id='abahsoft_add_search_brg_nol' value='nol'>-- Barang Aset --</option></select>");
			}
		});
    });
	
	$("#abahsoft_addsearch_bid").delegate("#abahsoft_quick_search_bid","change",function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_kelompok_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_addsearch_kel").html(data.list);
				$("#abahsoft_addsearch_sub").html("<select style='width:260px' id='abahsoft_add_search_sub'><option id='abahsoft_add_search_sub_nol' value='nol'>-- Sub-Kelompok Aset --</option></select>");
				$("#abahsoft_addsearch_brg").html("<select style='width:260px' id='abahsoft_add_search_brg'><option id='abahsoft_add_search_brg_nol' value='nol'>-- Barang Aset --</option></select>");
			}
		});
    });
	
	$("#abahsoft_addsearch_kel").delegate("#abahsoft_quick_search_kel","change",function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_subkel_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_addsearch_sub").html(data.list);
				$("#abahsoft_addsearch_brg").html("<select style='width:260px' id='abahsoft_add_search_brg'><option id='abahsoft_add_search_brg_nol' value='nol'>-- Barang Aset --</option></select>");
			}
		});
    });
	
	$("#abahsoft_addsearch_sub").delegate("#abahsoft_quick_search_sub","change",function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_barang_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_addsearch_brg").html(data.list);
			}
		});
    });

	$("#abahsoft_addsearch_brg").delegate("#abahsoft_quick_search_brg","change",function () {
		$("#noreg").val(this.value);
    });
	
	//end searching add point
	
		//copy paste fungsi searching untuk id barang (test)
		$('#abahsoft_barang_search').keyup(function(e) {
		//alert("test");
		var code = e.keyCode || e.which;
		if(code==13) {	
			var rws = $('#abahsoft_barang_search_rw').val();		
			if(rws!='nol') {				
				showAddBarang();				
			}
			else{
				$('#abahsoft_barang_search_result').html('<center><br/> Silahkan Pilih Golongan Aset!</center>');
			}
		}
	});

	$('#abahsoft_barang_search_rw').change(function() {
		var rws = $('#abahsoft_barang_search_rw').val();
		if(rws!='nol') {
				//showAddSearch();
				showAddBarang();
		}
		else{
		  $('#abahsoft_barang_search_result').html('<center><br/> Silahkan Pilih Golongan Aset!</center>');
		}
	});

	$('#abahsoft_close_barang_search').click(function() {
		//$('#abahsoft_quick_search_result').empty();
		//$('#abahsoft_add_search_result').val('');
		$('#abahsoft_barang_search').val('');
		$('#abahsoft_close_barang_search').fadeOut(500);
		$('.abahsoft_barang_search_list').show();
		setTimeout(function() { $('#abahsoft_barang_search').animate({'width':'260px'}, 500); }, 600);
		clearAllMarkers();
		//onMapClick();
		clearOverlaysDraw();
		showKawasan('edit','1','blok',printMode);
		showKawasan('edit','1','jalan',printMode);
		showKawasan('edit','1','drainase',printMode);
		onPetaKawasanClick();
		//showKawasan('edit','1','jalan',printMode);
		//showKawasan('edit','1','drainase',printMode);
		//showKawasan('edit','1','blok',printMode);
	});
	
	$("#abahsoft_barang_search_rw").change(function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_bidang_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_barang_search_bid").html(data.list);
				$("#abahsoft_barang_search_kel").html("<select style='width:260px' id='abahsoft_barang_search_kel'><option id='abahsoft_barang_search_kel_nol' value='nol'>-- Kelompok Aset --</option></select>");
				$("#abahsoft_barang_search_sub").html("<select style='width:260px' id='abahsoft_barang_search_sub'><option id='abahsoft_barang_search_sub_nol' value='nol'>-- Sub-Kelompok Aset --</option></select>");
				$("#abahsoft_barang_search_brg").html("<select style='width:260px' id='abahsoft_barang_search_brg'><option id='abahsoft_barang_search_brg_nol' value='nol'>-- Barang Aset --</option></select>");
			}
		});
    });
	
	$("#abahsoft_barang_search_bid").delegate("#abahsoft_quick_search_bid","change",function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_kelompok_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_barang_search_kel").html(data.list);
				$("#abahsoft_barang_search_sub").html("<select style='width:260px' id='abahsoft_barang_search_sub'><option id='abahsoft_barang_search_sub_nol' value='nol'>-- Sub-Kelompok Aset --</option></select>");
				$("#abahsoft_barang_search_brg").html("<select style='width:260px' id='abahsoft_barang_search_brg'><option id='abahsoft_barang_search_brg_nol' value='nol'>-- Barang Aset --</option></select>");
			}
		});
    });
	
	$("#abahsoft_barang_search_kel").delegate("#abahsoft_quick_search_kel","change",function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_subkel_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_barang_search_sub").html(data.list);
				$("#abahsoft_barang_search_brg").html("<select style='width:260px' id='abahsoft_barang_search_brg'><option id='abahsoft_barang_search_brg_nol' value='nol'>-- Barang Aset --</option></select>");
			}
		});
    });
	
	$("#abahsoft_barang_search_sub").delegate("#abahsoft_quick_search_sub","change",function () {
		if(addMode){$("#noreg").val(this.value);}
		$.ajax({
			type  : 'post',
			url   : base_url+'map/get_barang_list/'+this.value,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$("#abahsoft_barang_search_brg").html(data.list);
			}
		});
    });

	$("#abahsoft_barang_search_brg").delegate("#abahsoft_quick_search_brg","change",function () {
		$("#noreg").val(this.value);
    });
	
	//end searching barang
	
	
	//show skpd
	$.ajax({
		type:'post',
		url:base_url+'/map/getskpd/',
				 //data:'idkawasan='+idkawasan,
			success:function(data){
					   //do something if you want to with returned data
			//$("#daftarskpd").html(data);
			 $('#daftarskpd').html(data);
		}
    }); 	
	
	$('#daftarskpd').change(function() {
		//var kd_skpd = $('#filterskpd').val();
		//alert(kd_skpd);
		//if(kd_skpd!='00') {
			showQuickSearch();
		//}
		//else{
		//  $('#abahsoft_quick_search_result').html('<center><br/> Silahkan Pilih Satuan Kerja!</center>');
		//}
	});	
		//show skpd filter add
	$.ajax({
		type:'post',
		url:base_url+'/map/getskpdname/',
		    data:{name:'filterskpdadd',ids:'filterskpdadd'},
			success:function(data){
					   //do something if you want to with returned data
			//$("#daftarskpd").html(data);
			 $('#daftarskpdadd').html(data);
		}
    }); 	
	
	$('#daftarskpdadd').change(function() {
		//var kd_skpd = $('#filterskpd').val();
		//alert(kd_skpd);
		//if(kd_skpd!='00') {
			showAddSearch();
		//}
		//else{
		//  $('#abahsoft_quick_search_result').html('<center><br/> Silahkan Pilih Satuan Kerja!</center>');
		//}
	});

}); //end function

function closeRespondenDetail() {
	$('#abahsoft_content_responden_detail').fadeOut();
}

function closeAsetDetail() {
	$('#abahsoft_content_aset_detail').fadeOut();
}

function closeRespondenEdit() {
	$('#abahsoft_content_responden_edit').fadeOut();
}
function closeSurveyEdit() {
	$('#abahsoft_content_survey_edit').fadeOut();
}
function closeOptionAdd() {
	$('#abahsoft_content_kuisoner_option_add').fadeOut();
}
function closeUserAdd() {
	$('#abahsoft_content_add_pengguna').fadeOut();
}
function closeRespondenAdd() {
	$('#abahsoft_content_add_responden').fadeOut();
}



//faiz
//abahsoft_quick_search_result
function showQuickSearch(id) {
	clearOverlays();
	var kd_skpd = $('#filterskpdx').val();
	var gol = $('#abahsoft_quick_search_rw').val();
	var kw = $('#abahsoft_quick_search').val();
	var id = id
	alert(kd_skpd+"-"+gol+"-"+kw+"-"+id);
	$('#abahsoft_quick_search_result').html('');
	//if(kw!='') {
		$.ajax({
			type  : 'post',
			url   : base_url+'map/quick_search/'+gol,
			//data  : 'qs='+kw,
			data : {qs:kw,kd_skpd:kd_skpd,gol:gol,id:id},
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				var asets = data.responden;
				var legend = data.legend;
				$('#abahsoft_quick_search').animate({'width':'230px'}, 500);
				setTimeout(function() { $('#abahsoft_close_quick_search').fadeIn(); }, 600);
				$('.abahsoft_quick_search_list').hide();
				for(var i=0; i<pid.length; i++) {
					markers[pid[i]].setMap(null);
				}
				if(data.status) {
					//$('#abahsoft_quick_search_result').empty();
					//var bounds = new google.maps.LatLngBounds();
					//ShowLegend(rws,legend);
					for(var i=0; i<data.responden.length; i++) {
					    // showMarkers(map,asets,tematik)
						//var kdbarang = data.responden[i]['kd_brg'];
						if( (data.responden[i].lat !='') && (data.responden[i].lat !=null) && (data.responden[i].lat !='0') ){ 
						  var kdbarang = "'"+data.responden[i]['kd_brg']+"'";
						  var catikon = 'markers/'+data.responden[i]['kd_brg'].split(".").join("").substr(0,6)+'.png';
						  //asets[i]['kd_brg'].split(".").join("");
						
						  showMarker(map, data.responden[i],catikon);
						  //markers['rid_'+data.responden[i].data_id].setMap(map);
						  //bounds.extend(markers['rid_'+data.responden[i].data_id].getPosition());
						  var noregteks="'"+data.responden[i].no_reg+"'";
						  var idbarang = "'"+data.responden[i].id_barang+"'";
						  //$('#abahsoft_quick_search_result').append('<div class="abahsoft_quick_search_list"><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="showRespondenMap('+idbarang+')"></i> <span style="cursor: pointer;" onClick="showAsetDetail('+idbarang+','+kdbarang+');">'+data.responden[i].id_barang+'</span></div>');
						  //$('#abahsoft_quick_search_list_'+data.responden[i].data_id).show();
					  	  //alert(data.responden[i].lat);
						
							//alert(data.responden[i].lat);
						 //asli   $('#abahsoft_quick_search_result').append('<div class="abahsoft_quick_search_list"><i class="icon-target-2" style="font-size:8px;cursor:pointer;" onClick="showPencarianAsetMap('+idbarang+')"></i> <span style="cursor: pointer;" onClick="showAsetDetail('+idbarang+','+kdbarang+');">'+data.responden[i].no+' <br> '+data.responden[i].tgl_reg+' | '+data.responden[i].nilai+'<br>'+data.responden[i].kd_brg+' | '+data.responden[i].detail_brg+'</span></div>');
						    $('#abahsoft_quick_search_result').append('<div class="abahsoft_quick_search_list"><i class="icon-target-2" style="font-size:8px;cursor:pointer;" onClick="pointerdata('+idbarang+')"></i> <span style="cursor: pointer;" onClick="pointerdata('+idbarang+');">'+data.responden[i].no+' <br> '+data.responden[i].tgl_reg+' | '+data.responden[i].nilai+'<br>'+data.responden[i].kd_brg+' | '+data.responden[i].detail_brg+'</span></div>');
						  //$('#abahsoft_quick_search_list_'+i).show();

						}
							

					}
					
					
				var markericon;
				var maplegendhead='<nav><ul class="side-menu"><li class="title">Keterangan</li>';
				var maplegendbottom='</ul></nav>';			
				legendteks=maplegendhead;
				
				if((rws.substr(0,2)=='01')|(rws.substr(0,2)=='03')|(rws.substr(0,2)=='04')|(rws.substr(0,2)=='06')){
					for (var i = 0; i < legend.length; i++) {    
                       markericon = legend[i].kelompok;	
						markericon = markericon.split(".").join("");
						legendteks+='<li><a href="#">&nbsp;&nbsp;'+'<img src="markers/'+markericon+'.png" width="16px" height="16px" margin-right="5px">&nbsp;&nbsp;'+legend[i].nm_kelompok+'</a></li>';
					}
					
				}
				else{   
				   // legendteks+='halooo...';
				   for (var i = 0; i < asets.length; i++) {    
						legendteks+='<li><a href="#">&nbsp;&nbsp;'+'<img src="markers/'+(i+1)+'.png" width="16px" height="16px" margin-right="5px">&nbsp;&nbsp;'+asets[i]['nm_uskpd']+'</a></li>';
					}
				}
								
				legendteks+=maplegendbottom;
				$('#abahsoft_legend_tematik').html(legendteks);
				$('#map_legend').html(legendteks);
					//map.fitBounds(bounds);

				} else {

					$('#abahsoft_quick_search_result').html('<center><br/>Data Aset dengan kata kunci <i>"<b>'+kw+'</b>"</i> tidak ditemukan, silahkan masukkan kata kunci yang lain!</center>');
					
				}
			}
		});

	//}
}


function pointerdata(id){
	alert("masuk");
	clearOverlays();
	var kd_skpd = $('#filterskpdx').val();
	var gol = $('#abahsoft_quick_search_rw').val();
	var kw = $('#abahsoft_quick_search').val();
	var id = id
	$('#abahsoft_quick_search_result').html('');
		$.ajax({
			type  : 'post',
			url   : base_url+'map/quick_search/'+gol,
			data : {qs:kw,kd_skpd:kd_skpd,gol:gol,id:id},
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				var asets = data.responden;
				var legend = data.legend;
				$('#abahsoft_quick_search').animate({'width':'230px'}, 500);
				setTimeout(function() { $('#abahsoft_close_quick_search').fadeIn(); }, 600);
				$('.abahsoft_quick_search_list').hide();
				for(var i=0; i<pid.length; i++) {
					markers[pid[i]].setMap(null);
				}
				//if(data.status) {
				/* 	for(var i=0; i<data.responden.length; i++) {
						if( (data.responden[i].lat !='') && (data.responden[i].lat !=null) && (data.responden[i].lat !='0') ){ 
						  var kdbarang = "'"+data.responden[i]['kd_brg']+"'";
						  var catikon = 'markers/'+data.responden[i]['kd_brg'].split(".").join("").substr(0,6)+'.png';
						  showMarker(map, data.responden[i],catikon);
						  var noregteks="'"+data.responden[i].no_reg+"'";
						  var idbarang = "'"+data.responden[i].id_barang+"'";
							$('#abahsoft_quick_search_result').append('<div class="abahsoft_quick_search_list"><i class="icon-target-2" style="font-size:8px;cursor:pointer;" onClick="showQuickSearch('+idbarang+')"></i> <span style="cursor: pointer;" onClick="showQuickSearch('+idbarang+');">'+data.responden[i].no+' <br> '+data.responden[i].tgl_reg+' | '+data.responden[i].nilai+'<br>'+data.responden[i].kd_brg+' | '+data.responden[i].detail_brg+'</span></div>');
						}
					} *//* 
					var markericon;
					var maplegendhead='<nav><ul class="side-menu"><li class="title">Keterangan</li>';
					var maplegendbottom='</ul></nav>';			
					legendteks=maplegendhead;
						if((rws.substr(0,2)=='01')|(rws.substr(0,2)=='03')|(rws.substr(0,2)=='04')|(rws.substr(0,2)=='06')){
							for (var i = 0; i < legend.length; i++) {    
							   markericon = legend[i].kelompok;	
								markericon = markericon.split(".").join("");
								legendteks+='<li><a href="#">&nbsp;&nbsp;'+'<img src="markers/'+markericon+'.png" width="16px" height="16px" margin-right="5px">&nbsp;&nbsp;'+legend[i].nm_kelompok+'</a></li>';
							}
						}else{   
						   for (var i = 0; i < asets.length; i++) {    
								legendteks+='<li><a href="#">&nbsp;&nbsp;'+'<img src="markers/'+(i+1)+'.png" width="16px" height="16px" margin-right="5px">&nbsp;&nbsp;'+asets[i]['nm_uskpd']+'</a></li>';
							}
						}
										
						legendteks+=maplegendbottom;
						$('#abahsoft_legend_tematik').html(legendteks);
						$('#map_legend').html(legendteks);
				} else {
					$('#abahsoft_quick_search_result').html('<center><br/>Data Aset dengan kata kunci <i>"<b>'+kw+'</b>"</i> tidak ditemukan, silahkan masukkan kata kunci yang lain!</center>');
				} */
			}
		});
}
	//show Addbarang
function showAddBarang() {
	//alert("ShowAddBarang");
	var rws = $('#abahsoft_barang_search_rw').val();
	var kw = $('#abahsoft_barang_search').val();
	
	//alert(rws); //alert(kw);
	$('#abahsoft_barang_search_result').html('');
	//if(kw!='') {
		$.ajax({
			type  : 'post',
			url   : base_url+'map/barang_search/'+rws,
			data  : 'qs='+kw,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$('#abahsoft_barang_search').animate({'width':'230px'}, 500);
				setTimeout(function() { $('#abahsoft_close_barang_search').fadeIn(); }, 600);
				$('.abahsoft_barang_search_list').hide();
				for(var i=0; i<pid.length; i++) {
					markers[pid[i]].setMap(null);
				}
				if(data.status) {
					//$('#abahsoft_quick_search_result').empty();
					//var bounds = new google.maps.LatLngBounds();
					for(var i=0; i<data.responden.length; i++) {
					    // showMarkers(map,asets,tematik)
						//var kdbarang = data.responden[i]['kd_brg'];
						var kdbarang = "'"+data.responden[i]['kd_brg']+"'";
						var catikon = 'markers/'+data.responden[i]['kd_brg'].substr(0,6)+'.png';
						showMarker(map, data.responden[i],catikon);
						//markers['rid_'+data.responden[i].data_id].setMap(map);
						//bounds.extend(markers['rid_'+data.responden[i].data_id].getPosition());
						var noregteks="'"+data.responden[i].id_barang+"'";
						$('#abahsoft_barang_search_result').append('<div class="abahsoft_barang_search_list"><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="addIdBarangMap('+noregteks+','+kdbarang+')"></i> <span style="cursor: pointer;" onClick="showBarangDetail('+noregteks+','+kdbarang+');">'+data.responden[i].no+' <br> '+data.responden[i].tgl_reg+' | '+data.responden[i].nilai+'<br>'+data.responden[i].kd_brg+' | '+data.responden[i].detail_brg+'</span></div>');
						$('#abahsoft_barang_search_list_'+data.responden[i].data_id).show();
					}
					//map.fitBounds(bounds);

				} else {

					$('#abahsoft_barang_search_result').html('<center><br/>Data dengan kata kunci <i>"<b>'+kw+'</b>"</i> tidak ditemukan, silahkan masukkan kata kunci yang lain!</center>');
					
				}
			}
		});
	//}
}

//end of show AddBarang

function showAddSearch() {
   // alert("ok");
    clearOverlays();
	var rws = $('#abahsoft_add_search_rw').val();
	var kw = $('#abahsoft_add_search').val();
    var kd_skpd = $('#filterskpdadd').val();
	//alert(rws); alert(kw);
	$('#abahsoft_add_search_result').html('');
	//if(kw!='') {
		$.ajax({
			type  : 'post',
			url   : base_url+'map/add_search/'+rws,
			 data : {qs:kw,kd_skpd:kd_skpd},
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				$('#abahsoft_add_search').animate({'width':'230px'}, 500);
				setTimeout(function() { $('#abahsoft_close_add_search').fadeIn(); }, 600);
				$('.abahsoft_add_search_list').hide();
				for(var i=0; i<pid.length; i++) {
					markers[pid[i]].setMap(null);
				}
				if(data.status) {
					
					//$('#abahsoft_quick_search_result').empty();
					//var bounds = new google.maps.LatLngBounds();
					for(var i=0; i<data.responden.length; i++) {
	                      var kdbarang = "'"+data.responden[i]['kd_brg']+"'";
						  var catikon = 'markers/'+data.responden[i]['kd_brg'].split(".").join("").substr(0,6)+'.png';
						  //asets[i]['kd_brg'].split(".").join("");
						
						  showMarker(map, data.responden[i],catikon);
						  //markers['rid_'+data.responden[i].data_id].setMap(map);
						  //bounds.extend(markers['rid_'+data.responden[i].data_id].getPosition());
						var noskpd="'"+data.responden[i].kd_skpd+"'";
						var noregteks="'"+data.responden[i].no_reg+"'";
						var idbarang = "'"+data.responden[i].id_barang+"'";
						var kdbarang = "'"+data.responden[i].kd_brg+"'";
						var detailbrg = "'"+data.responden[i].detail_brg+"'";
						var alamat = "'"+data.responden[i].alamat1+"'";
						var nilai = "'"+data.responden[i].nilai+"'";
						 
						//$('#abahsoft_add_search_result').append('<div class="abahsoft_add_search_list"><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="addRespondenMap('+noregteks+','+kdbarang+')"></i> <span style="cursor: pointer;" onClick="showAsetDetail('+noregteks+','+kdbarang+');">'+data.responden[i].no_reg+'</span></div>');
						//tambah value nilai untuk di tampilkan - ikram 30 oktober 2015
						$('#abahsoft_add_search_result').append('<div class="abahsoft_add_search_list"><i class="icon-target-2" style="font-size:12px;cursor:pointer;" onClick="addRespondenMap('+noregteks+','+idbarang+','+kdbarang+','+detailbrg+','+alamat+','+nilai+')"></i> <span style="cursor: pointer;" onClick="showAsetDetail('+idbarang+','+kdbarang+');">'+data.responden[i].no+' <br> '+data.responden[i].tgl_reg+' | '+data.responden[i].nilai+'<br>'+data.responden[i].kd_brg+' | '+data.responden[i].detail_brg+'</span></div>');
						//end of ikram tambah
						$('#abahsoft_add_search_list_'+data.responden[i].data_id).show();
					}
					//map.fitBounds(bounds);

				} else {

					$('#abahsoft_add_search_result').html('<center><br/>Data responden dengan kata kunci <i>"<b>'+kw+'</b>"</i> tidak ditemukan, silahkan masukkan kata kunci yang lain!</center>');
					
				}
			}
		});
	//}
}

function showRespondenMap(r_id) {
   //alert(r_id);
   //var ridteks='rid_'+"'"+r_id+"'";
	//$('#abahsoft_menu_petatematik').click();
	for(var i=0; i<pid.length; i++) {
		markers[pid[i]].setMap(null);
	}
	//var bounds = new google.maps.LatLngBounds();
	markers[pid[pid.length-1]].setMap(map);
	//markers[ridteks].setMap(map);
	//bounds.extend(markers['rid_'+r_id].getPosition());
	//map.fitBounds(bounds);
}

function showPencarianAsetMap(id_barang) {
	/*
	for(var i=0; i<pid.length; i++) {
		markers[pid[i]].setMap(null);
	}
	*/
			clearOverlays();
    for(var i=0; i<pid.length; i++) {
	    // alert('pid='+pid[i]);
	    //alert('pid='+markers[pid[i]]); 
		var rid='rid_'+id_barang;
		
		if(pid[i]==rid){
			//alert('pid='+pid[i]);
			markers[pid[i]].setMap(map);
			//map.setCenter(markers.getPosition());
			//ikram 29 oktober 2015
			map.panTo(markers[pid[i]].getPosition());
			//end of ikram update
		}
		else{
		    markers[pid[i]].setMap(null);
		}
	}
	
	//var bounds = new google.maps.LatLngBounds();
	//pid[pid.length] = 'rid_'+aset['id_barang'];
	//markers[pid[pid.length-1]].setMap(map);
	 
	//alert('idx='+idx);
	//markers[idx].setMap(map);
	//55.06.01.01.2003.0311010101 .000001 
}

//ikram edit 30 oktober 2015 - tambah val nilai
function addRespondenMap(r_id,id_brg,kd_brg,detail_brg, alamat, nilai) {
   document.getElementById("noreg").value=r_id;
   document.getElementById("idbarang").value=id_brg;
   document.getElementById("kdbrg").value=kd_brg;
   document.getElementById("detailbrg").value=detail_brg;
   document.getElementById("alamat").value=alamat;
   document.getElementById("nilai").value=nilai;
//end of ikram tambah
}

function addRespondenMapBackup(r_id,kd_brg) {
   document.getElementById("noreg").value=r_id;
   document.getElementById("kdbrg").value=kd_brg;
}

function addIdBarangMap(r_id,kd_brg) {
   document.getElementById("BlitzMapInfoWindow_id_barang").value=r_id;
   document.getElementById("BlitzMapInfoWindow_kdbrg").value=kd_brg;
}

//function showRespondenDetil(r_id) {
function showRespondenDetil(r_id,kdbrg) {
    //alert(r_id);alert(kdbrg);
	infowindow.close();
	$('#abahsoft_preload_responden_detail').show();
	$('#abahsoft_loaded_responden_detail').hide();
	$('#abahsoft_content_responden_detail').stop().fadeIn();
	$.ajax({
		type  : 'post',
		url   : base_url+'map/responden',
		//data  : 'data_id='+r_id, //{gol:gol,noreg:noreg,kdbrg:kdbrg,alamat1:alamat1,alamat2:alamat2,lat:lat,lon:lon,nodok:nodok,noser:noser,tglser:tglser}
		data  : {data_id:r_id,kdbrg:kdbrg},
		cache : false,
		success: function(html) {
			if(html!='') {
				$('#abahsoft_preload_responden_detail').hide();
				$('#abahsoft_loaded_responden_detail').show();
				$('#abahsoft_table_responden_detail tbody').html(html);
			}
		}
	});
}

function showJalanDetil(id_barang,kdbrg) {
    //alert(r_id);
	//alert(id_barang);
	//alert(kdbrg);
//	alert(id_barang);
	//alert(datalengkap['noreg']);
	//alert(datalengkap['kdbrg']);
	infowindow.close();
	$('#abahsoft_preload_responden_detail').show();
	$('#abahsoft_loaded_responden_detail').hide();
	$('#abahsoft_content_responden_detail').stop().fadeIn();
	$.ajax({
		type  : 'post',
		url   : base_url+'map/showjalan',
		//data  : 'data_id='+r_id, //{gol:gol,noreg:noreg,kdbrg:kdbrg,alamat1:alamat1,alamat2:alamat2,lat:lat,lon:lon,nodok:nodok,noser:noser,tglser:tglser}
		data  : {id_barang:id_barang,kdbrg:kdbrg},
		//data  : {noreg:noreg,kdbrg:kdbrg},
		cache : false,
		success: function(html) {
			if(html!='') {
				$('#abahsoft_preload_responden_detail').hide();
				$('#abahsoft_loaded_responden_detail').show();
				$('#abahsoft_table_responden_detail tbody').html(html);
			}
		}
	});
}

function showAsetDetail(r_id,kdbrg) {
    //alert(r_id);alert(kdbrg);
	//infowindow.close();
	$('#abahsoft_preload_aset_detail').show();
	$('#abahsoft_loaded_aset_detail').hide();
	$('#abahsoft_content_aset_detail').stop().fadeIn();
	$.ajax({
		type  : 'post',
		url   : base_url+'map/responden',
		//data  : 'data_id='+r_id, //{gol:gol,noreg:noreg,kdbrg:kdbrg,alamat1:alamat1,alamat2:alamat2,lat:lat,lon:lon,nodok:nodok,noser:noser,tglser:tglser}
		data  : {data_id:r_id,kdbrg:kdbrg},
		cache : false,
		success: function(html) {
			if(html!='') {
				$('#abahsoft_preload_aset_detail').hide();
				$('#abahsoft_loaded_aset_detail').show();
				$('#abahsoft_table_aset_detail tbody').html(html);
			}
		}
	});
}



function showBarangDetail(r_id,kdbrg) {
    //alert(r_id);alert(kdbrg);
	//infowindow.close();
	$('#abahsoft_preload_aset_detail').show();
	$('#abahsoft_loaded_aset_detail').hide();
	$('#abahsoft_content_aset_detail').stop().fadeIn();
	$.ajax({
		type  : 'post',
		url   : base_url+'map/idbarangview',
		//data  : 'data_id='+r_id, //{gol:gol,noreg:noreg,kdbrg:kdbrg,alamat1:alamat1,alamat2:alamat2,lat:lat,lon:lon,nodok:nodok,noser:noser,tglser:tglser}
		data  : {data_id:r_id,kdbrg:kdbrg},
		cache : false,
		success: function(html) {
			if(html!='') {
				$('#abahsoft_preload_aset_detail').hide();
				$('#abahsoft_loaded_aset_detail').show();
				$('#abahsoft_table_aset_detail tbody').html(html);
			}
		}
	});
}


function showAsetUnitDetil(kdskpd,kdbidang) {
    //alert(kdskpd);
	//alert(kdbidang);
	infowindow.close();
	$('#abahsoft_preload_responden_detail').show();
	$('#abahsoft_loaded_responden_detail').hide();
	$('#abahsoft_content_responden_detail').stop().fadeIn();
	$.ajax({
		type  : 'post',
		url   : base_url+'map/get_asetunit',
		//data  : 'data_id='+r_id, //{gol:gol,noreg:noreg,kdbrg:kdbrg,alamat1:alamat1,alamat2:alamat2,lat:lat,lon:lon,nodok:nodok,noser:noser,tglser:tglser}
		data  : {kdskpd:kdskpd,kdbidang:kdbidang},
		cache : false,
		success: function(html) {
			if(html!='') {
				$('#abahsoft_preload_responden_detail').hide();
				$('#abahsoft_loaded_responden_detail').show();
				$('#abahsoft_table_responden_detail tbody').html(html);
			}
		}
	});
}




function showUnitDetil(id,category) {
	infowindow.close();
	$('#abahsoft_preload_responden_detail').show();
	$('#abahsoft_loaded_responden_detail').hide();
	$('#abahsoft_content_responden_detail').stop().fadeIn();
	$.ajax({
		type  : 'post',
		url   : base_url+'map/unit/',
		data  : {id:id,category:category},
		cache : false,
		success: function(html) {
			if(html!='') {
				$('#abahsoft_preload_responden_detail').hide();
				$('#abahsoft_loaded_responden_detail').show();
				$('#abahsoft_table_responden_detail tbody').html(html);
			}
		}
	});
}


function showRespondenDetil_reload(r_id) {
	$.ajax({
		type  : 'post',
		url   : base_url+'map/responden',
		data  : 'data_id='+r_id,
		cache : false,
		success: function(html) {
			if(html!='') {
				$('#abahsoft_table_responden_detail tbody').html(html);
			}
		}
	});
}

function showRespondenEdit(r_id) {
	$('#abahsoft_preload_responden_edit').show();
	$('#abahsoft_loaded_responden_edit').hide();
	$('#abahsoft_content_responden_edit').stop().fadeIn();
	$.ajax({
		type  : 'post',
		url   : base_url+'responden/responden_edit',
		data  : 'data_id='+r_id,
		cache : false,
		success: function(html) {
			if(html!='') {
				$('#abahsoft_preload_responden_edit').hide();
				$('#abahsoft_loaded_responden_edit').show();
				$('#abahsoft_table_responden_edit').html(html);
			}
		}
	});
}


function showOptionAdd(id) {
	resetOnReload();
	$('#abahsoft_preload_option_add').hide();
	$('#abahsoft_loaded_option_add').show();
	$('#abahsoft_content_kuisoner_option_add').stop().fadeIn();
	if(id>0) {
		$('#abahsoft_kuisoner_kuisoner_savebtn').hide();
		$('#abahsoft_kuisoner_kuisoner_editbtn').show();
		$('#abahsoft_kadd_pilihan').hide();
		$.ajax({
			type  : 'post',
			url   : base_url+'kuisoner/get_kuisoner/'+id,
			cache : false,
			success: function(datas) {
				var data = $.parseJSON(datas);
				if(data.status) {
					$('#kadd_id').val(data.pertanyaan['kuisoner_group_id']);
					$('#kadd_group').val(data.pertanyaan['kuisoner_group_id']).change();
					$('#kadd_pertanyaan').val(data.pertanyaan['kuisoner_pertanyaan']);
					if(data.pertanyaan['kuisoner_rekap']==1) {
						$('#kadd_isrekap').prop({'checked':'checked'});
						$('#kadd_box_rekap_nama').show();
						$('#kadd_rekap_nama').val(data.pertanyaan['kuisoner_rekap_nama']);
					}
					$('.abahsoft_form_option').remove();
				} else {
					closeOptionAdd();
				}
			}
		});
	}
}

function showPenggunaAdd() {
	$('#uadd_id, #uadd_name, #uadd_username, #uadd_password_1, #uadd_password_2, #uadd_kelurahan').val('');
	$('#abahsoft_preload_adduser').hide();
	$('.abahsoft_form_error_display').html('');
	$('#abahsoft_loaded_adduser').show();
	$('#abahsoft_content_add_pengguna').stop().fadeIn();
}

function showPenggunaEdit(pid) {
	$('#uadd_id, #uadd_name, #uadd_username, #uadd_password_1, #uadd_password_2, #uadd_kelurahan').val('');
	$('.abahsoft_form_error_display').html('');
	$('#abahsoft_preload_adduser').show();
	$('#abahsoft_loaded_adduser').hide();
	$('#abahsoft_content_add_pengguna').stop().fadeIn();

	$.ajax({
		type  : 'post',
		url   : base_url+'setting/get_user/'+pid,
		cache : false,
		success: function(html) {
			var datas = $.parseJSON(html);
			if(datas.status) {
				$('#uadd_id').val(datas['datas'].pengguna_id+'-'+datas['datas'].pengguna_pegawai_id).attr({'error':0});
				$('#uadd_name').val(datas['datas'].pegawai_nama_depan).attr({'error':0});
				$('#uadd_username').val(datas['datas'].pengguna_nama).attr({'error':0,'lastdata':datas['datas'].pengguna_nama});
				$('#uadd_password_1').val('').attr({'error':0});
				$('#uadd_password_2').val('').attr({'error':0});
				$('#uadd_kelurahan').val(datas['datas'].pengguna_kelurahan_id).attr({'error':0});

				$('#abahsoft_preload_adduser').hide();
				$('#abahsoft_loaded_adduser').show();
			}
		}
	});
}

function showAllMarkers() {
	var bounds = new google.maps.LatLngBounds();
	for(var i=0; i<pid.length; i++) {
		markers[pid[i]].setMap(map);
		bounds.extend(markers[pid[i]].getPosition());
	}
	map.fitBounds(bounds);
}

function clearAllMarkers() {
	//var bounds = new google.maps.LatLngBounds();
	////for(var i=0; i<pid.length; i++) {
		////markers[pid[i]].setMap(null);
		//bounds.extend(markers[pid[i]].getPosition());
	////}
	 clearOverlays();
	//map.fitBounds(bounds);
	 $('#abahsoft_quick_search_result').html('');
	 $('#abahsoft_add_search_result').html('');
	 //$('#abahsoft_quick_search_barang_result').html('');
}

function showRespondenAdd() {
	$('#abahsoft_preload_add_responden').show();
	$('#abahsoft_loaded_add_responden').hide();
	$('#abahsoft_content_add_responden').stop().fadeIn();
	$.ajax({
		type  : 'get',
		url   : base_url+'responden/responden_add',
		cache : false,
		success: function(html) {
			if(html!='') {
				$('#abahsoft_preload_add_responden').hide();
				$('#abahsoft_loaded_add_responden').show();
				$('#abahsoft_left_content_add_responden_html').html(html);
			}
		}
	});
}
//faiz
function onMapClick(activeright) {
    clearOverlays();
    $('.abahsoft_left_content').stop().fadeOut(1200);
	$('#abahsoft_quick_search').stop().fadeIn(200);   
	if(activeright!='abahsoft_right_content_pemetaan') {
		if(activeright=='abahsoft_right_content_petatematik'){
			$( '#'+activeright ).animate({width: "0px",margin:"0 -10px 0 0"}, 200);
		}else if(activeright!='abahsoft_right_content_pemetaan'){
			$( '#'+activeright ).animate({width: "0px"}, 200);
		}
		$( "#abahsoft_right_content_pemetaan" ).animate({width: "25%"}, 200);
		//$('#abahsoft_right_content_pemetaan').css({right:0,'z-index':29});        
		// $('#'+activeright).animate({right:-300}, 500);
		setTimeout(function() {
			$('#abahsoft_right_content_pemetaan').css({'z-index':30});
			$('#abahsoft_active_right').val('abahsoft_right_content_pemetaan');
		}, 500);
	}
	showQuickSearch();
	//google.maps.event.clearListeners(shape, 'click');
	addMode = false;
	printMode = false;
}

function onSettingsClick(activeright) {
	$('.abahsoft_left_content').stop().fadeOut(1200);
	$('#abahsoft_content_pengaturan').stop().fadeIn();
	if(activeright!='abahsoft_right_content_pengaturan') {
		$('#abahsoft_right_content_pengaturan').css({right:0,'z-index':29});
		$('#'+activeright).animate({right:-300}, 500);
		setTimeout(function() {
			$('#abahsoft_right_content_pengaturan').css({'z-index':30});
			$('#abahsoft_active_right').val('abahsoft_right_content_pengaturan');
		}, 500);
	}
	google.maps.event.clearListeners(shape, 'click');
	addMode = false;
	printMode = false;
}

function onAddClick(activeright) {
	$('.abahsoft_left_content').stop().fadeOut(1200);
	$('#abahsoft_quick_search').stop().fadeOut(200);   
	if(activeright!='abahsoft_right_content_addpoint') {
		if(activeright=='abahsoft_right_content_petatematik'){
			$( '#'+activeright ).animate({width: "0px",margin:"0 -10px 0 0"}, 200);
		}else if(activeright!='abahsoft_right_content_addpoint'){
			$( '#'+activeright ).animate({width: "0px"}, 200);
		}
		$( "#abahsoft_right_content_addpoint" ).animate({width: "25%"}, 200);
		// $('#abahsoft_right_content_addpoint').css({right:0,'z-index':29});  
		// $('#'+activeright).animate({right:-300}, 500);
		setTimeout(function() {
			$('#abahsoft_right_content_addpoint').css({'z-index':30});
			$('#abahsoft_active_right').val('abahsoft_right_content_addpoint');
		}, 500);
	}
		   
	//google.maps.event.addListener(shape, "click", function (event) 
	google.maps.event.addListener(map, "click", function (event) 	
	{
		marker = new google.maps.Marker({
			position: event.latLng,
			map: map
		});
		showData(event.latLng);				
	});
	addMode = true;
	printMode = false;
}

function onTematikClick(activeright) {
	//if($('#abahsoft_left_content_data_html').html()=='') {
		//$('#abahsoft_tematik_'+$('#abahsoft_right_petatematik_menu_inload').val()).click();
	//}
	$('.abahsoft_left_content').stop().fadeOut(1200);
	 
	//$('#abahsoft_content_rekapitulasi').stop().fadeIn();
	if(activeright!='abahsoft_right_content_petatematik') {
		$( '#'+activeright ).animate({width: "0px"}, 200);
		$( "#abahsoft_right_content_petatematik" ).css("margin", "0px");
		$( "#abahsoft_right_content_petatematik" ).animate({width: "22%",margin: "0px"}, 200);
		//$('#abahsoft_right_content_petatematik').css({right:0,'z-index':29});
		//$('#'+activeright).animate({right:-300}, 500);
		setTimeout(function() {
			$('#abahsoft_right_content_petatematik').css({'z-index':30});
			$('#abahsoft_active_right').val('abahsoft_right_content_petatematik');
		}, 500);
	}
	google.maps.event.clearListeners(shape, 'click');
	addMode = false;
	printMode = false;
}

function onPrintClick(activeright) {
	$('#abahsoft_tematik_'+$('#abahsoft_right_petatematik_menu_inload').val()).click();
	$('.abahsoft_left_content').stop().fadeOut(1200);
	if(activeright!='abahsoft_right_content_petatematik') {
		$( '#'+activeright ).animate({width: "0px"}, 200);
		$( "#abahsoft_right_content_petatematik" ).css("margin", "0px");
		$( "#abahsoft_right_content_petatematik" ).animate({width: "22%",margin: "0px"}, 200);
		// $('#abahsoft_right_content_petatematik').css({right:0,'z-index':29});
		// $('#'+activeright).animate({right:-300}, 500);
		setTimeout(function() {
			$('#abahsoft_right_content_petatematik').css({'z-index':30});
			$('#abahsoft_active_right').val('abahsoft_right_content_petatematik');
		}, 500);
	}
	//google.maps.event.clearListeners(shape, 'click');
	addMode = false;
	printMode = true;
}
function onEditPetaKawasanClick(activeright) {
	$('.abahsoft_left_content').stop().fadeOut(1200);
	$('#abahsoft_right_content_editpetakawasan').stop().fadeIn();
	if(activeright!='abahsoft_right_content_editpetakawasan') {
		$( '#'+activeright ).animate({width: "0px"}, 200);
		$( "#abahsoft_right_content_editpetakawasan" ).css("margin", "0px");
		$( "#abahsoft_right_content_editpetakawasan" ).animate({width: "22%",margin: "0px"}, 200);
		//$('#abahsoft_right_content_responden').css({right:0,'z-index':29});
		//$('#'+activeright).animate({right:-300}, 500);
		setTimeout(function() {
			$('#abahsoft_right_content_editpetakawasan').css({'z-index':30});
			$('#abahsoft_active_right').val('abahsoft_right_content_editpetakawasan');
		}, 500);
	}
}

function onPetaKawasanClick(activeright) {
	$('.abahsoft_left_content').stop().fadeOut(1200);
	$('#abahsoft_content_content_petakawasan').stop().fadeIn();
	if(activeright!='abahsoft_right_content_petakawasan') {
		$( '#'+activeright ).animate({width: "0px"}, 200);
		$( "#abahsoft_right_content_petakawasan" ).css("margin", "0px");
		$( "#abahsoft_right_content_petakawasan" ).animate({width: "22%",margin: "0px"}, 200);
		//$('#abahsoft_right_content_responden').css({right:0,'z-index':29});
		//$('#'+activeright).animate({right:-300}, 500);
		setTimeout(function() {
			$('#abahsoft_right_content_petakawasan').css({'z-index':30});
			$('#abahsoft_active_right').val('abahsoft_right_content_petakawasan');
		}, 500);
	}
}

function onPetaJalanClick(activeright) {
	$('.abahsoft_left_content').stop().fadeOut(1200);
	$('#abahsoft_content_content_petakawasan').stop().fadeIn();
	if(activeright!='abahsoft_right_content_petakawasan') {
		$( '#'+activeright ).animate({width: "0px"}, 200);
		$( "#abahsoft_right_content_petakawasan" ).css("margin", "0px");
		$( "#abahsoft_right_content_petakawasan" ).animate({width: "22%",margin: "0px"}, 200);
		//$('#abahsoft_right_content_responden').css({right:0,'z-index':29});
		//$('#'+activeright).animate({right:-300}, 500);
		setTimeout(function() {
			$('#abahsoft_right_content_petakawasan').css({'z-index':30});
			$('#abahsoft_active_right').val('abahsoft_right_content_petakawasan');
		}, 500);
	}
}

function onPetaDrainaseClick(activeright) {
	$('.abahsoft_left_content').stop().fadeOut(1200);
	$('#abahsoft_content_content_petakawasan').stop().fadeIn();
	if(activeright!='abahsoft_right_content_petakawasan') {
		$( '#'+activeright ).animate({width: "0px"}, 200);
		$( "#abahsoft_right_content_petakawasan" ).css("margin", "0px");
		$( "#abahsoft_right_content_petakawasan" ).animate({width: "22%",margin: "0px"}, 200);
		//$('#abahsoft_right_content_responden').css({right:0,'z-index':29});
		//$('#'+activeright).animate({right:-300}, 500);
		setTimeout(function() {
			$('#abahsoft_right_content_petakawasan').css({'z-index':30});
			$('#abahsoft_active_right').val('abahsoft_right_content_petakawasan');
		}, 500);
	}
}

function refreshTable() {
	$('.paginate_active').click();
}

function openInNewTab(url) {
	window.open(url, 'unduh');
}

function reloadKuisoner() {
	$('#abahsoft_list_datakuisoner_option').click();
}


	function delete_elem(thiselem) {
		var grandma = thiselem.parent().parent();
		thiselem.parent().remove();
		var thisstatus = thiselem.parent().attr('ref');
		if(thisstatus=='child') {
			if(grandma.find('.abahsoft_form_option').length==1) {
				grandma.attr({added:0}).hide();
				grandma.prev().show();
				grandma.prev().prev().show();
			}
			grandma.children('.abahsoft_form_option').last().prev().children('input').focus();
		} else if(thisstatus=='parent') {
			if($('#abahsoft_option_elem').children('.abahsoft_form_option').length==2) {
				insert_before_parent($('#abahsoft_form_option_add_elem_parent'));
			}
			$('#abahsoft_form_option_add_elem_parent').prev().children('input').focus();
		}
		renumbering_answer();
	}

	
	

function saveResponden() {
  //var gol = document.getElementById("abahsoft_quick_search_rw").value;
  var noreg = escape(document.getElementById("add_noreg_brg").value);
  var kdbrg = document.getElementById("add_kd_brg").value;
  var gol = kdbrg.substr(0,2);
  //alert(gol);
  //var alamat1 = document.getElementById("add_alamat_brg").value;
 // var alamat2 = document.getElementById("add_alamat2_brg").value;
  var lat = document.getElementById("add_lat").value;
  var lon = document.getElementById("add_lon").value;
  //var nodok = document.getElementById("add_nodok_brg").value;
 // var noser = document.getElementById("add_noser_brg").value;
  //var tglser = document.getElementById("add_tglser_brg").value;
	//$('#abahsoft_preload_responden_detail').show();
	//$('#abahsoft_loaded_responden_detail').hide();
	//$('#abahsoft_content_responden_detail').stop().fadeIn();
	$.ajax({
		type  : 'post',
		url   : base_url+'map/save_responden',
		//data  : {gol:gol,noreg:noreg,kdbrg:kdbrg,alamat1:alamat1,alamat2:alamat2,lat:lat,lon:lon,nodok:nodok,noser:noser,tglser:tglser},
		data  : {gol:gol,noreg:noreg,lat:lat,lon:lon},
		cache : false,
		success: function(html) {
			$('#abahsoft_loaded_responden_detail').hide();
			$('#abahsoft_content_responden_detail').hide();
			alert('Data Berhasil Disimpan');
		}
	});
}
function saveBarang() {
  //var gol = document.getElementById("abahsoft_quick_search_rw").value;
  var noreg = escape(document.getElementById("add_noreg_brg").value);
  var idbarang = escape(document.getElementById("add_id_barang").value);
 // var idbarang = 
  //var idbarang = "'"+document.getElementById("add_id_barang").value+"'";
  var kdbrg = document.getElementById("add_kd_brg").value;
  var detailbrg = document.getElementById("add_detail_brg").value;
  var alamat = document.getElementById("add_alamat").value;
  var gol = kdbrg.substr(0,2);
  alert(gol);alert(idbarang); 

  var lat = document.getElementById("add_lat").value;
  var lon = document.getElementById("add_lon").value;
 
	$.ajax({
		type  : 'post',
		url   : base_url+'map/save_barang',
		//data  : {gol:gol,noreg:noreg,kdbrg:kdbrg,alamat1:alamat1,alamat2:alamat2,lat:lat,lon:lon,nodok:nodok,noser:noser,tglser:tglser},
		//data  : {gol:gol,noreg:noreg,idbarang:idbarang,kdbrg:kdbrg,detailbrg:detailbrg,alamat:alamat,lat:lat,lon:lon},
		data  : {gol:gol,idbarang:idbarang,lat:lat,lon:lon},
		cache : false,
		success: function(html) {
			$('#abahsoft_loaded_responden_detail').hide();
			$('#abahsoft_content_responden_detail').hide();
			alert('Data Berhasil Disimpan');
		}
	});
}
function saveBarangJS() {
  //var gol = document.getElementById("abahsoft_quick_search_rw").value;
      var noreg = escape(document.getElementById("noreg").value);
	  var idbarang = document.getElementById("idbarang").value;
	  var kdbrg = escape(document.getElementById("kdbrg").value);
	  var detailbrg = escape(document.getElementById("detailbrg").value);
	  var alamat = escape(document.getElementById("alamat").value);
	    
      var latlng = marker.getPosition();
      var lat = marker.getPosition().lat();
      var lon = marker.getPosition().lng();

  var gol = kdbrg.substr(0,2);
  //alert(gol);alert(idbarang); 
   infowindow.close();
 
	$.ajax({
		type  : 'post',
		url   : base_url+'map/save_barang',
		//data  : {gol:gol,noreg:noreg,kdbrg:kdbrg,alamat1:alamat1,alamat2:alamat2,lat:lat,lon:lon,nodok:nodok,noser:noser,tglser:tglser},
		//data  : {gol:gol,noreg:noreg,idbarang:idbarang,kdbrg:kdbrg,detailbrg:detailbrg,alamat:alamat,lat:lat,lon:lon},
		data  : {gol:gol,idbarang:idbarang,lat:lat,lon:lon},
		cache : false,
		success: function(html) {
			$('#abahsoft_loaded_responden_detail').hide();
			$('#abahsoft_content_responden_detail').hide();
			alert('Data Berhasil Disimpan');
		}
	});
}