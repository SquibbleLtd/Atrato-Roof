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
class Elementor_Event_Table extends \Elementor\Widget_Base {

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
		return 'event_table';
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
		return 'Event Table - Atrato';
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
		return [ 'events' , 'calendar' , 'financial' ];
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

		//$settings = $this->get_settings_for_display();
		?>

		<div class="atr-event-table">
			<?php
			$args = [
		    'posts_per_page' => -1,
		    'post_type' => 'event',
			  'meta_key'          => 'event_date',
			  'orderby'           => 'meta_value_num',
			  'order'             => 'ASC',
				'meta_query' => array(
	        'relation' => 'OR',
	        array(
            'key'     => 'event_date',
            'value'   => date('Ymd'),
            'compare' => '>='
	        ),
		    ),
		  ];

		  $the_query = new WP_Query( $args );
		  if ( $the_query->have_posts() ) {
			?><div class="aet-table-row row-heading">
				<div class="aet-table-cell event-name column-heading">
					<span>Event</span>
				</div>
				<div class="aet-table-cell event-date column-heading">
					<span>Date</span>
				</div>
			</div><?php
		    while ( $the_query->have_posts() ) {
		      $the_query->the_post();
					?><div class="aet-table-row">
						<div class="aet-table-cell event-name">
							<?php the_title(); ?>
						</div>
						<div class="aet-table-cell event-date">
							<?php the_field('event_date'); ?>
						</div>
						<div class="aet-table-cell event-add-btn">
							<?php
							$text = get_the_title();
							$ukformatdate = get_field('event_date');
							$parts = explode('/',$ukformatdate);
							$universaldate = $parts[2] . '-' . $parts[1] . '-' . $parts[0];
							$startdate = date('Ymd',strtotime($universaldate));
							$enddate = date('Ymd',strtotime("+1 day",strtotime($universaldate)));
							$dates = $startdate . '/' . $enddate;
							$calurl = 'https://calendar.google.com/calendar/r/eventedit?text=' . urlencode( $text ) . '&dates=' . urlencode( $dates ) ;
							?>
							<a href="<?php echo $calurl; ?>">
								Add to calendar
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
