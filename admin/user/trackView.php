<?php 

									
    if(isset($_POST['btnTrig'])){
          $lats = $_POST['latitudes'];
          $longs = $_POST['longitudes'];


    }

?>

<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Responder Location <?php echo $lats ?>, <?php echo $longs; ?></h3>
		
	</div>
	<div class="card-body">
        <div class="container-fluid">
			
            
                        <div id="map" style="height: 400px; width: 100%;">
                            
                        </div>
                    

            <script type="text/javascript">



                let map;

                function initMap() {
                    var uluru = { lat: <?php echo $lats ?>, lng: <?php echo $longs ?> };
                    console.log(uluru);
                    let map = new google.maps.Map(document.getElementById("map"), {
                        center: uluru,
                        zoom: 10
                    });

                    var marker = new google.maps.Marker({
                        position: uluru,
                        map: map
                    })
                }
            </script>
            <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq48uXc35YvNlFRqteQywr0hKHY-GeVw4&callback=initMap">
            </script>

		</div>
	</div>
</div>