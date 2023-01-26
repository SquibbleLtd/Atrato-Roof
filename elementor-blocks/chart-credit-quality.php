<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Chart_Credit_Quality extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve oEmbed widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'chart_credit_quality';
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
    public function get_title()
    {
        return 'Chart Credit Quality';
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
    public function get_icon()
    {
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
    public function get_custom_help_url()
    {
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
    public function get_categories()
    {
        return ['atrato'];
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
    public function get_keywords()
    {
        return ['atrato'];
    }

    /**
     * Register oEmbed widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
    }

    /**
     * Render oEmbed widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {

        // $settings = $this->get_settings_for_display();
?>
        <div class="charts">
            <div class="chart-inner">
                <?php
                $args = [
                    'posts_per_page' => -1,
                    'post_type' => 'credit_quality',
                    'post_status'       => 'publish',

                ];

                $the_query = new WP_Query($args);
                if ($the_query->have_posts()) {

                    while ($the_query->have_posts()) {
                        $the_query->the_post();
                ?>






                        <!-- Chart.js Line Graph and Advanced Custom Fields -->


                        <div class="bar-chart-wrapper">
                            <canvas id="pie-credit-quality" width="280" height="300"></canvas>
                        </div>


                        <!-- Feed in line graph with two lines. Custom field must be a repeater, with a sub number field. -->

                        <script>
                            var dataLine = {
                                labels: [<?php if (have_rows('chart_data_points')) : while (have_rows('chart_data_points')) : the_row(); ?> '<?php the_sub_field('data_segmant'); ?>',
                                    <?php endwhile;
                                            else : endif; ?>
                                ],
                                datasets: [{
                                    fill: false,
                                    label: 'Shares',
                                    backgroundColor: [<?php if (have_rows('chart_data_points')) : while (have_rows('chart_data_points')) : the_row(); ?> '<?php the_sub_field('colour'); ?>',
                                        <?php endwhile;
                                                        else : endif; ?>
                                    ],
                                    // backgroundColor: "#ad9c79",
                                    barPercentage: 0.2,
                                    barThickness: 6,
                                    maxBarThickness: 8,
                                    minBarLength: 10,

                                    data: [<?php if (have_rows('chart_data_points')) : while (have_rows('chart_data_points')) : the_row(); ?>
                                                <?php the_sub_field('data_point'); ?>,
                                        <?php endwhile;
                                            else : endif; ?>
                                    ],
                                    spanGaps: false,

                                }]
                            };

                            var ctxLine = document.getElementById("pie-credit-quality").getContext('2d');
                            var myLineChart = new Chart(ctxLine, {
                                type: 'pie',
                                data: dataLine,
                                options: {
                                    elements: {
                                        arc: {
                                            borderWidth: 0
                                        }
                                    },

                                    legend: {
                                        display: false
                                    },

                                },
                            });
                        </script>




                <?php

                    }
                }
                wp_reset_postdata();
                ?>
            </div>



        </div>

<?php

    }
}
