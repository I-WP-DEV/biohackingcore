<?php

function sf_child_theme_dequeue_style()
{
    wp_dequeue_style('storefront-style');
    wp_dequeue_style('storefront-woocommerce-style');
}

add_action('wp_enqueue_scripts', 'ws_scripts');

function ws_scripts()
{
    wp_enqueue_style('country-select-style', get_stylesheet_directory_uri() . '/lib/country-select/css/countrySelect.min.css');
    wp_enqueue_style('shadowllax-style', get_stylesheet_directory_uri() . '/lib/shadowllax/shadowllax.css');
    wp_enqueue_style('jquery-ui-style', 'https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');

    // wp_enqueue_style('slick-style', get_stylesheet_directory_uri() . '/assets/slick.css');

    // wp_enqueue_style('slick-add-style', get_stylesheet_directory_uri() . '/assets/slick-theme.css');

    // 	wp_enqueue_script('slick-script', get_stylesheet_directory_uri() . '/assets/slick.js', array(), '2.9.17');

    wp_enqueue_script('jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js');
    wp_enqueue_script('jquery-countdown', get_stylesheet_directory_uri() . '/lib/countdown/countdownTimer.js', '1.0');
    wp_enqueue_script('particles-script', get_stylesheet_directory_uri() . '/js/particles.js', array(), '1.1');
    wp_enqueue_script('m-script', get_stylesheet_directory_uri() . '/js/main.js', array(), '2.9.6');
    wp_enqueue_script('custom-particle-bg-script', get_stylesheet_directory_uri() . '/js/custom-particle-bg.js', array(), '1.1');
    wp_enqueue_script('country-select-script', get_stylesheet_directory_uri() . '/lib/country-select/js/countrySelect.js');
    wp_enqueue_script('shadowllax-script', get_stylesheet_directory_uri() . '/lib/shadowllax/shadowllax.js');
}

/** 
 * The Top Bar Hook
 */

// add_action('top_header', 'top_header_container', 0);
// add_action('top_header', 'top_header_content', 5);
// add_action('top_header', 'top_header_left_section', 10);
// add_action('top_header', 'top_header_center_section', 15);
// add_action('top_header', 'top_header_right_section', 20);
// add_action('top_header', 'top_header_close', 30);
add_action('top_header', 'top_header_sub_list', 50);

if (!function_exists('top_header_container')) {
    /**
     * The Top header container
     */
    function top_header_container()
    {
        echo '<header id="tophead" class="top-header"><div class="container-desktop"><div class="row">';
    }
}

if (!function_exists('top_header_content')) {
    /**
     * The Top header content
     */
    function top_header_content()
    {
        echo '<div class="top-bar-content d-flex p-relative align-items-center justify-content-center m-auto">';
    }
}

if (!function_exists('top_header_left_section')) {
    /**
     * The Top header left section
     */
    function top_header_left_section()
    {
        echo '<div class="top-bar-content-section skew left d-flex">' 
        . get_deliver_form() . '
        <div class="blog-page skew">
            <a href="#"><span class="link-image"></span><span class="link-text">Knowledge Base</span></a>
        </div>
        </div>';
    }
}

if (!function_exists('top_header_center_section')) {
    /**
     * The Top header center section
     */
    function top_header_center_section()
    {
        echo '<div class="top-bar-content-section center">
            <div class="review-container">
				<div class="center-logo"></div>
			</div>
        </div>';
// 		<img src="' . get_stylesheet_directory_uri() . '/images/nootropics_factory.png" />
    }
}

if (!function_exists('top_header_right_section')) {
    /**
     * The Top header right section
     */
    function top_header_right_section()
    {
        echo '<div class="top-bar-content-section skew right"><ul class="top-header-links">
        <li class="contact-page skew right"><a href="#"><span class="link-image"></span><span class="link-text">Contact</span></a></li>
		<li class="video-page skew right">'. get_social_icons() .'</li>
        </ul></div>';
		
		//<li class="guide-page skew right"><a href="#"><span class="link-image"></span><span class="link-text">Testimonials</span></a></li>
    }
}

if (!function_exists('top_header_close')) {
    /**
     * The Top header clase
     */
    function top_header_close()
    {
        echo '</div></div></div></header>';
    }
}

