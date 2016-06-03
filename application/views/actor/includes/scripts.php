            
     
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?= JS ?>/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?= JS ?>/vendor/bootstrap.min.js"></script>
        <script src='<?= JS ?>/tagsinput.js'></script>
		<script src="<?= JS ?>/vendor/js.cookies.js"></script>
		<script src="<?= JS ?>/vendor/jquery-ui.js"></script>
		<script src="<?= JS ?>/vendor/cropit.js"></script>
        <script src="<?= JS ?>/act.js"></script>
        <script src="<?= JS ?>/lightbox.js"></script>
        <script src="<?= JS ?>/stupidtable.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials.min.js"></script>

		<script type="text/javascript">
			
			$(function(){

				$("#image-cropper").cropit({
					imageBackground: true,
					imageBackgroundBorderWidth: 15
				});

				function imageDataURI(img) {
					var canvas = document.createElement("canvas");
					canvas.width = img.width;
					canvas.height = img.height;
					var ctx = canvas.getContext("2d");
					ctx.drawImage(img, 0, 0);
					var dataURL = canvas.toDataURL("image/png");
					return dataURL;
				}

				$(document).on("click", ".doCropit", function(){

					img = $(this).find("img").attr("src");
					img = "http://localhost" + img;
					data = {request: "ImageToEncode", data: JSON.stringify({img: img})};
					$.ajax({
						url: "/Castiko/actor/ajax/",
						type: "POST",
						data: data,
						success: function(response){
							dataURL = response.data.dataURL;
							//$("#hidden-field").show(500);
							$("#cropit-image-preview")
								.addClass("cropit-image-loaded")
								.css("background-image", 'url("'+dataURL+'")');
						}
					});
					return false;


				});

			});

		</script>
		
		<script>
			$("#socialShare").jsSocials({
				showLabel: false,
				showCount: false,
				shareIn: "popup",
				text: "<?= $actorProfile['StashActor_name'] ?> | Actor | Castiko",
				url: "<?= base_url() . $user["StashUsers_username"] ?>",
				shares: ["twitter", "facebook", "googleplus", "linkedin"]
			});
		</script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
      
        <footer class="footer">
          <foodiv class="container center">
            <p class="dark-gray info-small center ">&copy; <?= date("Y") ?> Castiko | connect@castiko.com</p>
        </footer>
    </body>
</html>
