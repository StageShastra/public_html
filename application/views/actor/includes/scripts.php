            
     
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?= JS ?>/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="<?= JS ?>/vendor/bootstrap.min.js"></script>
        <script src='<?= JS ?>/tagsinput.js'></script>
		<script src="<?= JS ?>/vendor/js.cookies.js"></script>
		<script src="<?= JS ?>/vendor/jquery-ui.js"></script>
		<script src="<?= JS ?>/vendor/cropper.js"></script>
        <script src="<?= JS ?>/act.js"></script>
        <script src="<?= JS ?>/lightbox.js"></script>
        <script src="<?= JS ?>/stupidtable.js"></script>
		<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.2.1/jssocials.min.js"></script>
		
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
