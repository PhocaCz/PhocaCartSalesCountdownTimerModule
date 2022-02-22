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
defined('_JEXEC') or die('Restricted access');// no direct access

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

if (!ComponentHelper::isEnabled('com_phocacart', true)) {
    $app = Factory::getApplication();
    $app->enqueueMessage(Text::_('Phoca Cart Error'), Text::_('Phoca Cart is not installed on your system'), 'error');
    return;
}

JLoader::registerPrefix('Phocacart', JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/phocacart');

$lang = Factory::getLanguage();
$lang->load('com_phocacart');

$app      = Factory::getApplication();
$document = Factory::getDocument();
$document = Factory::getDocument();
$media    = PhocacartRenderMedia::getInstance('main');
//$media->loadBase();
//$media->loadBootstrap();
//$media->loadSpec();
$s = PhocacartRenderStyle::getStyles();

$p                                        = array();
$p['animation_speed']                     = $params->get('animation_speed', 600);
$p['autoplay']                            = $params->get('autoplay', 1);
$p['autoplay_speed']                      = $params->get('autoplay_speed', 1000);
$p['nav']                                 = $params->get('nav', 1);
$p['dots']                                = $params->get('dots', 1);
$p['height']                              = $params->get('height', '');
$p['fill_rest_page']                      = $params->get('fill_rest_page', 1);
$p['fill_rest_page_ratio']                = $params->get('fill_rest_page_ratio', '2');
$p['background_image']                    = $params->get('background_image', '');
$p['background_video']                    = $params->get('background_video', '');
$p['display_view']                        = $params->get('display_view', '');
$p['display_option']                      = $params->get('display_option', '');
$p['display_min_width']                   = $params->get('display_min_width', 0);
$p['item_title_css']                      = $params->get('item_title_css', 'animation-duration: 5s; animation-delay: 0s; position: absolute; left: 6%; top: 15%; font-size: 3vw; z-index: 1000; text-align: center; color: #555; background-color: rgba(255,255,255,0.5); padding: 0 0.5vw;');
$p['item_title_animation']                = $params->get('item_title_animation', '');
$p['item_price_css']                      = $params->get('item_price_css', 'animation-duration: 5s; animation-delay: 0s; position: absolute; left: 60%; bottom: 40%; font-size: 3vw; z-index: 1000; text-align: center; color: #fff; background-color: rgba(0,0,0,0.5); padding: 0 0.5vw;');
$p['item_price_animation']                = $params->get('item_price_animation', '');
$p['item_stock_display']                  = $params->get('item_stock_display', 0);
$p['item_stock_check']                    = $params->get('item_stock_check', 1);
$p['item_stock_text_prefix']              = $params->get('item_stock_text_prefix', '');
$p['item_stock_text_suffix']              = $params->get('item_stock_text_suffix', '');
$p['item_stock_css']                      = $params->get('item_stock_css', 'animation-duration: 5s; animation-delay: 0s; position: absolute; left: 60%; bottom: 30%; font-size: 1vw; z-index: 1000; text-align: left; color: #fff; background-color: rgba(0,0,0,0.5); padding: 0 0.5vw;');
$p['item_stock_animation']                = $params->get('item_stock_animation', '');
$p['item_description_display']            = $params->get('item_description_display', 0);
$p['item_description_css']                = $params->get('item_description_css', 'animation-duration: 5s; animation-delay: 0s; position: absolute; left: 6%; top: 25%; font-size: 1.5vw; z-index: 1000; text-align: left; color: #555; background-color: rgba(255,255,255,0.5); padding: 0 0.5vw;');
$p['item_description_animation']          = $params->get('item_description_animation', '');
$p['item_discount_description_display']   = $params->get('item_discount_description_display', 1);
$p['item_discount_description_css']       = $params->get('item_discount_description_css', 'animation-duration: 5s; animation-delay: 0s; position: absolute; left: 60%; bottom: 35%; font-size: 1.5vw; z-index: 1000; text-align: left; color: #fff; background-color: rgba(0,0,0,0.5); padding: 0 0.5vw;');
$p['item_discount_description_animation'] = $params->get('item_discount_description_animation', '');
$p['item_button_title']                   = $params->get('item_button_title', '');
$p['item_button_link_type']               = $params->get('item_button_link_type', 1);
$p['item_button_css']                     = $params->get('item_button_css', 'animation-duration: 5s; animation-delay: 0s; position: absolute; right: 5%; bottom: 17%; font-size: 1.5vw; text-transform:uppercase; font-weight: bold; text-align: center; z-index: 1000; color: #fff; background-color: #EB008A; border-radius: 0.3vw; padding: 1vw;');
$p['item_button_animation']               = $params->get('item_button_animation', '');
$p['item_image1_display']                 = $params->get('item_image1_display', 0);
$p['item_image1_type']                    = $params->get('item_image1_type', 'medium');
$p['item_image1_css']                     = $params->get('item_image1_css', 'animation-duration: 5s; animation-delay: 2s; position: absolute; bottom: 20%; left: 7%; z-index: 1002;');
$p['item_image1_animation']               = $params->get('item_image1_animation', '');
$p['item_image1_size_css']                = $params->get('item_image1_size_css', '');
$p['item_countdown_text_prefix']          = $params->get('item_countdown_text_prefix', '');
$p['item_countdown_text_suffix']          = $params->get('item_countdown_text_suffix', '');
$p['item_countdown_css']                  = $params->get('item_countdown_css', 'animation-duration: 5s; animation-delay: 0s; position: absolute; right: 0%; bottom: 0%; font-size: 5vw; text-align: right; z-index: 1000; width: 100%; color: #fff; background-color: rgba(0,0,0,0.5); padding: 0 0.5vw;');
$p['item_countdown_animation']            = $params->get('item_countdown_animation', '');
$p['item_ignore_quantity_rule']           = $params->get('item_ignore_quantity_rule', 1);
$p['item_background_image_animation']     = $params->get('item_background_image_animation', '');
$p['item_limit']                          = $params->get('item_limit', 1);
$p['load_animate_css']                    = $params->get('load_animate_css', 1);
$p['load_swiper_library']                 = $params->get('load_swiper_library', 1);
$p['item_countdown_skip_days']            = $params->get('item_countdown_skip_days', 0);
$p['display_featured']                    = $params->get('display_featured', 0);

//$layout           							= $params->get('layout', 'default');

$view   = $app->input->get('view', '');
$option = $app->input->get('option', '');

$optionA = array_map('trim', explode(',', $p['display_option']));// Remove spaces
$viewA   = array_map('trim', explode(',', $p['display_view']));
$optionA = array_filter($optionA);// Remove empty values from array
$viewA   = array_filter($viewA);


if (empty($optionA) && empty($viewA)) {
    // OK - both parameters are not set
} else if (!empty($optionA) && in_array($option, $optionA) && empty($viewA)) {
    // OK - only option is set and it meets the criteria
} else if (!empty($optionA) && in_array($option, $optionA) && !empty($viewA) && in_array($view, $viewA)) {
    // OK - option and view is set and it meets the criteria
} else {
    return '';
}

$discountParams = array();
if ($p['item_limit'] > 0) {
    $discountParams['limit'] = (int)$p['item_limit'];
}
$discountParams['stock_check'] = (int)$p['item_stock_check'];
$items = PhocacartDiscountProduct::getProductsDiscounts($discountParams);


$t = array();
$t['featured'] = false;
if (empty($items) || !isset($items[0]->discount_id)) {

    // No discount product, try to find featured
    if ($p['display_featured'] == 1) {
        $items         = PhocacartDiscountProduct::getProductsFeatured($discountParams);
        $t['featured'] = true;

        if (empty($items) || !isset($items[0]->id)) {
            return '';
        }
    } else {
        return '';
    }
}


if ($p['load_animate_css'] == 1) {
    $media->loadAnimateCss();
}
if ($p['load_swiper_library'] == 1) {
    $media->loadSwiper();
}

HTMLHelper::_('stylesheet', 'media/mod_phocacart_sales_countdown_timer/css/style.css', array('version' => 'auto'));

$path              = array();
$path['media'] = JUri::base();
$path['itemimage'] = PhocacartPath::getPath('productimage');


$rand = rand(10000, 99999);
$id   = 'ph-mod-sales-countdown-timer-' . $rand;
$idJs = 'pS' . $rand;

$s = array();
// STYLE

if (!empty($items)) {

    $i = 0;
    foreach ($items as $k => $v) {

        if (isset($v->background_image) && $v->background_image != '') {



            //$s[] = '#'.$id.' .ph-swiper-slide-box-'.$i.' {';
            //$s[] = '    position:relative;';
            //$s[] = '    overflow: hidden;';
            //$s[] = '}';

            $s[] = '#' . $id . ' .ph-swiper-slide-box-bg-' . $i . ' {'; // X because kenburnsBottomLeft does not fit the width
            //$s[] = '#' . $id . ' .ph-swiper-slide-box-' . $i . ' {';
            $s[] = '    background-image:url(' . JUri::base() . /*$path['itemimage']['orig_rel_ds'] .*/ $v->background_image . ');';
            $s[] = '    -webkit-background-size: cover;';
            $s[] = '    background-size: cover;';
            $s[] = '    background-position: center;';
            $s[] = '}';

        }

        $s[] = '#' . $id . ' .ph-title-' . $i . ' {';
        $s[] = '    ' . $p['item_title_css'] . '';
        $s[] = '    display:none;';
        $s[] = '}';

        $s[] = '#' . $id . ' .ph-price-' . $i . ' {';
        $s[] = '    ' . $p['item_price_css'] . '';
        $s[] = '    display:none;';
        $s[] = '}';

        if ($p['item_description_display'] == 1 && $v->description != '') {
            $s[] = '#' . $id . ' .ph-product-description-' . $i . ' {';
            $s[] = '    ' . $p['item_description_css'] . '';
            $s[] = '    display:none;';
            $s[] = '}';
        }

        if ($p['item_discount_description_display'] == 1 && isset($v->discount_description) && $v->discount_description != '') {
            $s[] = '#' . $id . ' .ph-discount-description-' . $i . ' {';
            $s[] = '    ' . $p['item_discount_description_css'] . '';
            $s[] = '    display:none;';
            $s[] = '}';
        }

        if ($p['item_stock_display'] == 1 && $v->stock != '') {
            $s[] = '#' . $id . ' .ph-stock-' . $i . ' {';
            $s[] = '    ' . $p['item_stock_css'] . '';
            $s[] = '    display:none;';
            $s[] = '}';
        }

        if ($p['item_button_title'] != '') {
            $s[] = '#' . $id . ' .ph-button-' . $i . ' {';
            $s[] = '    ' . $p['item_button_css'] . '';
            $s[] = '    display:none;';
            $s[] = '}';
        }


        $s[] = '#' . $id . ' .ph-countdown-' . $i . ' {';
        $s[] = '    ' . $p['item_countdown_css'] . '';
        $s[] = '    display:none;';
        $s[] = '}';


        if ($v->image != '') {
            $s[] = '#' . $id . ' .ph-image1-' . $i . ' {';
            $s[] = '    ' . $p['item_image1_css'] . '';
            $s[] = '    display:none;';
            $s[] = '}';

            $s[] = '#' . $id . ' .ph-image1-' . $i . ' img {';
            $s[] = '    ' . $p['item_image1_size_css'] . '';
            // $s[] = '    display:none;';
            $s[] = '}';
        }

        $i++;
    }

    $s[] = '#' . $id . ' .swiper-container.ph-mod-sct-swiper-container {';
    $s[] = '    width: 100%;';
    if ($p['fill_rest_page'] == 0) {
        $s[] = '    height: ' . $p['height'] . ';';
    }
    $s[] = '    background: transparent;';
    $s[] = '}';

    //$s[] = '#'.$id.' .swiper-slide {}';

    $s[] = '#' . $id . ' .parallax-bg {';
    $s[] = '    position: absolute;';
    $s[] = '    left: 0;';
    $s[] = '    top: 0;';
    $s[] = '    width: 130%;';
    $s[] = '    height: 100%;';
    $s[] = '    -webkit-background-size: cover;';
    $s[] = '    background-size: cover;';
    $s[] = '    background-position: center;';
    if ($p['background_image'] != '') {
        $s[] = '    background-image:url(' . JURI::base() . $p['background_image'] . ');';
    }
    $s[] = '}';


    $s[] = '#' . $id . ' .ph-video-bg {';
    $s[] = '    position: absolute;';
    $s[] = '    width: 100%;';
    $s[] = '    object-fit: cover;';
    $s[] = '    right: 0;';
    $s[] = '    left: 0;';
    $s[] = '    overflow: hidden;';
    $s[] = '}';


}

$document->addCustomTag("\n<style type=\"text/css\">\n\n" . implode("\n", $s) . "\n</style>\n\n");


$js = array();


$js[] = '   function phReset($elem) {';
$js[] = '       $elem.before($elem.clone(true));';
$js[] = '     	var $newElem = $elem.prev();';
$js[] = '     	$elem.remove();';
$js[] = '     	return $newElem;';
$js[] = ' 	}';

$js[] = '   function phStartAnimation(item, aClass) {';
$js[] = '       var a = jQuery(".swiper-slide-active "+item);';
$js[] = '       var p = jQuery(".swiper-slide-prev "+item);';
$js[] = '       var n = jQuery(".swiper-slide-next "+item);';

$js[] = '       a.removeClass(aClass);';
$js[] = '       a = phReset(a);';
$js[] = '       a.addClass(aClass);';
$js[] = '       a.show();';

$js[] = '       p.hide();';
$js[] = '       n.hide();';
$js[] = '   }';

$js[] = '   function phStartAnimationBackground(item, aClass) {';
$js[] = '   	var a = jQuery(".swiper-slide-active "+item);'; // NO: .ph-swiper-slide-box-bg-, YES: .ph-swiper-slide-box-
//$js[] = '   	var a = jQuery(item + ".swiper-slide-active");';
$js[] = '   	a.removeClass(aClass);';
$js[] = '   	a = phReset(a);';
$js[] = '   	a.addClass(aClass);';
$js[] = '   }';


$js[] = '   var swiper' . $idJs . ' = Swiper;';
$js[] = '   var init' . $idJs . ' = false;';

$js[] = '   function phSwiperMode' . $idJs . '() {';
$js[] = '      var minWidth = window.matchMedia(\'(min-width: ' . (int)$p['display_min_width'] . 'px)\');';

$js[] = '     if(minWidth.matches) {';
$js[] = '        if (!init' . $idJs . ') {';
$js[] = '           init' . $idJs . ' = true;';
$js[] = '           jQuery("#' . $id . ' .swiper-container").show();';

$js[] = '   		swiper' . $idJs . ' = new Swiper(".ph-mod-sct-swiper-container", {';
$js[] = '   			speed: ' . (int)$p['animation_speed'] . ',';
if ($p['autoplay'] == 1) {
    $js[] = '       autoplay: { delay: ' . (int)$p['autoplay_speed'] . ' },';
} else {
    $js[] = '       autoplay: false,';
}
$js[] = '       parallax: false,';
if ($p['dots'] == 1) {
    $js[] = '   	pagination: {';
    $js[] = '    	    el: ".swiper-pagination",';
    $js[] = '       	clickable: true,';
    $js[] = '    	},';
}
if ($p['nav'] == 1) {
    $js[] = '     	navigation: {';
    $js[] = '      	    nextEl: ".swiper-button-next",';
    $js[] = '     	    prevEl: ".swiper-button-prev",';
    $js[] = '     	},';
}
$js[] = '   		});';


if ($p['fill_rest_page'] > 0) {
    //$js[] = '   var phSwiperTop 		= jQuery(".swiper-container").position().top;';
    $js[] = '   var phSwiperTop 		= jQuery("#' . $id . '").offset().top;';
    $js[] = '   var phSwiperWidth		= jQuery(".swiper-container").width();';
    $js[] = '   var phWindowHeight		= jQuery(window).height();';

    $js[] = '   var phWindowHeightRatio	= 1;';
    if ($p['fill_rest_page'] == 2) {
        $js[] = '   var phWindowHeightRatio	= 0.5';
    } else if ($p['fill_rest_page'] == 3) {
        $js[] = '   var phWindowHeightRatio	= 0.67';
    } else if ($p['fill_rest_page'] == 4) {
        $js[] = '   var phWindowHeightRatio	= 0.75';
    }

    $js[] = '   var phRestPageHeight	= (phWindowHeight - phSwiperTop) * phWindowHeightRatio;';
    $js[] = '   if (phSwiperWidth < phRestPageHeight) {';
    if ($p['fill_rest_page_ratio'] > 0) {
        $js[] = '       phRestPageHeight = phSwiperWidth/' . $p['fill_rest_page_ratio'] . ';';
    } else {
        $js[] = '       phRestPageHeight = phSwiperWidth;';
    }
    $js[] = '   }';
    $js[] = '   jQuery(".swiper-container.ph-mod-sct-swiper-container").height(phRestPageHeight);';
    $js[] = '   jQuery(".ph-video-bg").height(phRestPageHeight);';
}

/* Start animation of items when transition of slide ends*/
$js[] = '   swiper' . $idJs . '.on("transitionEnd", function () {';
if (!empty($items)) {
    $i = 0;
    foreach ($items as $k => $v) {
        $js[] = '      phStartAnimation(".ph-title-' . $i . '", "animated ' . $p['item_title_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-price-' . $i . '", "animated ' . $p['item_price_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-product-description-' . $i . '", "animated ' . $p['item_description_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-discount-description-' . $i . '", "animated ' . $p['item_discount_description_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-stock-' . $i . '", "animated ' . $p['item_stock_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-image1-' . $i . '", "animated ' . $p['item_image1_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-button-' . $i . '", "animated ' . $p['item_button_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-countdown-' . $i . '", "animated ' . $p['item_countdown_animation'] . '");';


        $i++;
    }
}
$js[] = '   });';

$js[] = '   swiper' . $idJs . '.on("transitionStart", function () {';
if (!empty($items)) {
    $i = 0;
    foreach ($items as $k => $v) {
        $js[] = '   	phStartAnimationBackground(".ph-swiper-slide-box-bg-' . $i . '", "animated ' . $p['item_background_image_animation'] . '");';
        $i++;
    }
}
$js[] = '   });';

/* Start animation of items at start of slideshow */
if (!empty($items)) {
    $i = 0;
    foreach ($items as $k => $v) {
        $js[] = '      phStartAnimation(".ph-title-' . $i . '", "animated ' . $p['item_title_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-price-' . $i . '", "animated ' . $p['item_price_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-product-description-' . $i . '", "animated ' . $p['item_description_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-discount-description-' . $i . '", "animated ' . $p['item_discount_description_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-stock-' . $i . '", "animated ' . $p['item_stock_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-image1-' . $i . '", "animated ' . $p['item_image1_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-button-' . $i . '", "animated ' . $p['item_button_animation'] . '");';
        $js[] = '      phStartAnimation(".ph-countdown-' . $i . '", "animated ' . $p['item_countdown_animation'] . '");';

        if ($p['item_background_image_animation'] != '') {
            $js[] = '      phStartAnimationBackground(".ph-swiper-slide-box-bg-' . $i . '", "animated ' . $p['item_background_image_animation'] . '");';
        }
        $i++;
    }
}


$js[] = '        }';// end Init
$js[] = '     } else {'; // end minWidth.matches

$js[] = '        if(typeof swiper' . $idJs . ' !== \'undefined\' && typeof swiper' . $idJs . '.destroy === \'function\'){';
$js[] = '           swiper' . $idJs . '.destroy();';
$js[] = '           swiper' . $idJs . ' = undefined;';
$js[] = '        }';
$js[] = '        jQuery("#' . $id . ' .swiper-container").hide();';
$js[] = '        init' . $idJs . ' = false;';
$js[] = '     }';// end minWidth.matches

$js[] = '  }';// end phSwiperMode


// Disable on small screen, disable when the width is smaller than
//if ((int)$p['hide_small_displays'] > 0) {
//	$js[] = '  } else {';
//	$js[] = '  	  jQuery(".swiper-container").hide();';
//	$js[] = '  }';
//}


// Countdown
$cdPrefix = '<span class="ph-mod-sct-countdown-text-prefix">' . Text::_($p['item_countdown_text_prefix'], true) . '</span>';
$cdSuffix = '<span class="ph-mod-sct-countdown-text-suffix">' . Text::_($p['item_countdown_text_suffix'], true) . '</span>';
if (!empty($items)) {
    $i = 0;
    foreach ($items as $k => $v) {

        if (isset($v->discount_valid_to) && $v->discount_valid_to != '0000-00-00 00:00:00') {

            $validTo = str_replace('00:00:00', '23:59:59', $v->discount_valid_to);


            $js[] = 'var phSCTountDownDate' . $i . ' = new Date("' . $validTo . '").getTime();';
            $js[] = 'var phSCTX' . $i . ' = setInterval(function() {';

            $js[] = '  var now = new Date().getTime();';
            $js[] = '  var distance = phSCTountDownDate' . $i . ' - now;';

			if ($p['item_countdown_skip_days'] == 1) {
				$js[] = '  var days = 0;';
				$js[] = '  var hours = Math.floor(distance / (1000 * 60 * 60));';
			} else {
				$js[] = '  var days = Math.floor(distance / (1000 * 60 * 60 * 24));';
				$js[] = '  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));';
			}






		   $js[] = '  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));';
            $js[] = '  var seconds = Math.floor((distance % (1000 * 60)) / 1000);';

            $js[] = ' var daysO = days + "' . Text::_('MOD_PHOCACART_SALES_COUNTDOWN_TIMER_COUNTDOWN_SHORTCUT_TEXT_DAY', true) . '";';


            if ($p['item_countdown_skip_days'] == 1) {
                $js[] = ' var hoursL = hours.toString().length;';
                $js[] = ' if (hoursL < 3) {';
                $js[] = '    var hoursO = ("0" + hours.toString()).slice(-2) + "' . Text::_('MOD_PHOCACART_SALES_COUNTDOWN_TIMER_COUNTDOWN_SHORTCUT_TEXT_HOUR', true) . '";';
                $js[] = ' } else {';
                $js[] = '    var hoursO = (hours.toString()) + "' . Text::_('MOD_PHOCACART_SALES_COUNTDOWN_TIMER_COUNTDOWN_SHORTCUT_TEXT_HOUR', true) . '";';
                $js[] = ' }';
            } else {
                $js[] = ' var hoursO = ("0" + hours.toString()).slice(-2) + "' . Text::_('MOD_PHOCACART_SALES_COUNTDOWN_TIMER_COUNTDOWN_SHORTCUT_TEXT_HOUR', true) . '";';
            }
            $js[] = ' var minutesO = ("0" + minutes.toString()).slice(-2) + "' . Text::_('MOD_PHOCACART_SALES_COUNTDOWN_TIMER_COUNTDOWN_SHORTCUT_TEXT_MINUTE', true) . '";';
            $js[] = ' var secondsO = ("0" + seconds.toString()).slice(-2) + "' . Text::_('MOD_PHOCACART_SALES_COUNTDOWN_TIMER_COUNTDOWN_SHORTCUT_TEXT_SECOND', true) . '";';

            $js[] = ' if (days == 0) {daysO = "";}';
            $js[] = ' if (hours == 0 && days == 0) {hoursO = "";}';
            $js[] = ' if (minutes == 0 && hours == 0 && days == 0) {minutesO = "";}';
            // $js[] = ' if (seconds != 0) {secondsO = seconds + "s ";}';

            $js[] = '  document.getElementById("phSCTCountDown' . $i . '").innerHTML = \'' . $cdPrefix . '\' + daysO + hoursO + minutesO + secondsO + \'' . $cdSuffix . '\';';

            $js[] = '  if (distance < 0) {';
            $js[] = '    clearInterval(phSCTX' . $i . ');';
            $js[] = '    document.getElementById("phSCTCountDown' . $i . '").innerHTML = \'' . Text::_('MOD_PHOCACART_SALES_COUNTDOWN_TIMER_EXPIRED', true) . '\';';
            $js[] = '  }';
            $js[] = '}, 1000);';

            $i++;
        }
    }
}


//$js[] = ' jQuery(window).on(\'load\', function() {';
/*
$js[] = '  window.addEventListener(\'load\', function() {';
$js[] = '      phSwiperMode' . $idJs . '();';
$js[] = '  });';

$js[] = '  jQuery(window).on(\'load\', function() {';
$js[] = '      phSwiperMode' . $idJs . '();';
$js[] = '  });';
*/

// Start on document ready/window load
$js[] = ' jQuery(window).on(\'load\', function() {';
$js[] = '      phSwiperMode' . $idJs . '();';
$js[] = '   });';// document ready/window load

$js[] = ' jQuery( document ).ready(function() {';
$js[] = '   });';// document ready/window load


$document->addScriptDeclaration(implode("\n", $js));

require(ModuleHelper::getLayoutPath('mod_phocacart_sales_countdown_timer', $params->get('layout', 'default')));
?>
