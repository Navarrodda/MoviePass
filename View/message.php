<?php  include(URL_VISTA . "navbar.php"); ?>

<section>
		<?php if(isset($this->message)) {?>
			<div class="container">
				<h1> <?= $this->message->cartelAlert($this->message->getMessage(),$this->message->getTipo()) ?></h1>
			</div>
		<?php } ?>
</section>