if (!function_exists('get_deliver_form')) {
    /**
     * Delivery time check
     */
    function get_deliver_form()
    {
        $items = array(
            'delivery' => array(
                'icon' => get_stylesheet_directory_uri() . '/images/icon-truck.svg',
                'icon_2' => get_stylesheet_directory_uri() . '/images/icon-truck-white.svg',
                'text' => 'Delivery to'
            ),
        );
        // container
        $str = '<div class="delivery-time-container">';
        // header section
        $str .= '<div class="delivery-time">';
        foreach ($items as $key => $item) {
            $item_str = '<div class="item ' . $key . '">';
            if ($item['icon'] != '') {
                $item_str .= '<img class="delivery-icon-1" src="' . $item['icon'] . '"/>';
            }
            if ($item['icon_2'] != '') {
                $item_str .= '<img class="delivery-icon-2" src="' . $item['icon_2'] . '"/>';
            }
            $item_str .= '<div><span class="no-wrap">' . $item['text'] . '</span></div>';
            $item_str .= '</div>';
            $str .= $item_str;
        }
        $str .= '<span class="arrow-down"></span></div>';
        // delivery form dropdown
        $dropdown_str = '<div class="delivery-time-dropdown"><div class="delivery-time-dropdown-content">';
        $dropdown_str .= '<div class="delivery-time-dropdown-form">
							<div class="item">
								<p class="no-wrap label"><strong>Delivery to:</strong></p>
								<input type="text" class="ctr-select" id="ctr-select" />
							</div>
						</div>';
        $dropdown_str .= '<div class="delivery-time-dropdown-result">
							<div class="delivery-result-text">
							
							</div>
							<div class="delivery-error">
								<b>We don`t ship to your address!</b>
								<br/>
								<span>Due to your country law and regulations, we are not permitted to send to your location. If you have any questions please contact us</span>
							</div>
						</div>';
        $dropdown_str .= '</div></div>';
        $str .= $dropdown_str;
        $str .= '</div>';
        return $str;
    }
}

if (!function_exists('get_social_icons')) {
    /**
     * Social icons
     */
    function get_social_icons()
    {
        $icons_array = array("facebook", "twitter", "telegram");
        $str = '<div class="social-icons">';
        foreach ($icons_array as $key => $icon) {
            $icon_str = '<a href="#" class="' . $icon . '">&nbsp;</a>';
            $str .= $icon_str;
        }
        $str .= '</div>';

        return $str;
    }
}

if (!function_exists('top_header_sub_list')) {
    /**
     * Social icons
     */
    function top_header_sub_list()
    {
        $items_array = array(
            "Top Quality Guaranteed",
            "Third Party Tested",
            "Research Backed Extracts and Compounds",
            "Worldwide Priority Shipping",
            "Free Tracking Included",
        );
        $str = '<div class="thats-why-items-container"><ul class="thats-why-items">';
        foreach ($items_array as $key => $item) {
            $item_str = '<li>' . $item . '</li>';
            $str .= $item_str;
        }
        $str .= '</ul></div>';

        echo $str;
    }
}

// /**
//  * Product Ajax Query
//  */

// add_action('wp_ajax_my_action', 'get_products');
// add_action('wp_ajax_nopriv_my_action', 'get_products');

// function get_products()
// {
//     if (!empty($_POST['category'])) {
//         $cat_id = $_POST['category'];
//     } else {
//         $cat_id = 1; // default change to yours, in the test case ensure it have something by default
//     }

//     $args = array(
//         'status'           => 'publish',
//         'ignore_sticky_posts'   => 1,
//         'posts_per_page'        => '12',
//         'tax_query'             => array(
//             'relation'          => 'AND', // relation of 2 taxonomy queries
//             array(
//                 'taxonomy'      => 'product_cat',
//                 'field'         => 'term_id', //This is optional, as it defaults to 'term_id'
//                 'terms'         => $cat_id,
//                 'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
//             ),
//             array(
//                 'taxonomy'      => 'product_visibility',
//                 'field'         => 'slug',
//                 'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
//                 'operator'      => 'NOT IN'
//             )
//         )
//     );
//     $query = new WC_Product_Query($args);
//     $products = $query->get_products();

//     // convert to array data before pushing to json
//     $product_arr = [];
//     foreach ($products as $key => $product) {
//         $product_arr[] = $product->get_data();
//     }

//     // echo json_encode($product_arr);
//     wp_send_json_success($product_arr); // with success flag and use directly

//     wp_die();
// }

add_action('wc_product_categories', 'get_product_categories', 0);

function get_product_categories()
{
    $orderby = 'name';
    $order = 'asc';
    $hide_empty = false;
    $cat_args = array(
        'orderby'    => $orderby,
        'order'      => $order,
        'hide_empty' => $hide_empty,
    );

    $product_categories = get_terms('product_cat', $cat_args);

    foreach ($product_categories as $key => $category) {
        ?>
        <button class="btn btn-filter btn-outline" data-filter="category" data-slug="<?= $category->slug ?>"><?= $category->name ?></button>
    <?php
        }
        ?>
    <input type="hidden" name="admin_ajax_url" id="admin_ajax_url" value="<?= admin_url('admin-ajax.php') ?>">
    <input type="hidden" name="cart_url" id="cart_url" value="<?= wc_get_cart_url() ?>">
    <?php
    }

    add_action('wc_tags_collection', 'get_all_tags', 0);

    function get_all_tags()
    {
        $tags = get_terms('product_tag');

        foreach ($tags as $key => $tag) {
            ?>
        <button class="btn btn-filter btn-outline" data-filter="tag" data-slug="<?= $tag->name ?>"><?= $tag->name ?></button>
    <?php
        }
        ?>
<?php
}

// Ajax Product Filter By Category

add_action("wp_ajax_filter_products_by_category", "ajax_filter_products_by_category");
add_action("wp_ajax_nopriv_filter_products_by_category", "ajax_filter_products_by_category");

function ajax_filter_products_by_category()
{
    $category_slug = $_POST["slug"];

    if ($category_slug == "") {
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'orderby' => 'post_title',
            'order' => 'ASC'
        );
    } else {
        $args = array(
            'posts_per_page' => 50,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    // 'terms' => 'white-wines'
                    'terms' => $category_slug
                )

            ),
            'post_type' => 'product',
            'orderby' => 'post_title',
            'order' => 'ASC'
        );
    }
    $products = new WP_Query($args);

    $output = array();
    foreach ($products->posts as $key => $product) {
        $temp = array();
        $wc_product = wc_get_product($product->ID);
        $thumbnail = get_the_post_thumbnail_url($product->ID, 'woocommerce_thumbnail');
        if ($thumbnail == '') {
            $thumbnail = wc_placeholder_img_src();
        }
        $price = $wc_product->get_price_html();
        $url = get_permalink($product->ID);
        $temp['data'] = $product;
        $temp['image'] = $thumbnail;
        $temp['price'] = $price;
        $temp['url'] = $url;
        $temp['out_of_stock'] = (!$wc_product->managing_stock() && !$wc_product->is_in_stock()) ? 1 : 0;
        $temp['categories'] = '<h6 class="category">' . $wc_product->get_categories(', ', ' ' . _n(' ', '  ', $cat_count, 'woocommerce') . ' ', ' ') . '</h6>';

        $output[] = $temp;
    }

    echo json_encode($output);
    die();
}

add_action("wp_ajax_filter_products_by_tag", "ajax_filter_products_by_tag");
add_action("wp_ajax_nopriv_filter_products_by_tag", "ajax_filter_products_by_tag");

function ajax_filter_products_by_tag()
{
    $tags = array($_POST["slug"]);
    $args = array(
        'post_type'      => 'product',
        'posts_per_page' => 5,
        'product_tag'      => $tags
    );

    if ($tags[0] == '') {
        $args = array(
            'post_type'      => 'product',
            'posts_per_page' => -1,
            'orderby' => 'post_title',
            'order' => 'ASC'
        );
    } else {
        $args = array(
            'posts_per_page' => 50,
            'product_tag' => $tags,
            'post_type' => 'product',
            'orderby' => 'post_title',
            'order' => 'ASC'
        );
    }

    $products = new WP_Query($args);

    $output = array();
    foreach ($products->posts as $key => $product) {
        $temp = array();
        $wc_product = wc_get_product($product->ID);
        $thumbnail = get_the_post_thumbnail_url($product->ID, 'woocommerce_thumbnail');
        if ($thumbnail == '') {
            $thumbnail = wc_placeholder_img_src();
        }
        $price = $wc_product->get_price_html();
        $url = get_permalink($product->ID);
        $temp['data'] = $product;
        $temp['image'] = $thumbnail;
        $temp['price'] = $price;
        $temp['url'] = $url;
        $temp['out_of_stock'] = (!$wc_product->managing_stock() && !$wc_product->is_in_stock()) ? 1 : 0;
        $temp['categories'] = '<h6 class="category">' . $wc_product->get_categories(', ', ' ' . _n(' ', '  ', $cat_count, 'woocommerce') . ' ', ' ') . '</h6>';
        $output[] = $temp;
    }

    echo json_encode($output);
    die();
}

/**
 * Sticky Header
 */

$path = get_stylesheet_directory_uri() . '/js';
if (!is_admin()) wp_enqueue_script('stickyheader', $path . '/stickyheader.js', array('jquery'), '1.8');




add_theme_support('custom-header');

function themename_custom_header_setup()
{
    $defaults = array(
        // Default Header Image to display
        'default-image'         => get_template_directory_uri(public_html / nootropicsfactory / wp - content / themes / storefront - child) . '/images/brain.jpg',
        // Display the header text along with the image
        'header-text'           => false,
        // Header text color default
        'default-text-color'        => '000',
        // Header image width (in pixels)
        'width'             => 1000,
        // Header image height (in pixels)
        'height'            => 198,
        // Header image random rotation default
        'random-default'        => false,
        // Enable upload of image file in admin 
        'uploads'       => false,
        // function to be called in theme head section
        'wp-head-callback'      => 'wphead_cb',
        //  function to be called in preview page head section
        'admin-head-callback'       => 'adminhead_cb',
        // function to produce preview markup in the admin screen
        'admin-preview-callback'    => 'adminpreview_cb',
    );
}

// Delivery Time
function ajax_cf7_populate_values()
{

    $data = [
        'Belgium'         => ['code' => 'BE', 'min' => 1, 'max' => 2],
        'Bulgaria'         => ['code' => 'BG', 'min' => 2, 'max' => 4],
        'Czech Republic' => ['code' => 'CZ', 'min' => 2, 'max' => 4],
        'Finland'         => ['code' => 'FI', 'min' => 2, 'max' => 3],
        'France'         => ['code' => 'FR', 'min' => 2, 'max' => 3],
        'Germany'         => ['code' => 'DE', 'min' => 2, 'max' => 4],
        'Greece'         => ['code' => 'GR', 'min' => 3, 'max' => 5],
        'Hungary'         => ['code' => 'HU', 'min' => 2, 'max' => 4],
        'Ireland'         => ['code' => 'IE', 'min' => 2, 'max' => 4],
        'Italy (excl. San Marino, Vatican City)' => ['code' => 'IT', 'min' => 2, 'max' => 5],
        'Latvia'         => ['code' => 'LV', 'min' => 3, 'max' => 6],
        'Lithuania'     => ['code' => 'LT', 'min' => 3, 'max' => 6],
        'New Zealand'     => ['code' => 'NZ', 'min' => 5, 'max' => 7],
        'Norway'         => ['code' => 'NO', 'min' => 2, 'max' => 5],
        'Poland'         => ['code' => 'PL', 'min' => 2, 'max' => 4],
        'Romania'         => ['code' => 'RO', 'min' => 2, 'max' => 5],
        'Slovakia'         => ['code' => 'SK', 'min' => 2, 'max' => 4],
        'Sweden'         => ['code' => 'SE', 'min' => 2, 'max' => 3],
    ];

    $return_array = array(
        'countries' => $data,
        'current_country' => false,
        'delivery_time' => false
    );

    $country = key_exists('country', $_POST) ? $_POST['country'] : false;

    if ($country) {
        $return_array['current_country'] = $country;
        $return_array['delivery_time'] = $data[$country];
    }

    echo json_encode($return_array);
    wp_die();
}

add_action('wp_ajax_cf7_populate_values', 'ajax_cf7_populate_values');
add_action('wp_ajax_nopriv_cf7_populate_values', 'ajax_cf7_populate_values');

class GetCountryRequest
{

    public function getIpAddress()
    {
        $ipAddress = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && $this->isValidIpAddress($_SERVER['HTTP_CLIENT_IP'])) {
            // check for shared ISP IP
            $ipAddress = $_SERVER['HTTP_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check for IPs passing through proxy servers
            // check if multiple IP addresses are set and take the first one
            $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($ipAddressList as $ip) {
                if ($this->isValidIpAddress($ip)) {
                    $ipAddress = $ip;
                    break;
                }
            }
        } else if (!empty($_SERVER['HTTP_X_FORWARDED']) && $this->isValidIpAddress($_SERVER['HTTP_X_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED'];
        } else if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && $this->isValidIpAddress($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
            $ipAddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        } else if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && $this->isValidIpAddress($_SERVER['HTTP_FORWARDED_FOR'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR'];
        } else if (!empty($_SERVER['HTTP_FORWARDED']) && $this->isValidIpAddress($_SERVER['HTTP_FORWARDED'])) {
            $ipAddress = $_SERVER['HTTP_FORWARDED'];
        } else if (!empty($_SERVER['REMOTE_ADDR']) && $this->isValidIpAddress($_SERVER['REMOTE_ADDR'])) {
            $ipAddress = $_SERVER['REMOTE_ADDR'];
        }
        return $ipAddress;
    }

    public function isValidIpAddress($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false) {
            return false;
        }
        return true;
    }

    public function getLocation($ip)
    {
        $ch = curl_init('http://ipwhois.app/json/' . $ip);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        // Decode JSON response
        $ipWhoIsResponse = json_decode($json, true);
        // Country code output, field "country_code"
        return $ipWhoIsResponse;
    }
}

function dynamic_dropdown_script_footer()
{
    $cRequestModel = new GetCountryRequest();
    $ip = getRealIpAddr();
    $country_details = $cRequestModel->getLocation($ip);
    $country_code = key_exists('country_code', $country_details) ? $country_details['country_code'] : null;
    $country_name = key_exists('country', $country_details) ? $country_details['country'] : null;
?>
    <script>
        (function($) {
            var countryList = ['be', 'bg', 'cz', 'de', 'fi', 'fr', 'gr', 'hu', 'ie', 'it', 'lv', 'lt', 'no', 'nz', 'pl', 'ro', 'sk', 'se'];
            $('.ctr-select').countrySelect({
                onlyCountries: countryList,
                responsiveDropdown: true,
            });

            var cUserCountryCode = "<?= strtolower($country_code) ?>";
            $('.country-select .selected-flag .flag').removeClass(countryList[0]);
            $('.ctr-select').val('Choose your location');

            var $country = $('.ctr-select');

            if (countryList.includes(cUserCountryCode)) {
                $(".ctr-select").countrySelect("selectCountry", cUserCountryCode);
                $('.delivery-result-text').html('A few seconds...').show();
                $('.delivery-error').hide();
                populate_fields();
                $(".delivery-time-text").html("<div class='flag' style='background-position: " + $('.country-select .flag').css('background-position') + "'></div> <p><?= $country_name ?></p>");
            }else {
                <?php if(is_single() && is_product()):?>
                    $('.delivery-info-txt').html('Delivery time not available, contact us for more information.');
                <?php endif?>
            }

            $('.ctr-select').change(function(e) {
                if (e.target.value == '') {
                    $('.delivery-result-text').html('');
                    $('.delivery-result-text').hide();
                    $('.delivery-error').show();
                } else {
                    $('.delivery-result-text').html('A few seconds...').show();
                    $('.delivery-error').hide();
                }
                populate_fields();
                $(".delivery-time-text").html("<div class='flag' style='background-position: " + $('.country-select .flag').css('background-position') + "'></div> <p>" + $country.val() + "</p>");
            });

            $('.ctr-select').on('click', function() {
                $('.selected-flag').trigger("click");
            });

            function populate_fields() {
                var data = {
                    'action': 'cf7_populate_values',
                    'country': $country.val(),
                };

                $.post('<?php echo admin_url('admin-ajax.php') ?>', data, function(response) {
                    all_values = response;
                    if (all_values.delivery_time) {
                        var d_min = all_values.delivery_time.min;
                        var d_max = all_values.delivery_time.max;
                        $('.delivery-result-text').html('<table class="w-100 has-background"><tbody><tr><th style="padding-left: 0">Standard Delivery:</th><td>' + d_min + '-' + d_max + '  working days</td></tr></tbody></table><p class="text-muted text-italic">*Subject to placing your order before specific cut-off times. All shipping times are approximations and cannot be guaranteed. Note that these may increase during holidays.</p> <hr><p class="text-muted p-15">Click here for more <a href="#" class="text-underline">shipping information</a></p>');
                        <?php if(is_single() && is_product()):?>
                            $('.delivery-info-txt').html('<strong>Approximately ' + d_min + '-' + d_max + ' days to reach your destination</strong>');
                            $('.delivery-time-country-name').html($country.val());
                        <?php endif?>
                    }
                }, 'json');
            }

        })(jQuery);
    </script>
    <?php if (is_shop() || is_product()) {
        global $product;
        $product_id = $product->get_id();
    ?>
        <script>
            (function($) {
                $(document).ready(function() {
                    var filter_val = getUrlVars();
                    if (filter_val.length === 0) {
                        console.log('No filter applied');
                    } else {
                        var keys = Object.keys(filter_val);

                        if (jQuery.inArray('type', keys) != '-1') {
                            $("button[data-slug='" + filter_val['type'] + "']").click();
                        }

                        if (jQuery.inArray('effects', keys) != '-1') {
                            $("button.tablinks[data-tab=2]").click();
                            $("button[data-slug='" + filter_val['effects'] + "']").click();
                        }

                    }

                    $('form.cart').find('.single_add_to_cart_button').click(function(e) {
                        setTimeout(() => {
                            $('.cw_qty').val(1);
                            $('.wdp_pricing_table_tr').removeClass('active');
                        }, 3000);
                    });

                    $('.cw_qty').change(function(e) {
                        $(this).parents('form.cart').find('.single_add_to_cart_button').attr('data-quantity', $(this).val());
                        $('.expected_total_price').html(
                            '<img src="<?php echo get_stylesheet_directory_uri() . '/images/loading.gif';?>" width=15 style="display: inline-block">'
                        );
                        get_discounted_price_product($(this).val());
                    });

                    $('.delivery-time-indicater').click(function(e) {
                        $('.delivery-info-txt').toggleClass('active');
                    });

                    function getUrlVars() {
                        var vars = [],
                            hash;
                        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                        for (var i = 0; i < hashes.length; i++) {
                            hash = hashes[i].split('=');
                            vars.push(hash[0]);
                            vars[hash[0]] = hash[1];
                        }
                        return vars;
                    }

                    function get_discounted_price_product(qty) {
                        var data = {
                            'action': 'get_discounted_price_product',
                            'product_id': <?php echo $product_id; ?>,
                            'qty': qty,
                        };
                        $.post('<?php echo admin_url('admin-ajax.php') ?>', data, function(response) {
                            var price = response.price;
                            var total_price = response.total_price;
                            var regular_total_price = response.regular_price;
                            console.log(regular_total_price);
                            if (price && total_price) {
                                if(regular_total_price == 0) {
                                    $('.expected_total_price').html(
                                        '<ins>' + total_price + '</ins>'
                                    );
                                } else {
                                    $('.expected_total_price').html(
                                        '<del>' + regular_total_price + '</del> ' + '<ins>' + total_price + '</ins>'
                                    );
                                }
                            } else {
                                $('.expected_total_price').html('');
                            }
                        }, 'json');
                    }
                });
            })(jQuery);
        </script>
        <?php
    }
}

    add_action('wp_footer', 'dynamic_dropdown_script_footer');

    // Primary Header Container Layout Change

    add_action('init', 'storefront_header_container_customized');
    function storefront_header_container_customized()
    {
        remove_action('storefront_header', 'storefront_header_container', 0);
        add_action('storefront_header', 'storefront_header_container_div', 0);
        remove_action('storefront_header', 'storefront_header_container_close', 41);
        add_action('storefront_header', 'storefront_header_container_close_div', 41);
        remove_action('storefront_header', 'storefront_primary_navigation_wrapper', 42);
        add_action('storefront_header', 'storefront_primary_navigation_wrapper_div', 42);
        remove_action('storefront_header', 'storefront_primary_navigation_wrapper_close', 68);
        add_action('storefront_header', 'storefront_primary_navigation_wrapper_div_close', 68);

        // Remove Woocommerce Breadcrumbs
        remove_action('storefront_before_content', 'woocommerce_breadcrumb', 10);
        remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
    }

    if (!function_exists('storefront_header_container_div')) {
        function storefront_header_container_div()
        {
            echo '<div class="container"><div class="row"><div class="col-12">';
        }
    }


    if (!function_exists('storefront_header_container_close_div')) {
        function storefront_header_container_close_div()
        {
            echo '</div></div></div>';
        }
    }

    if (!function_exists('storefront_primary_navigation_wrapper_div')) {
        function storefront_primary_navigation_wrapper_div()
        {
            echo '<div class="container"><div class="row"><div class="col-12"><div class="storefront-primary-navigation">';
        }
    }

    if (!function_exists('storefront_primary_navigation_wrapper_div_close')) {
        /**
         * The primary navigation wrapper close
         */
        function storefront_primary_navigation_wrapper_div_close()
        {
            echo '<div></div></div></div>';
        }
    }

    remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
    add_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail_customize', 10);

    if (!function_exists('woocommerce_subcategory_thumbnail_customize')) {
        function woocommerce_subcategory_thumbnail_customize($category)
        {
            $small_thumbnail_size = apply_filters('subcategory_archive_thumbnail_size', 'woocommerce_thumbnail');
            $dimensions           = wc_get_image_size($small_thumbnail_size);
            $thumbnail_id         = get_woocommerce_term_meta($category->term_id, 'thumbnail_id', true);

            if ($thumbnail_id) {
                $image        = wp_get_attachment_image_src($thumbnail_id, 'full');
                $image        = $image[0];
                $image_srcset = function_exists('wp_get_attachment_image_srcset') ? wp_get_attachment_image_srcset($thumbnail_id, 'full') : false;
                $image_sizes  = function_exists('wp_get_attachment_image_sizes') ? wp_get_attachment_image_sizes($thumbnail_id, 'full') : false;
            } else {
                $image        = wc_placeholder_img_src();
                $image_srcset = false;
                $image_sizes  = false;
            }

            if ($image) {
                // Prevent esc_url from breaking spaces in urls for image embeds.
                // Ref: https://core.trac.wordpress.org/ticket/23605.
                $image = str_replace(' ', '%20', $image);

                // Add responsive image markup if available.
                if ($image_srcset && $image_sizes) {
                    echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($category->name) . '" width="350" height="700" sizes="' . esc_attr($image_sizes) . '" />';
                } else {
                    echo '<img src="' . esc_url($image) . '" alt="' . esc_attr($category->name) . '" width="500" height="700" />';
                }
            }
        }
    }

    // Product Loop Layout Customize
    add_filter('woocommerce_get_image_size_thumbnail', function ($size) {
        return array(
            'width' => 230,
            'height' => 350,
            'crop' => 1,
        );
    });

    add_action('wcc_before_shop_loop_card_img', 'wcc_shop_loop_card_img_open_tag', 5);
    add_action('wcc_before_shop_loop_card_img', 'wcc_shop_loop_card_img_content', 10);
    add_action('wcc_before_shop_loop_card_img', 'wcc_shop_loop_card_img_close_tag', 15);

    if (!function_exists('wcc_shop_loop_card_img_open_tag')) {
        function wcc_shop_loop_card_img_open_tag()
        {
            echo '<div class="card-image">';
        }
    }

    if (!function_exists('wcc_shop_loop_card_img_content')) {
        function wcc_shop_loop_card_img_content()
        {
            global $product;
            echo '<a href="' . get_permalink($product->ID) . '" title="' . get_the_title($product->ID) . '">' . woocommerce_get_product_thumbnail() . '</a>';
            echo '<div class="ripple-container"></div>';
        }
    }

    if (!function_exists('wcc_shop_loop_card_img_close_tag')) {
        function wcc_shop_loop_card_img_close_tag()
        {
            echo '</div>';
        }
    }

    add_action('wcc_before_shop_loop_card_content', 'wcc_shop_loop_card_content_open_tag', 5);
    add_action('wcc_before_shop_loop_card_content', 'wcc_shop_loop_card_content_category', 10);
    add_action('wcc_before_shop_loop_card_content', 'wcc_shop_loop_card_content_title', 15);
    add_action('wcc_before_shop_loop_card_content', 'wcc_shop_loop_card_content_footer', 20);
    add_action('wcc_before_shop_loop_card_content', 'wcc_shop_loop_card_content_close_tag', 25);

    if (!function_exists('wcc_shop_loop_card_content_open_tag')) {
        function wcc_shop_loop_card_content_open_tag()
        {
            echo '<div class="content">';
        }
    }

    if (!function_exists('wcc_shop_loop_card_content_category')) {
        function wcc_shop_loop_card_content_category()
        {
            global $product;
            echo '<h6 class="category">' . $product->get_categories(', ', ' ' . _n(' ', '  ', $cat_count, 'woocommerce') . ' ', ' ') . '</h6>';
        }
    }

    if (!function_exists('wcc_shop_loop_card_content_title')) {
        function wcc_shop_loop_card_content_title()
        {
            global $product;
            echo '<h4 class="card-title">' . '<a href="' . get_permalink($product->ID) . '">' . get_the_title($product->ID) . '</a>' . '</h4>';
        }
    }

    if (!function_exists('wcc_shop_loop_card_content_footer')) {
        function wcc_shop_loop_card_content_footer($args = array())
        {
            global $product;
            $price = '';
            $stats = '';
            $add_to_cart = '';
            if ($product) {
                $defaults = array(
                    'quantity'   => 1,
                    'class'      => implode(
                        ' ',
                        array_filter(
                            array(
                                'button',
                                'product_type_' . $product->get_type(),
                                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                            )
                        )
                    ),
                    'attributes' => array(
                        'data-product_id'  => $product->get_id(),
                        'data-product_sku' => $product->get_sku(),
                        'aria-label'       => $product->add_to_cart_description(),
                        'rel'              => 'nofollow',
                    ),
                );

                $args = apply_filters('woocommerce_loop_add_to_cart_args', wp_parse_args($args, $defaults), $product);

                if (isset($args['attributes']['aria-label'])) {
                    $args['attributes']['aria-label'] = wp_strip_all_tags($args['attributes']['aria-label']);
                }

                $quantity = esc_attr(isset($args['quantity']) ? $args['quantity'] : 1);
                $ajax_url = esc_url($product->add_to_cart_url());
                $btn_class = esc_attr(isset($args['class']) ? $args['class'] : 'button');
                $btn_attr = isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '';
                if (!$product->managing_stock() && !$product->is_in_stock()) {
                    $add_to_cart_button = '<a href="' . $ajax_url . '" data-quantity="' . $quantity . '" class="' . $btn_class . '" ' . $btn_attr . ' style="pointer-events: none; opacity: 0.4"></a>';
                } else {
                    $add_to_cart_button = '<a href="' . $ajax_url . '" data-quantity="' . $quantity . '" class="' . $btn_class . '" ' . $btn_attr . '></a>';
                }
            }
            $price .= '<div class="price"><h4>' . wc_price($product->get_price()) . '</h4></div>';
            $stats .= '<div class="stats">' . $add_to_cart_button . '</div>';
            echo '<div class="footer">' . $price . $stats . '</div>';
        }
    }

    if (!function_exists('wcc_shop_loop_card_content_close_tag')) {
        function wcc_shop_loop_card_content_close_tag()
        {
            echo '</div>';
        }
    }

    function wpb_custom_new_menu()
    {
        register_nav_menus(
            array(
                'social-icon-menu' => __('Social Icon Menu')
            )
        );
    }
    add_action('init', 'wpb_custom_new_menu');

    add_action('storefront_header', 'storefront_dilvery_form', 38);
    if (!function_exists('storefront_dilvery_form')) {
        function storefront_dilvery_form()
        {
            $items = array(
                'delivery' => array(
                    'icon' => get_stylesheet_directory_uri() . '/images/icon-truck.svg',
                    'icon_2' => get_stylesheet_directory_uri() . '/images/icon-truck-white.svg',
                    'text' => 'Delivery to'
                ),
            );
            // container
            $str = '<div class="delivery-time-container">';
            // header section
            $str .= '<div class="delivery-time"><div class="delivery-time-text"> Choose your country </div>';
            foreach ($items as $key => $item) {
                $item_str = '<div class="item ' . $key . '">';
                //             if ($item['icon'] != '') {
                //                 $item_str .= '<img class="delivery-icon-1" src="' . $item['icon'] . '"/>';
                //             }
                //             if ($item['icon_2'] != '') {
                //                 $item_str .= '<img class="delivery-icon-2" src="' . $item['icon_2'] . '"/>';
                //             }
                $item_str .= '<div><span class="no-wrap">' . $item['text'] . '</span></div>';
                $item_str .= '</div>';
                $str .= $item_str;
            }
            $str .= '<span class="arrow-down"></span></div>';
            // delivery form dropdown
            $dropdown_str = '<div class="delivery-time-dropdown"><div class="delivery-time-dropdown-content">';
            $dropdown_str .= '<div class="delivery-time-dropdown-form">
							<div class="item">
								<input type="text" class="ctr-select" id="ctr-select" readonly />
							</div>
						</div>';
            $dropdown_str .= '<div class="delivery-time-dropdown-result">
							<div class="delivery-result-text">
							
							</div>
							<div class="delivery-error">
								<b>We don`t ship to your address!</b>
								<br/>
								<span>Due to your country law and regulations, we are not permitted to send to your location. If you have any questions please contact us</span>
							</div>
						</div>';
            $dropdown_str .= '</div></div>';
            $str .= $dropdown_str;
            $str .= '</div>';
            echo $str;
        }
    }

    add_action('storefront_header', 'storefront_social_icons', 35);
    if (!function_exists('storefront_social_icons')) {
        function storefront_social_icons()
        {
            if (has_nav_menu('social-icon-menu')) {
                ?>
            <nav class="social-icon-menu-navigation" role="navigation" aria-label="<?php esc_html_e('Social Icon Navigation', 'storefront'); ?>">
                <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'social-icon-menu',
                                    'fallback_cb'    => '',
                                )
                            );
                            ?>
            </nav><!-- #site-navigation -->
        <?php
                }
            }
        }

        function getRealIpAddr()
        {
            if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            {
                $ip = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            {
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return $ip;
        }

        function url_origin($s, $use_forwarded_host = false)
        {
            $ssl      = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
            $sp       = strtolower($s['SERVER_PROTOCOL']);
            $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
            $port     = $s['SERVER_PORT'];
            $port     = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
            $host     = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
            $host     = isset($host) ? $host : $s['SERVER_NAME'] . $port;
            return $protocol . '://' . $host;
        }

        function full_url($s, $use_forwarded_host = false)
        {
            return url_origin($s, $use_forwarded_host) . $s['REQUEST_URI'];
        }

        add_filter('wp_nav_menu_items', 'add_loginout_link', 10, 2);

        function add_loginout_link($items, $args)
        {

            if (is_user_logged_in() && $args->theme_location == 'secondary') {

                $items .= '<li><a href="' . wp_logout_url(get_permalink(woocommerce_get_page_id('myaccount'))) . '">Log Out</a></li>';
            } elseif (!is_user_logged_in() && $args->theme_location == 'secondary') {

                $items .= '<li><a href="' . get_permalink(woocommerce_get_page_id('myaccount')) . '">Log In</a></li>';
            }

            return $items;
        }




        // Add this to your theme's functions.php 
        function marce_change_custom_logo_size()
        {
            add_theme_support('custom-logo', array(
                'height'      => 343,
                'width'       => 804,
                'flex-width' => true,
            ));
        }
        add_action('storefront_site_branding', 'marce_change_custom_logo_size', 30);

        add_filter('body_class', 'custom_class');
        function custom_class($classes)
        {
            if (is_shop()) {
                $classes[] = 'page-template-template-fullwidth-php';
            }
            return $classes;
        }


        add_action('wp_footer', 'product_categories_filter');
        // add_shortcode('product_categories_filter', 'product_categories_filter');
        function product_categories_filter()
        {
            $str = '<div class="content-wrapper"><div class="filter-wrapper"><div class="tab"><button class="tablinks active" data-tab="1">Category</button><button class="tablinks" data-tab="2">Tag</button></div><div class="tabcontent open" data-tab="1"><div class="category-filter">';
            $categories_str = '';
            $orderby = 'name';
            $order = 'asc';
            $hide_empty = false;
            $cat_args = array(
                'orderby'    => $orderby,
                'order'      => $order,
                'hide_empty' => $hide_empty,
            );

            $product_categories = get_terms('product_cat', $cat_args);

            foreach ($product_categories as $key => $category) {
                $categories_str .= '<button class="btn btn-filter btn-outline" style="width: 45%; margin-left: 2.5%; margin-right: 2.5%;" data-filter="category" data-slug="' . $category->slug . '">' . $category->name . '</button>';
            }
            $categories_str .= '<input type="hidden" name="admin_ajax_url" id="admin_ajax_url" value="' . admin_url('admin-ajax.php') . '"><input type="hidden" name="cart_url" id="cart_url" value="' . wc_get_cart_url() . '">';

            $str .= $categories_str;

            $str .= '</div></div><div class="tabcontent" data-tab="2"><div class="tag-filter">';

            $tags_str = '';

            $tags = get_terms('product_tag');

            foreach ($tags as $key => $tag) {
                $tags_str .= '<button class="btn btn-filter btn-outline btn-block" style="width: 45%; margin-left: 2.5%; margin-right: 2.5%;" data-filter="tag" data-slug="' . $tag->name . '">' .  $tag->name . '</button>';
            }
            $str .= $tags_str . '</div></div></div>';

            $str .= '<div class="products-wrapper"><ul class="products columns-3"></div></div><div>';

            if (is_front_page()) {
                ?>
        <script>
            jQuery(document).ready(function() {
                jQuery('#product_categories_filter').html('<?= $str ?>');
                var loading_html = '<div class="loading-overlay"><img class="loading-img" src="/wp-content/themes/storefront-child/images/loading.gif" width=50/></div>';
                jQuery.ajax({
                    type: 'post',
                    url: jQuery('#admin_ajax_url').val(),
                    data: {
                        action: 'filter_products_by_category',
                        slug: '',
                    },
                    beforeSend: function() {
                        jQuery('.products-wrapper').append(loading_html);
                    },
                    complete: function() {
                        jQuery('.loading-overlay').remove();
                    },
                    success: function(response) {
                        var output = '';
                        var res = JSON.parse(response);
                        if (res.length) {
                            res.forEach(product => {
                                var li_classes = 'product type-product product-type-simple ';
                                var cart_style = '';
                                li_classes += ' post-' + product['data']['ID'];
                                if (product['out_of_stock'] == 1) {
                                    cart_style = 'style="pointer-events: none; opacity: 0.4;"';
                                }
                                var list_cotent = '<li class="' + li_classes + '"><div class="card card-product pop-and-glow">';
                                var card_image = '<div class="card-image"><a href="' + product['url'] + '" title="' + product['data']['post_title'] + '"><img width="230" height="350" src="' + product['image'] + '" class="woocommerce-placeholder wp-post-image" alt="Placeholder" loading="lazy"></a><div class="ripple-container"></div></div>';
                                var card_content = '<div class="content">' + product['categories'] +
                                    '<h4 class="card-title"><a href="' + product['url'] + '">' + product['data']['post_title'] + '</a></h4>' +
                                    '<div class="footer"><div class="price"><h4>' + product['price'] + '</h4></div><div class="stats"><a rel="nofollow" href="?add-to-cart=' + product['data']['ID'] + '" class="button product_type_simple add_to_cart_button ajax_add_to_cart btn btn-just-icon btn-simple btn-default" data-quantity="1" data-product_id="' + product['data']['ID'] + '" data-product_sku="" ' + cart_style + '></a></div></div></div>';

                                list_cotent = list_cotent + card_image + card_content + '</div></li>';

                                output += list_cotent;
                            });
                        } else {
                            output = '<li><p class="woocommerce-info">No products were found matching your selection.</p></li>';
                        }

                        jQuery('ul.products').html(output);
                    },
                });
            });
        </script>
    <?php
        }
    }

    function woocommerce_product_custom_fields()
    {
        $args = array(
            'id' => 'certificate_of_analysis_link',
            'label' => __('Certificate of Analysis Link', 'coal'),
        );
        woocommerce_wp_text_input($args);
    }
    add_action('woocommerce_product_options_general_product_data', 'woocommerce_product_custom_fields');

    function save_woocommerce_product_custom_fields($post_id)
    {
        $product = wc_get_product($post_id);
        $custom_fields_certificate_link = isset($_POST['certificate_of_analysis_link']) ? $_POST['certificate_of_analysis_link'] : '';
        $product->update_meta_data('certificate_of_analysis_link', sanitize_text_field($custom_fields_certificate_link));
        $product->save();
    }
    add_action('woocommerce_process_product_meta', 'save_woocommerce_product_custom_fields');

    add_filter('woocommerce_short_description', 'cmk_coal_link');
    function cmk_coal_link($description)
    {
        $productID = get_the_ID();
        $link =  get_post_meta($productID, 'certificate_of_analysis_link', true);
        if ($link) {
            return $description . '<div style="margin-top: 40px;"><a class="hover-underline-animation" href="' . $link . '" target="_blank" style="color: #6d6d6d;padding-bottom: 15px">Certificate of Analysis</a></div>';
        }

        return $description;
    }

    add_action('woocommerce_before_single_product', 'my_move_simple_price');
    function my_move_simple_price()
    {
        global $product;
        if ($product->is_type('simple')) {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10);
        }
    }
/*single product*/
    add_action('woocommerce_single_product_entry_right', 'woocommerce_template_single_price', 5);
    add_action('woocommerce_single_product_entry_right', 'woocommerce_template_single_add_to_cart', 15);
    add_action('woocommerce_single_product_entry_right', 'woocommerce_template_single_short_desc', 20);

    function woocommerce_template_single_short_desc()
    {
        ?>
    <ul class="right-entry-short-desc">
        <li><img src="https://biohackingcore.nl/wp-content/uploads/2022/06/1Asset-4tw.png"> Specialist in gezondheid en fitness</li>
        <li><img src="https://biohackingcore.nl/wp-content/uploads/2022/06/1Asset-4tw.png"> Ma-vr voor 21:00 besteld, morgen in huis</li>
        <li><img src="https://biohackingcore.nl/wp-content/uploads/2022/06/1Asset-4tw.png"> Gratis verzending vanaf 40,-</li>
        <li><img src="https://biohackingcore.nl/wp-content/uploads/2022/06/1Asset-4tw.png"> Klanten geven Bodystore een 4.7/5</li>
        <li><img src="https://biohackingcore.nl/wp-content/uploads/2022/06/1Asset-4tw.png"> Spaar voor korting</li>
    </ul>
    <style>
        ul.right-entry-short-desc {
            list-style: none;
            font-size: 11px;
            margin: 0;
            text-align: left
        }

        .right-entry-short-desc li {
            margin-bottom: 10px;
        }

        .right-entry-short-desc li img {
            width: 14px;
            float: left;
            margin-right: 15px;
        }
    </style>
    <?php
    }

    function add_content_after_addtocart()
    {
        // get the current post/product ID
        $current_product_id = get_the_ID();
        // get the product based on the ID
        $product = wc_get_product($current_product_id);
        // get the "Checkout Page" URL
        $checkout_url = WC()->cart->get_checkout_url();
        // run only on simple products
        if ($product->is_type('simple')) {
            ?>
        <script>
            jQuery(function($) {
                $(".single_buy_now_button").on("click", function() {
                    $(this).attr("href", function() {
                        return this.href + '&quantity=' + $('select.cw_qty').val();
                    });
                });
            });
        </script>
<?php
        echo '<a href="' . $checkout_url . '?add-to-cart=' . $current_product_id . '" class="single_buy_now_button button alt">Buy Now</a>';
        $orders_ids = get_orders_ids_by_product_id($current_product_id);
        if (!empty($orders_ids)) {
            foreach ($orders_ids as $order_id) {
                // get order by order ID
                $order = wc_get_order($order_id);
                $order_items = $order->get_items();
                $product_order_quantities = array();
                foreach ($order_items as $item_id => $item) {
                    // Get the product name
                    $product_name = $item['name'];
                    $item_quantity = $order->get_item_meta($item_id, '_qty', true);
                    if ($product_name === $product->get_title()) {
                        array_push($product_order_quantities, $item_quantity);
                    }
                }
            }
        }
    }
}
add_action('woocommerce_after_add_to_cart_button', 'add_content_after_addtocart');

function woocommerce_quantity_input($data = null)
{
    global $product;
    if (!$data) {
        $defaults = array(
            'input_name'   => 'quantity',
            'input_value'   => '1',
            'max_value'     => apply_filters('woocommerce_quantity_input_max', $product->get_sku(), $product),
            'min_value'     => apply_filters('woocommerce_quantity_input_min', '', $product),
            'step'         => apply_filters('woocommerce_quantity_input_step', '1', $product),
            'style'         => apply_filters('woocommerce_quantity_style', 'float:left;', $product)
        );
    } else {
        $defaults = array(
            'input_name'   => $data['input_name'],
            'input_value'   => $data['input_value'],
            'step'         => apply_filters('cw_woocommerce_quantity_input_step', '1', $product),
            'max_value'     => apply_filters('cw_woocommerce_quantity_input_max', $product->get_sku(), $product),
            'min_value'     => apply_filters('cw_woocommerce_quantity_input_min', '', $product),
            'style'         => apply_filters('cw_woocommerce_quantity_style', isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), $product)
        );
    }
    if (!empty($defaults['min_value']))
        $min = $defaults['min_value'];
    else $min = 1;
    if (!empty($defaults['max_value']) && $defaults['max_value'] < 15)
        $max = $defaults['max_value'];
    else $max = 15;
    if (!empty($defaults['step']))
        $step = $defaults['step'];
    else $step = 1;
    $options = '';
    for ($count = $min; $count <= $max; $count = $count + $step) {
        $selected = $count === $defaults['input_value'] ? ' selected' : '';
        $options .= '<option value="' . $count . '"' . $selected . '>' . $count . '</option>';
    }
    echo '<div class="cw_quantity_select" style="' . $defaults['style'] . '">
        <span>Qty:</span> 
        <select name="quantity" title="' . _x('Qty', 'Product Description', 'woocommerce') . '" class="cw_qty">' . $options . '</select>
        <span class="expected_total_price"></span>
    </div>';

    echo do_shortcode('[adp_product_bulk_rules_table]');
}


