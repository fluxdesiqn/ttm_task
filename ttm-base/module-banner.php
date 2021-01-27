<?php

// Featured range field
$banner = get_field('banner_image');

if($banner):

    $title = get_field('banner_title');
    $sub_title = get_field('banner_text');
    $form_id = get_field('banner_form_id');
    $form_title = get_field('banner_form_text');
  
?>
	<div class="c-banner row no-gutters">
		<div class="col-lg-9">
			<div class="c-banner-section" style="background: url(<?= $banner ?>); background-size: cover; background-repeat: no-repeat; background-position: 50%;">

				<div class="c-banner-section__text align-self-center">
					<h1><?= $title ?></h1>
					<span><?= $sub_title ?><span>
				</div>

			</div>
		</div>

		<div class="col-lg-3">
			<div class="c-banner-callback">
				<div class="c-banner-callback__title">
					<h3><?= $form_title ?></h3>
				</div>
				<div class="c-banner-callback__form">
					<?= do_shortcode('[contact-form-7 id="'.$form_id.'" title="'.$form_title.'"]') ?>
				</div>
			</div>
		</div>
	</div>

<?php endif;?>

