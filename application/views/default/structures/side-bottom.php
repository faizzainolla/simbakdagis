	</div>
	<div class="abahsoft_news_ticker_back"></div>
	
	 
	<div class="abahsoft_lokasi">	    
	        &nbsp;&nbsp;&nbsp;&nbsp;Posisi: <div class="data_koordinat" id="koordinat"></div>	
			
	</div>
	
    	
 
	<div class="abahsoft_news_ticker_front">
			<div>
				Pencarian :
				<input type="text" id="radd_lookup_location" value="" style="width:20%;" placeholder="Cari Lokasi / Koordinat">			
	      </div>
	
	</div>
	
<script type="text/javascript">
$(function() {
		var input = document.getElementById('radd_lookup_location');
		var searchBox = new google.maps.places.SearchBox(input);
		
		google.maps.event.addListener(searchBox, 'places_changed', function() {
			var places = searchBox.getPlaces();
			var bounds = new google.maps.LatLngBounds();
			bounds.extend(places[0].geometry.location);
			map.fitBounds(bounds);
		});

		google.maps.event.addListener(map, 'bounds_changed', function() {
			var bounds = map.getBounds();
			searchBox.setBounds(bounds);
		});
});

</script>