add_filter('woocommerce_checkout_fields', 'njengah_override_checkout_fields');
function njengah_override_checkout_fields($fields)
{
    $fields['billing']['billing_address_2']['placeholder'] = 'Street Number';
    $fields['billing']['billing_address_2']['label'] = 'Street Number';
    $fields['billing']['billing_address_2']['required'] = true;


    $fields['billing']['billing_address_1']['placeholder'] = 'Street Name';
    $fields['billing']['billing_address_1']['label'] = 'Street Name';


    $fields['billing']['billing_houseno'] = array(
        'label'     => 'Addition',
        'placeholder'   => 'Addition',
        'priority' => 61,
        'required'  => false,
        'clear'     => true
    );

    $fields['shipping']['shipping_houseno'] = array(
        'label'     => 'Addition',
        'placeholder'   => 'Addition',
        'priority' => 61,
        'required'  => false,
        'clear'     => true
    );
    return $fields;
}

// ------------------------------------
// Add Billing House # to Address Fields

add_filter('woocommerce_order_formatted_billing_address', 'bbloomer_default_billing_address_fields', 10, 2);

function bbloomer_default_billing_address_fields($fields, $order)
{
    $fields['billing_houseno'] = get_post_meta($order->get_id(), '_billing_houseno', true);
    return $fields;
}

