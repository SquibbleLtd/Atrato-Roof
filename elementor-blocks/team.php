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
class Elementor_The_Team extends \Elementor\Widget_Base {

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
		return 'the_team';
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
		return 'The Team - Atrato';
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
		return [ 'atrato' , 'team' , 'staff' ];
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
			'staff_group',
			[
				'type' => \Elementor\Controls_Manager::SELECT,
				'label' => 'Group to show',
				'options' => [
					'energy' => 'Energy experts',
					'directors' => 'Board of directors',
					'investment' => 'Investment team',
				],
			]
		);

		/*
		$tmo = get_team_member_options();

		$this->add_control(
			'title',
			[
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label' => 'Team Member',
				'multiple' => true,
				'options' => $tmo,
			]
		);
		*/
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

		<div class="atr-the-team staff-group-<?php echo $settings['staff_group']; ?>">
			<?php
			$args = [
		    'posts_per_page' => -1,
		    'post_type' => 'team',
		  ];
			if ($settings['staff_group'] != "") {

				$args['meta_query'] = [
	        [
            'key'     => 'staff_group',
            'value'   => $settings['staff_group'],
            'compare' => '=',
	        ]
				];

			}


		  $the_query = new WP_Query( $args );
		  if ( $the_query->have_posts() ) {
		    while ( $the_query->have_posts() ) {
		      $the_query->the_post();
					?><div class="att-container">
						<div class="att-link" data-team-id="<?php echo get_the_ID(); ?>">
							<div class="att-image">
								<?php echo wp_get_attachment_image( get_field('image') , 'team-member' ); ?>
								<img src="/wp-content/uploads/2022/06/Ellipse-35.png" class="ellipse lazyloaded about-team" data-src="/wp-content/uploads/2022/06/Ellipse-35.png" decoding="async" />
								<img src="/wp-content/uploads/2022/06/Ellipse-44.png" class="ellipse lazyloaded investor-team" data-src="/wp-content/uploads/2022/06/Ellipse-44.png" decoding="async" />
							</div>
							<div class="att-name">
								<?php the_title(); ?>
							</div>
							<div class="att-title">
								<?php the_field( 'title' ); ?>
							</div>
							<div class="att-excerpt">
								<?php $excerpt = wp_trim_words( get_field('excerpt'), $num_words = 15, $more = '...' );
								echo $excerpt; ?>
							</div>
							<?php
							$liurl = get_field( 'linkedin_url' );
							if ($liurl != "") {
								?>
								<div class="att-linked-in">
									<i class="fab fa-linkedin" aria-hidden="true"></i>
									<a href="<?php echo $liurl; ?>" target="_blank">
										Connect with me
									</a>
								</div>
								<?php
							}
							?>
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
