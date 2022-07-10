<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

</div><!-- .col-full -->
</div><!-- #content -->
</div><!-- .content-container -->

<?php do_action('storefront_before_footer'); ?>

<footer id="colophon" class="site-footer" role="contentinfo">
  <div class="col-full">

    <?php
    /**
     * Functions hooked in to storefront_footer action
     *
     * @hooked storefront_footer_widgets - 10
     * @hooked storefront_credit         - 20
     */
    do_action('storefront_footer');
    ?>

  </div><!-- .col-full -->
</footer><!-- #colophon -->

<?php do_action('storefront_after_footer'); ?>

</div><!-- #page -->
<script>
  jQuery(document).ready(function() {
    console.log('load');
    var value = jQuery('.test').html().replace(",", " ");
    jQuery('.test').html(value);
  });
</script>
<?php wp_footer(); ?>
<script>
  // jQuery(document).ready(function($) {
  //   $("canvas").removeClass("tsparticles-canvas-el").addClass("particles-js-canvas-el");
  //   $(".blog-slider").slick({
  //     dots: true,
  //     infinite: true,
  //     slidesToShow: 3,
  //     slidesToScroll: 1,
  //     centerMode: true,
  //     autoplay: true,
  //     arrows: true,
  //     prevArrow: "<button type='button' class='slick-prev pull-left'><img src='https://biohackingcore.com/wp-content/themes/storefront-child/images/course-arrow-left.png'></button>",
  //     nextArrow: "<button type='button' class='slick-next pull-right'><img src='https://biohackingcore.com/wp-content/themes/storefront-child/images/course-arrow-right.png'></button>",
  //     responsive: [{
  //         breakpoint: 1200,
  //         settings: {
  //           slidesToShow: 2,
  //           slidesToScroll: 1,
  //         },
  //       },
  //       {
  //         breakpoint: 800,
  //         settings: {
  //           slidesToShow: 1,
  //           slidesToScroll: 1,
  //           centerMode: false,
  //         },
  //       }
  //     ]
  //   });
  // });
</script>
</body>

</html>