// ------------------------------------
// Add Shipping House # to Address Fields

add_filter('woocommerce_order_formatted_shipping_address', 'bbloomer_default_shipping_address_fields', 10, 2);

function bbloomer_default_shipping_address_fields($fields, $order)
{
    $fields['shipping_houseno'] = get_post_meta($order->get_id(), '_shipping_houseno', true);
    return $fields;
}

// ------------------------------------
// Create 'replacements' for new Address Fields

add_filter('woocommerce_formatted_address_replacements', 'add_new_replacement_fields', 10, 2);

function add_new_replacement_fields($replacements, $address)
{
    $replacements['{billing_houseno}'] = isset($address['billing_houseno']) ? $address['billing_houseno'] : '';
    $replacements['{shipping_houseno}'] = isset($address['shipping_houseno']) ? $address['shipping_houseno'] : '';
    return $replacements;
}

// ------------------------------------
// Show Shipping & Billing House # for different countries

add_filter('woocommerce_localisation_address_formats', 'bbloomer_new_address_formats');

function bbloomer_new_address_formats($formats)
{

    $formats['default'] = "{name}\n{company}\n{address_1}, {address_2}-{billing_houseno}\n{shipping_houseno}\n{state}\n{postcode} {city}\n{country}";
    $formats['IE'] = "{name}\n{company}\n{address_1}, {address_2}-{billing_houseno}\n{shipping_houseno}\n{state}\n{postcode} {city}\n{country}";
    $formats['UK'] = "{name}\n{company}\n{address_1}, {address_2}-{billing_houseno}\n{shipping_houseno}\n{state}\n{postcode} {city}\n{country}";
    $formats['NL'] = "{name}\n{company}\n{address_1}, {address_2}-{billing_houseno}\n{shipping_houseno}\n{state}\n{postcode} {city}\n{country}";
    $formats['US'] = "{name}\n{company}\n{address_1}, {address_2}-{billing_houseno}\n{shipping_houseno}\n{state}\n{postcode} {city}\n{country}";
    // and so on...
    return $formats;
}

