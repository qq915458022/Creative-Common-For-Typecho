<?php
/**
 * 署名我的知识产权 < Creative Common
 *
 * @category tools
 * @package Creative Common
 * @author qq915458022
 * @version 1.0
 * @link https://ifengge.cn
 */
class CC_Plugin implements Typecho_Plugin_Interface
{
		private static $_defaultConfig = array(
        'default_license' => 'by-nc-sa',
    );
    
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->singleHandle = array('CC_Plugin', 'singleHandle');
		}
    
    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
    		$defaultConfig = self::getDefaultConfig(); //获取配置
    		
    		//设置默认协议
        $name = new Typecho_Widget_Helper_Form_Element_Select('default_license',array('no' => '不保留权利' , 'by' => '署名（BY）','by-nd' => '署名（BY）- 禁止演绎（ND）','by-nc' => '署名（BY）- 非商业性使用（NC）','by-sa' => '署名（BY）- 相同方式共享（SA）','by-nc-nd' => '署名（BY）- 非商业性使用（NC）- 禁止演绎（ND）','by-nc-sa' => '署名（BY）- 非商业性使用（NC）- 相同方式共享（SA）' , 'all' => '保留所有权利'),$defaultConfig->default_license,_t('默认证书'),_t('所有没有单独注明的文章均会自动采用该协议进行授权'));
        $form->addInput($name);
    }
    
    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
        
    /**
     * 插件的实现方法
     *
     * @access public
     * @return void
     */
    
    public static function singleHandle($archive,$select) 
    {
        $currentPath = Helper::options()->pluginUrl . '/CC/';

        echo '<script type="text/javascript" src="https://static.ifengge.cn/js/jquery.min.js"></script>' . "\n";
        
        $license = self::getConfig() -> default_license;
        
        //在此为每个页面进行单独设置
        switch($archive->cid){
        	case 121:
        		$license = "all";
        		break;
        }
        echo '<script type="text/javascript" src="' . $currentPath . 'scripts/ccommon.js?license='.$license.'"></script>' . "\n";
    }
    
    private static function getDefaultConfig($key = null)
    {
        if( isset($key) )
            return self::$_defaultConfig[$key];
        return (object)self::$_defaultConfig;
    }
    
    private static function getConfig($key = null){
    	if(isset($key)){
    		$options = Helper::options();
        $plugin_options = $options -> plugin('CC');
        return $plugin_options -> $key;
      }
      return (object)(Helper::options() -> plugin('CC'));
    }
}
 