<?php
$title  = get_field('about2_title');
$desc   = get_field('about2_desc');
$slider = get_field('about2_slider');
?>
<?php if ($title || $desc || $slider) : ?>
<section class="section-about-2">
	<div class="block-padding">
		<div class="container-fluid">
			<div class="box-content flex flex-col gap-10">
				<?php if ($title) : ?>
					<h2 class="text-white text-center capitalize heading-1"><?php echo esc_html($title); ?></h2>
				<?php endif; ?>
				<?php if ($desc) : ?>
					<div class="text-white text-center body-1 prose">
						<?php echo wp_kses_post($desc); ?>
					</div>
				<?php endif; ?>
				
				<?php if ($slider) : ?>
				<div class="journey-slider-wrapper flex flex-col gap-10" data-id-swiper="journey-slider">
					<!-- Timeline Thumbs Swiper-->
					<div class="journey-timeline relative">
						<div class="swiper swiper-thumbs-journey">
							<div class="swiper-wrapper">
								<?php foreach ($slider as $item) : ?>
									<div class="swiper-slide">
										<div class="year-line">
											<div class="title">
												<h3><?php echo esc_html($item['year']); ?></h3>
											</div>
											<div class="dot"></div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
					<div class="journey-main relative">
						<div class="button-swiper">
							<div class="btn-swiper btn-prev btn-swiper-primary" data-id-swiper="journey-slider"><i class="fa-regular fa-chevron-left"></i>
							</div>
						</div>
						<div class="swiper swiper-main-journey">
							<div class="swiper-wrapper">
								<?php foreach ($slider as $item) : ?>
									<!-- <?php var_dump($item) ?> -->
									<div class="swiper-slide">
										<div class="content-card">
											<div class="img img-ratio ratio:pt-[213_320] zoom-img">
												<?php if ($item['image']) : ?>
													<img class="lozad" src="<?php echo esc_url($item['image']['url']); ?>" data-src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr($item['image']['alt']); ?>"/>
												<?php else : ?>
													<img class="lozad" src="https://picsum.photos/800/800?random" data-src="https://picsum.photos/800/800?random" alt=""/>
												<?php endif; ?>
											</div>
											<div class="content">
												<div class="title">
													<h3><?php echo esc_html($item['title']); ?></h3>
												</div>
												<?php if ($item['content']) : ?>
													<div class="prose">
														<?php echo wp_kses_post($item['content']); ?>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="button-swiper">
							<div class="btn-swiper btn-next btn-swiper-primary" data-id-swiper="journey-slider"><i class="fa-regular fa-chevron-right"></i>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
<?php endif; ?>