// add_filter( 'woocommerce_billing_fields', 'wc_unrequire_wc_phone_field');
// function wc_unrequire_wc_phone_field( $fields ) {
// $fields['billing']['billing_address_2']['required'] = true;
// return $fields;
// }

// add_filter( 'woocommerce_default_address_fields', 'misha_add_field' );

// function misha_add_field( $fields ) {

// 	$fields['street_number']   = array(
// 		'label'        => 'Street Number',
// 		'required'     => true,
// 		'class'        => array( 'form-row-wide', 'my-custom-class' ),
// 		'priority'     => 50,
// 		'placeholder'  => 'Street Number',
// 	);

// 	$fields['address_1']['label'] = 'Street Name';
// 	$fields['address_1']['placeholder'] = 'Street Name';


// 	return $fields;

// }
// add_filter( 'woocommerce_billing_fields', 'misha_remove_fields' );

// function misha_remove_fields( $fields ) {

// 	unset( $fields[ 'address_2' ]['required'] );
// 	return $fields;

// }

/* ps checkout code */

add_filter('woocommerce_cart_item_name', 'add_cart_info', 99, 10);
function add_cart_info($name, $cart_item, $cart_item_key)
{
    // Get the corresponding WC_Product
    $product_item = $cart_item['data'];

    if (!empty($product_item) && $product_item->is_type('variation')) {
        // WC 3+ compatibility
        $product_cat =  get_the_terms($cart_item['product_id'], 'product_cat'); // Add product category to item name
        $add_sku = $product_item->get_sku(); // Add SKU to item name
        $description = version_compare(WC_VERSION, '3.0', '<') ? $product_item->get_variation_description() : $product_item->get_description(); // Add variation description to item name
        $add_price = $product_item->get_price_html(); // Add price to customise layout to item name
        $category = __('<div class="product-cat">', 'woocommerce') . $product_cat[0]->name . '</div>'; // Add style to product category
        $sku = __('<div class="product-sku">#', 'woocommerce') . $add_sku . '</div>'; // Add style to SKU
        $var_desc = __('<div class="var-desc">', 'woocommerce') . $description . '</div>'; // Add style to variation description
        $price = __('<div class="price-new">', 'woocommerce') . $add_price . '</div>'; // Add style to prodct price
        return $name . '<br>' . $category . '<strong>:&nbsp;</strong>' . $sku . $var_desc . $price; // Output all of them
    } else
        return $name;
}

