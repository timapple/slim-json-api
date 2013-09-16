<?php
/**
 * jsonAPI - Slim extension to implement fast JSON API's
 *
 * @package Slim
 * @subpackage View
 * @author Jonathan Tavares <the.entomb@gmail.com>
 * @license GNU General Public License, version 3
 * @filesource
 *
 *
*/


/**
 * JsonApiView - view wrapper for json responses (with error code).
 *
 * @package Slim
 * @subpackage View
 * @author Jonathan Tavares <the.entomb@gmail.com>
 * @license GNU General Public License, version 3
 * @filesource
 */
class JsonApiView extends \Slim\View {

    /**
    * Bitmask consisting of JSON_HEX_QUOT, JSON_HEX_TAG, JSON_HEX_AMP, JSON_HEX_APOS, JSON_NUMERIC_CHECK, 
    * JSON_PRETTY_PRINT, JSON_UNESCAPED_SLASHES, JSON_FORCE_OBJECT, JSON_UNESCAPED_UNICODE.
    */
    public $options = 0;
    
    public function __construct($options = 0) {
        parent::__construct();
        $this->options = $options;
    }
    
    public function render($status = 200) {
        $app = \Slim\Slim::getInstance();

        $status = intval($status);

        //append error bool
        if (!$this->has('error')) {
            $this->set('error', false);
        }

        //append status code
        $this->set('status', $status);

        $app->response()->status($status);
        $app->response()->header('Content-Type', 'application/json');
        $app->response()->body(json_encode($this->all(), $this->options));

        $app->stop();
    }

}
