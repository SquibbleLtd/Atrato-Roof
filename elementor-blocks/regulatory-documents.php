<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Regulatory_Documents extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'regulatory_documents';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return 'Regulatory Documents - Atrato';
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'atrato' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'regulatory' , 'documents' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				'label' => 'Content',
			]
		);

		$this->add_control(
			'category',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => 'Category',
				'options' => [
					'' => 'Show all',
					'Corporate' => 'Corporate',
					'Governance' => 'Governance',
					'Sustainability' => 'Sustainability',
				],
			]
		);

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		?>

		<div class="atr-presentations">
			<?php
			$args = [
		    'posts_per_page' => -1,
		    'post_type' => 'regulatory_documents',
			'orderby' => 'date',
            'order'   => 'DESC',
		  ];
			if ($settings['category'] != "") {

				$args['meta_query'] = [
	        [
            'key'     => 'category',
            'value'   => $settings['category'],
            'compare' => '=',
	        ]
				];
			}

		  $the_query = new WP_Query( $args );
		  if ( $the_query->have_posts() ) {
		    while ( $the_query->have_posts() ) {
		      $the_query->the_post();
					?>
					<div class="atr-presentation">
						<div class="atr-presentation-bgimage">
							<?php echo wp_get_attachment_image( get_field('background_image' ) , 'large' ); ?>
						</div>
						<div class="atr-presentation-category">
							<?php the_field('category'); ?>
						</div>
						<div class="atr-presentation-title">
							<?php the_title(); ?>
						</div>
						<!-- <div class="atr-presentation-date">
							<?php //echo get_the_date(); ?>
						</div> -->
						<div class="atr-presentation-btn">
							<a href="<?php the_field('document'); ?>" class="btn">
								Download
							</a>
						</div>
					</div>
					<?php
		    }
		  }
		  wp_reset_postdata();
			?>
		</div>

		<?php

	}

}