/* end ps checkout code */

// add_filter( 'woocommerce_default_address_fields' , 'misha_change_fname_field' );

// function misha_change_fname_field( $fields ) {

// 	$fields['first_name']['label'] = 'Name';
// 	$fields['first_name']['placeholder'] = 'Your mom calls you';

// 	return $fields;

// }
// add_filter('woocommerce_short_description','ts_add_text_short_descr', 20, 5);
// function ts_add_text_short_descr($description){
//     global $product;
//     $text = '';
//     if($product->get_sku() > 0) {
//         $text = "<p>Type: Capsule, Powder</p>";
//     }
//   return $description . $text;
// }


/*TOC*/
function get_toc($content)
{
    // get headlines
    $headings = get_headings($content);

    // parse toc
    ob_start();
    echo "<div class='table-of-contents'>";
    echo "<span class='toc-headline'>Table Of Contents</span>";
    echo "<!-- Table of contents by webdeasy.de -->";
    echo "<span class='toggle-toc custom-setting' title='collapse'>−</span>";
    parse_toc($headings, 0, 0);
    echo "</div>";
    return ob_get_clean();
}

function parse_toc($headings, $index, $recursive_counter)
{
    // prevent errors
    if ($recursive_counter > 60 || !count($headings)) return;

    // get all needed elements
    $last_element = $index > 0 ? $headings[$index - 1] : NULL;
    $current_element = $headings[$index];
    $next_element = $index < count($headings) ? $headings[$index + 1] : NULL;

    // end recursive calls
    if ($current_element == NULL) return;


    // get all needed variables
    $tag = intval($headings[$index]["tag"]);
    $id = $headings[$index]["id"];
    $classes = $headings[$index]["classes"];
    $name = $headings[$index]["name"];


    // element not in toc
    if ($current_element["classes"] && in_array("nitoc", $current_element["classes"])) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
        return;
    }


    // parse toc begin or toc subpart begin
    if ($last_element == NULL || $last_element["tag"] < $tag) echo "<ul>";


    // build li class
    $li_classes = "";
    if ($current_element["classes"] && in_array("toc-bold", $current_element["classes"])) $li_classes = " class='bold'";

    // parse line begin
    echo "<li" . $li_classes . ">";

    // only parse name, when li is not bold
    if ($current_element["classes"] && in_array("toc-bold", $current_element["classes"])) {
        echo $name;
    } else {
        echo "<a href='#" . $id . "'>" . $name . "</a>";
    }

    if (intval($next_element["tag"]) > $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }

    // parse line end
    echo "</li>";

    // parse next line
    if (intval($next_element["tag"]) == $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }


    // parse toc end or toc subpart end
    if ($next_element == NULL || $next_element["tag"] < $tag) echo "</ul>";

    // parse top subpart
    if ($next_element != NULL && $next_element["tag"] < $tag) {
        parse_toc($headings, $index + 1, $recursive_counter + 1);
    }
}

