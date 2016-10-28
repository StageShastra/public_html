<?php
  include 'includes/head.php';
  
?>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="container">
          <div class="col-sm-1">
          </div>
          <div class="container-fluid col-sm-10 center"> <!--container fluid starts -->
            <div class="center headname">
              <a href="<?= base_url() ?>" class='a_logo'><img src="<?= IMG ?>/logo.png" class="logo img-fluid"/>
			         <span class="title big"><?= M_Title ?></span></a>
            </div>
            <hr class="thick">
            </hr>
            <div class="row">
              <div id="getcodediv">
              <div class="col-sm-6 center">
                <div class="mycontent-right center light-padded">
                    <h4 class="info firstcolor center"> <?= $title ?> </h4>
					</br>
                    <p>
						<?= $body ?>
					</p>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="col-sm-1">
		  
			<?php
				if($redirect){
			?>
			<script>
				setTimeout(function(){
					window.location.href = "<?= base_url() . $page ?>";
				}, 10000);
			</script>
			<?php
				}
			?>
			
          </div>
        </div>
<?php
  include 'includes/scripts.php';
?>
