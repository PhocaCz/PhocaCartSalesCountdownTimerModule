<?php
/*
 * @package		Joomla.Framework
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @component Phoca Component
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */

use Joomla\CMS\Router\Route;

defined('_JEXEC') or die('Restricted access');

$price = new PhocacartPrice();


echo '<div class="ph-mod-sct-box" id="' . $id . '">';

if ($p['background_image'] == '' && $p['background_video'] != '') {
    echo '<video autoplay muted loop id="ModPhocaCarouselVideo" class="ph-video-bg">';
    echo '<source src="' . $path['media'] . $p['background_video'] . '" type="video/mp4">';
    echo '</video>';
}

echo '<div class="swiper-container ph-mod-sct-swiper-container">';
echo '<div class="parallax-bg" data-swiper-parallax="-23%"></div>';


echo '<div class="swiper-wrapper">';



if (!empty($items)) {
    $i = 0;

    foreach ($items as $k => $v) {

        if ($t['featured']) {
            // Check product ID by featured products
            if (!isset($v->id) || (isset($v->id) && (int)$v->id == 0)) {
                continue;
            }
        } else {
            // Check discount ID by discounts
            if (!isset($v->discount_id) || (isset($v->discount_id) && (int)$v->discount_id == 0)) {
                continue;
            }
        }


        echo '<div class="swiper-slide ph-swiper-slide-box-' . $i . '">';
        echo '<div class="swiper-slide ph-swiper-slide-box-bg-' . $i . '"></div>';

        // TITLE
        if ($v->title != '') {
            echo '<div class="ph-title-' . $i . '" data-swiper-parallax="-300">' . $v->title . '</div>';
        }

        // PRODUCT DESCRIPTION
        if ($p['item_description_display']  == 1 && $v->description != '') {
            echo '<div class="ph-product-description-' . $i . '" data-swiper-parallax="-300">' . PhocacartText::removeFirstTag($v->description, 'p') . '</div>';
        }


        // PRODUCT PRICE
        $priceItems    = $price->getPriceItems($v->price, $v->tax_id, $v->tax_rate, $v->tax_calculationtype, $v->tax_title, $v->unit_amount, $v->unit_unit, 1, 1, $v->group_price);
        $priceItemsDefault = $priceItems;
        $discountParams = array();
        if ($p['item_ignore_quantity_rule'] == 1) {
            $discountParams['ignore_quantity_rule'] = 1;
        }

        $discountParams['ignore_view_rule'] = 1;

        $priceDiscount = PhocacartDiscountProduct::getProductDiscountPrice($v->id, $priceItems, $discountParams);

        echo '<div class=" ph-price-' . $i . '" data-swiper-parallax="-300">';
        echo '<div class="ph-mod-sct-price-box">';
        if ($priceItems['brutto']) {
            echo '<div class="ph-mod-sct-price-new">'.$priceItems['bruttoformat'].'</div>';
        }
        if ($priceItemsDefault['brutto'] && !$t['featured']) {
            echo '<div class="ph-mod-sct-price-original">'.$priceItemsDefault['bruttoformat'].'</div>';
        }
        echo '</div>';
        echo '</div>';

        // DISCOUNT DESCRIPTION
        if ($p['item_discount_description_display'] == 1 && isset($v->discount_description) && $v->discount_description != '' ) {
            echo '<div class="ph-discount-description-' . $i . '" data-swiper-parallax="-300">' . PhocacartText::removeFirstTag($v->discount_description, 'p') . '</div>';
        }

        // STOCK
        if ($p['item_stock_display'] == 1 && $v->stock != '') {
            echo '<div class="ph-stock-' . $i . '" data-swiper-parallax="-300">' . $p['item_stock_text_prefix'] .  $v->stock . $p['item_stock_text_suffix'] . '</div>';
        }

        // IMAGE
        if ($p['item_image1_display'] == 1 && $v->image != '') {

            if ($p['item_image1_type'] == 'original') {
                $imageO = $path['itemimage']['orig_rel_ds'] . $v->image;
            } else {

                $image  = PhocacartImage::getThumbnailName($path['itemimage'], $v->image, $p['item_image1_type']);
                $imageO = isset($image->rel) && $image->rel != '' ? $image->rel : '';
            }


            if ($imageO != '') {
                echo '<div class="ph-image1-' . $i . '" data-swiper-parallax="-100"><img src="' . JURI::base()  . $imageO . '" alt="" /></div>';
            }
        }

        // BUTTON
        if ($p['item_button_title'] != '') {

            if ($p['item_button_link_type'] == 1) {

                $link = Route::_(PhocacartRoute::getItemRoute($v->id, $v->category_id, $v->alias, $v->category_alias));

                echo '<a href="' . $link . '">';
            }

            echo '<div class="ph-button-' . $i . '" data-swiper-parallax="-100"><div class="ph-button-text ph-button-text-' . $i . '">' . $p['item_button_title'] . '</div></div>';

            if ($p['item_button_link_type'] == 1) {
                echo '</a>';
            }
        }

        // COUNTDOWN
        echo '<div class="ph-countdown-' . $i . '" data-swiper-parallax="-100"><div id="phSCTCountDown' . $i . '"></div></div>';

        echo '</div>';
        $i++;
    }
}

echo '</div>';

if ($p['dots'] == 1) {
    echo '<div class="swiper-pagination swiper-pagination-white"></div>';
}

/* &nbsp; is here because of IE 11 */
echo ' ';

if ($p['nav'] == 1) {
    echo '<div class="swiper-button-prev swiper-button-white"></div>';
    echo '<div class="swiper-button-next swiper-button-white"></div>';
}

echo '</div>';// end wrapper

echo '</div>';// end id

?>