function get_headings($content)
{
    $headings = array();
    preg_match_all("/<h([1-6])(.*)>(.*)<\/h[1-6]>/", $content, $matches);

    for ($i = 0; $i < count($matches[1]); $i++) {

        $headings[$i]["tag"] = $matches[1][$i];

        // get id
        $att_string = $matches[2][$i];
        preg_match("/id=\"([^\"]*)\"/", $att_string, $id_matches);
        $headings[$i]["id"] = $id_matches[1];

        // get classes
        $att_string = $matches[2][$i];
        preg_match_all("/class=\"([^\"]*)\"/", $att_string, $class_matches);
        for ($j = 0; $j < count($class_matches[1]); $j++) {
            $headings[$i]["classes"][] = $class_matches[1][$j];
        }

        $headings[$i]["name"] = $matches[3][$i];
    }

    return $headings;
}

// TOC shortcode //
function toc_shortcode()
{
    return get_toc(auto_id_headings(get_the_content()));
}
add_shortcode('TOC', 'toc_shortcode');



/**
 * Automatically add IDs to headings
 */
function auto_id_headings($content)
{
    $content = preg_replace_callback('/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function ($matches) {
        if (!stripos($matches[0], 'id=')) {
            $matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title($matches[3]) . '">' . $matches[3] . $matches[4];
        }
        return $matches[0];
    }, $content);
    //echo $content;
    return $content;
}
add_filter('the_content', 'auto_id_headings');

