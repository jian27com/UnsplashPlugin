<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
/**
 * 调用Unsplash图片 前端调用  &lt;?php UnsplashPlugin_Plugin::header(); ?&gt;
 * 
 * @package UnsplashPlugin_Plugin
 * @author 剑二十七
 * @version 1.0.0
 * @link https://www.jian27.com
 */

class UnsplashPlugin_Plugin implements Typecho_Plugin_Interface
{
    public static function activate()
    {
    }

    public static function deactivate()
    {
    }

    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $resolution = new Typecho_Widget_Helper_Form_Element_Text(
            'resolution', NULL, '640x480', _t('图片分辨率'), _t('输入图片的尺寸比如640x480')
        );
        $form->addInput($resolution);

        $keywords = new Typecho_Widget_Helper_Form_Element_Text(
            'keywords', NULL, '', _t('图片关键词'), _t('比如horse')
        );
        $form->addInput($keywords);
    }

    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    public static function header()
    {
        $options = Helper::options()->plugin('UnsplashPlugin');
        $resolution = $options->resolution;
        $keywords = $options->keywords;

        $url = "https://source.unsplash.com/random/$resolution/";
        if (!empty($keywords)) {
            $url .= "?$keywords";
        }
        
        echo '<img src="' . $url . '" alt="Unsplash Image">';
    }

    public static function render()
    {
        $options = Typecho_Widget::widget('Widget_Options')->plugin('UnsplashPlugin');
        $form = new Typecho_Widget_Helper_Form($options->pluginUrl);
        self::config($form);
        echo '<h2>Unsplash Plugin Settings</h2>';
        $form->render();
    }
}
