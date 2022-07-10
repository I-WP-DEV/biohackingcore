<?php
defined('ABSPATH') or exit;

/**
 * @var string $header_html
 * @var array $table_header
 * @var array $rows
 * @var string $footer_html
 */
?>
<div class='clear'></div>

<div class="bulk_table">
    <div class="wdp_pricing_table_caption"><?php echo $header_html; ?></div>
    <table class="wdp_pricing_table">
        <thead>
        <tr>
            <?php foreach ($table_header as $label): ?>
                <td><?php echo $label ?></td>
            <?php endforeach; ?>
        </tr>
        </thead>

        <tbody>
        <?php foreach ($rows as $__key => $row):
            $qty = $row['qty'];
            $min_max = explode(' - ', $qty);
            ?>
            <tr class="wdp_pricing_table_tr" data-key="<?=$__key?>" data-min="<?=(int) $min_max[0]?>" data-max="<?=(int) $min_max[1]?>">
                <?php foreach ($row as $html): 
                    ?>
                    <td><?php echo $html ?></td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <span class="wdp_pricing_table_footer"><?php echo $footer_html; ?></span>
</div>

<script>
    (function($) {
        $(document).ready(function() {
            $('.cw_qty').change(function(e) {
                var qty = $(this).val();
                $('.wdp_pricing_table_tr').each(function(_id) {
                    var min = $(this).data('min');
                    var max = $(this).data('max');
                    if((qty >= min && qty <= max) || (qty >= min && max == 0)) {
                        $(this).addClass('active');
                    }else {
                        $(this).removeClass('active');
                    }
                });
            });
        });
    })(jQuery);
</script>