/**
 * TAG Cloud
 */
function wpb_tags()
{
    $wpbtags =  get_tags();
    foreach ($wpbtags as $tag) {
        $string .= '<span class="tagbox">Tags: <a class="taglink" href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>' . "\n";
    }
    return $string;
}
add_shortcode('wpbtags', 'wpb_tags');

/**
 * Post Title
 */
function post_title_shortcode()
{
    return get_the_title();
}
add_shortcode('post_title', 'post_title_shortcode');


add_action('woocommerce_single_product_summary', 'customizing_variable_products', 1);
function customizing_variable_products()
{
    global $product;
    if (!$product->is_type('variable')) return;

    remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
    add_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 15);
}


add_filter('formatted_woocommerce_price', 'ts_woo_decimal_price', 10, 5);
function ts_woo_decimal_price($formatted_price, $price, $decimal_places, $decimal_separator, $thousand_separator)
{
    $unit = number_format(intval($price), 0, $decimal_separator, $thousand_separator);
    $decimal = sprintf('%02d', ($price - intval($price)) * 100);
    return $unit . '<sup>' . $decimal . '</sup>';
}

add_filter('woocommerce_get_availability', 'custom_get_availability', 1, 2);
function custom_get_availability($availability, $_product)
{
    if ($_product->is_in_stock()) $availability['availability'] = __('In Stock.', 'woocommerce');
    if (!$_product->is_in_stock()) $availability['availability'] = __('Out of Stock.', 'woocommerce');
    return $availability;
}

//Deliver time in Single Product Page
add_action('woocommerce_single_product_entry_right', 'deliver_time_single_product', 10);
function deliver_time_single_product()
{
    date_default_timezone_set('Europe/Berlin');
    $cRequestModel = new GetCountryRequest();
    $ip = getRealIpAddr();
    $country_details = $cRequestModel->getLocation($ip);
    $country_name = $country_details['country'];

    $today = date("D");
    $nextday = date('D', strtotime('next day'));
    $current_hour = intval(date("H"));
    $next_date = date('M-d', strtotime('tomorrow'));
    $next_date_time = date('Y/m/d 17:00:00', strtotime('tomorrow'));
    $next_monday_date = date('M-d', strtotime('next monday'));
    $next_monday_date_time = date('Y/m/d 17:00:00', strtotime('next monday'));

    $delivery_str = '<p style="font-size: 13px; margin: 5px 0;">
        <img src="' . get_stylesheet_directory_uri() . '/images/location_icon.png" width=11 style="margin-right: 5px; float: left" />
        <span style="margin-right: 30px; float: left">Deliver to <span class="delivery-time-country-name">' . $country_name . '</span></span>
        <span class="delivery-time-indicater" style="cursor: pointer;">
            <img src="' . get_stylesheet_directory_uri() . '/images/del_time_icon.png" width=15 style="margin-right: -2px; display: inline-block;"/>
            <span class="arrow-down" style="border-top-color: #28566d;font-size: 6px; margin-left: 5px; "><span>
        </span>
    </p>
    <p class="delivery-info-txt"></p>';
    if ($today != 'Sat' && $today != 'Sun') {
        if ($current_hour < 17) {
            echo '
                <p style="font-size: 13px; margin: 10px 0 0 0; line-height: 18px">
                    For shipment today, order within <strong><span id="hms_timer"></span></strong>.
                </p>'
                . $delivery_str .
                '<script>
                jQuery(function(){
                    jQuery("#hms_timer").countdowntimer({
                        dateAndTime : "' . date('Y/m/d') . ' 17:00:00",
                        size : "lg"
                    });
                });
                </script>
            ';
        } else {
            if ($today == 'Sat' || $today == 'Sun') {
                echo '<p style="font-size: 13px; margin: 10px 0 0 0; line-height: 18px">
                    For shipment on the ' . $next_monday_date . ' order within <strong><span id="hms_timer"></span></strong>.
                </p>'
                . $delivery_str .
                '<script>
                jQuery(function(){
                    jQuery("#hms_timer").countdowntimer({
                        dateAndTime : "' . $next_monday_date_time . '",
                        size : "lg"
                    });
                });
                </script>';
            } else {
                if ($nextday == 'Sat') {
                    echo '<p style="font-size: 13px; margin: 10px 0 0 0; line-height: 18px">
                        For shipment on the ' . $next_monday_date . ' order within <strong><span id="hms_timer"></span></strong>.
                    </p>'
                    . $delivery_str .
                    '<script>
                    jQuery(function(){
                        jQuery("#hms_timer").countdowntimer({
                            dateAndTime : "' . $next_monday_date_time . '",
                            size : "lg"
                        });
                    });
                    </script>';
                } else {
                    echo '<p style="font-size: 13px; margin: 10px 0 0 0; line-height: 18px">
                        For shipment on the ' . $next_date . ' order within <strong><span id="hms_timer"></span></strong>.
                    </p>'
                    . $delivery_str .
                    '<script>
                    jQuery(function(){
                        jQuery("#hms_timer").countdowntimer({
                            dateAndTime : "' . $next_date_time . '",
                            size : "lg"
                        });
                    });
                    </script>';
                }
            }
        }
    } else {
        echo '<p style="font-size: 13px; margin: 10px 0 0 0; line-height: 18px">
            For shipment on the ' . $next_monday_date . ' order within <strong><span id="hms_timer"></span></strong>.
        </p>'
        . $delivery_str .
        '<script>
        jQuery(function(){
            jQuery("#hms_timer").countdowntimer({
                dateAndTime : "' . $next_monday_date_time . '",
                size : "lg"
            });
        });
        </script>';
    }
}

function get_orders_ids_by_product_id($product_id)
{

    global $wpdb;
    $order_status = ['wc-completed', 'wc-processing', 'wc-on-hold'];

    $results = $wpdb->get_col("
        SELECT order_items.order_id
        FROM {$wpdb->prefix}woocommerce_order_items as order_items
        LEFT JOIN {$wpdb->prefix}woocommerce_order_itemmeta as order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id
        LEFT JOIN {$wpdb->posts} AS posts ON order_items.order_id = posts.ID
        WHERE posts.post_type = 'shop_order'
        AND posts.post_status IN ( '" . implode("','", $order_status) . "' )
        AND order_items.order_item_type = 'line_item'
        AND order_item_meta.meta_key = '_product_id'
        AND order_item_meta.meta_value = '" . $product_id . "'
        ORDER BY order_items.order_id DESC");

    return $results;
}

add_action("wp_ajax_get_discounted_price_product", "ajax_get_discounted_price_product");
add_action("wp_ajax_nopriv_get_discounted_price_product", "ajax_get_discounted_price_product");

function ajax_get_discounted_price_product()
{
    $product_id = key_exists('product_id', $_POST) ? $_POST['product_id'] : false;
    $product =  wc_get_product( $product_id );
    $qty = key_exists('qty', $_POST) ? $_POST['qty'] : 0;
    if ($product_id) {
        $discounted_price = adp_functions()->getDiscountedProductPrice($product_id, $qty);
        $regular_price = $product->get_regular_price();
        if($discounted_price == $regular_price) {
            echo json_encode(array(
                'price' => wc_price($discounted_price),
                'total_price' => wc_price($discounted_price * $qty),
                'regular_price' => 0,
            ));
        } else {
            echo json_encode(array(
                'price' => wc_price($discounted_price),
                'total_price' => wc_price($discounted_price * $qty),
                'regular_price' => wc_price($product->get_regular_price() * $qty),
            ));
        }
    } else {
        echo json_encode(array(
            'price' => 0,
            'total_price' => 0,
            'regular_price' => 0,
        ));
    }
    wp_die();
}
