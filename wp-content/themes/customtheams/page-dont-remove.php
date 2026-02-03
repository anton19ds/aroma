<?php
/**
 *Template Name: PageNotRemove
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package csproject
 */


?>

<?php if ($_POST) {

    $dataJson = $_POST['data'];
    if (isset($_POST['data']) && $_POST['data'] == "view"):
        //echo ;
        $product_id = $_POST['pid']; // Замените на нужный ID товара
        $product = wc_get_product($product_id);

        if ($product) {
            // Получаем все данные товара в виде массива
            $product_data = $product->get_data();

            // Выводим все данные (для debugging)
//    echo '<pre>';
            //   echo json_encode($product_data);
            //   echo '</pre>';

            // Или обращаемся к конкретным свойствам:
//    echo 'Цена: ' . $product->get_price();
            // и т.д.
            $post_thumbnail_id = $product->get_image_id();

            ?>


            <style>
                .desktop_only.col-md-2.text-left.padding_left_none.table_text_normal {
                    all: unset;
                    font-family: 'Conv_Avenir Next LT Pro Condensed', Sans-Serif;
                    color: #000;
                    font-size: 18px;
                    line-height: 26px;
                    font-weight: 400;
                    font-weight: 400 !important;
                    font-family: 'Conv_Avenir Next LT Pro Condensed', Sans-Serif !important;
                }

                span.table-span-regular.cut__price {
                    text-shadow: 0px .5px 0px #000 !important;
                    text-align: right;
                    /* display: flex; */
                }
                .wpcs_price{
                    white-space: nowrap;
                }

                #myModal5 .single-prod-right-wrap .table_col2 {
                    gap: 28px;
                }

                #myModal5 .single-prod-right-wrap .col2-span-wrap {
                    gap: 12px;
                }

                #myModal5 .single-prod-right-wrap .table_col2 {
                    gap: 44px;
                }

                .quickModal-divide-wrap .col2-span-wrap .table-span-regular.cut__price {
                    display: flex;
                    justify-content: flex-end;
                    position: relative;
                    left: 20px;
                }

                .quickModal-divide-wrap table tbody tr.table-prod-tr {
                    border: none;
                    border-top: 1px solid #ddd;
                }

                .quickModal-divide-wrap table tbody tr.table-prod-tr:first-child {
                    border: none;
                }

                @media only screen and (min-width: 300px) and (max-width: 991px) {
                    .quickModal-divide-wrap .col2-span-wrap .table-span-regular.cut__price {
                        justify-content: flex-start;
                        left: 0;
                    }

                    .table_col2 .col2-span-wrap span:last-child {
                        font-size: 20px;
                    }
                }
            </style>
            <div class="modal fade in" id="myModal5" role="dialog" style="display: block;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close popup_closed_btn" data-dismiss="modal"><img
                                    src="https://www.natureinbottle.com/images/hjd/close_btn.png" alt=""></button>
                        </div>
                        <div class="modal-body">
                            <div class="essentialModalHeader">
                                <h4><?= $product->get_name() ?></h4>
                                <p>
                                    <?php echo get_field('extr_field', $product->id);?>
                                </p>
                            </div>
                            <div class="single-prod-right-wrap born_none">
                                <div class="quickModal-divide-wrap">
                                    <div class="modal-left-image">
                                        <img src="<?php echo wp_get_attachment_url($post_thumbnail_id); ?>" alt=""
                                            title="AGARWOOD (OUD) ESSENTIAL OIL">
                                    </div>
                                    <form class="formpremiumsteptwoform">
                                        <input type="hidden" value="<?= $product->id ?>" name="idProd">
                                        <div>
                                            <table class="table">
                                                <tbody>
                                                    <?php if ($product->children): ?>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($product->children as $key => $item): ?>
                                                            <?php
                                                            $productChild = wc_get_product($item);
                                                            ?>
                                                            <tr class="table-prod-tr">
                                                                <td class="" style="">
                                                                    <div class="table_col1">
                                                                        <span
                                                                            class="table-span-regular"><?php echo $productChild->name ?></span>
                                                                    </div>
                                                                </td>
                                                                <td class="" style="">
                                                                    <div class="table_col2">
                                                                        <div class="col2-span-wrap">
                                                                            <?php if (!empty($productChild->sale_price)): ?>
                                                                                <span class="table-span-regular table-span-strike">
                                                                                    <?php echo $productChild->regular_price; ?> ₽
                                                                                </span>
                                                                                <span class="table-span-regular cut__price">
                                                                                    <?php echo $productChild->sale_price; ?> ₽
                                                                                </span>
                                                                            <?php else: ?>
                                                                                <span class="table-span-regular cut__price">
                                                                                    <?php echo $productChild->price; ?> ₽
                                                                                </span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                        <div
                                                                            class="desktop_only col-md-2 text-left padding_left_none table_text_normal">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td class="" style="">
                                                                    <div class="table_col3">
                                                                        <div class="handle-counter" id="handleCounter<?= $i; ?>" data-min="0" data-max="99" data-step="1">
                                                                            <button type="button" class="counter-minus left-counter-btn">-</button>
                                                                            <input data-name="<?= $productChild->id ?>" name="<?= $productChild->id ?>" id="qty-<?= $productChild->id ?>" type="text"
                                                                                class="counter-value allquantity qty-value" value="0">
                                                                            <button type="button" class="counter-plus right-counter-btn  ">+</button>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>

                                                </tbody> 
                                            </table>
                                            <div class="prod-cart-wrapper  mt-10">
                                                <input type="hidden" name="cartProductId" value="<?= $product->id?>">
                                                <button type="button" class="addnowcart" id="sendAjaxreauest"><i class="fa fa-shopping-cart"
                                                        aria-hidden="true"></i> Add to Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
    endif;
    //echo json_encode($dataJson);
    exit();
}
?>

    <?php
    function addTovar($key, $value){
        WC()->cart->add_to_cart((int)$key, (int)$value);
        WC_AJAX::get_refreshed_fragments();
        wp_die();
    }
    

    if ($_POST) {
    $arrayDataTov = [];
    $data = [];
    foreach ($_POST['data'] as $item) {
     if ($item['name'] != 'idProd') {
        $arrayDataTov[$item['name']] = $item['value'];
    }
    
        }
    

        foreach ($arrayDataTov as $key => $value) {
        addTovar($key, $value);
    }
    
        echo json_encode($arrayDataTov);
} else {
    return false;
    
    }
    
    ?>