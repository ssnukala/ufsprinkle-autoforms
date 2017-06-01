<?php

/**
 * Database based forms (http://srinivasnukala.com)
 *
 * @link      https://github.com/ssnukala/ufsprinkle-autoforms
 * @copyright Copyright (c) 2013-2016 Srinivas Nukala
 */

namespace UserFrosting\Sprinkle\AutoForms\Controller;

use Carbon\Carbon;
use UserFrosting\Sprinkle\Core\Controller\SimpleController;
use UserFrosting\Support\Exception\ForbiddenException;
use UserFrosting\Sprinkle\Core\Util\EnvironmentInfo;
use UserFrosting\Fortress\ServerSideValidator;
use UserFrosting\Sprinkle\AutoForms\RequestSchema;
use UserFrosting\Fortress\Adapter\JqueryValidationAdapter;
use UserFrosting\Sprinkle\AutoForms\Model\AutoFormSource;
use UserFrosting\Sprinkle\AutoForms\Model\Formfields;
use UserFrosting\Sprinkle\AutoForms\Model\Lookup;
use UserFrosting\Sprinkle\Core\Facades\Debug as Debug;
use UserFrosting\Sprinkle\SnUtilities\Controller\SnDBUtilities as SnDbUtil;
use UserFrosting\Sprinkle\SnUtilities\Controller\SnUtilities as SnUtil;

/**
 * FormfieldsController
 *
 * @author Srinivas Nukala
 * @link http://srinivasnukala.com
 */
class FormfieldsController extends SimpleController {

    protected $_source = 'not_set';       // form field source 
    protected $_db_table = 'not_set';       // form field source 
    protected $_columns = [];       // form field source 
    protected $_fields = [];       // fields array
    protected $_page_prefix = 'sdf_';       // template
    protected $_page_type = 'form';       // template
    protected $_secure_page = false;       // template
    protected $_html_template = "pages/ffpage-default.html.twig";       // template
    protected $_js_template = "pages/ffpage-default.js.twig";       // template
    protected $_schema = "/dbform/dbform-schema.json";       // schema file 
    protected $_formdata = [];       // data
    protected $_ffpage = [];
    protected $_messages = [];
    protected $_validators = [];
    protected $_rules = [];
    protected $_notification = ['save' => false];
    protected $_faarray = ['text' => 'fa fa-fw fa-edit', 'email' => 'fa fa-fw fa-envelope',
        'password' => 'fa fa-fw fa-key', 'captcha' => 'fa fa-fw fa-eye',
        'date' => 'fa fa-fw fa-calendar', 'datetime' => 'fa fa-fw fa-calendar',
        'number' => 'fa fa-fw fa-hashtag', 'phone' => 'fa fa-fw fa-hashtag'];

    public function initializeFFController($source, $dbtable = '', $prefix = 'dbf_', $html_template = 'default', $js_template = 'default', $schema = 'default', $secure = false, $pagetype = 'form') {
        $this->_source = $source;
        $this->_db_table = $dbtable;
        $this->_secure_page = $secure;
        $this->_page_prefix = $prefix;
        $this->_page_type = $pagetype;
        if ($html_template == 'default') {
            $html_template = "pages/ffpage-default.html.twig";
        }
        $this->_html_template = $html_template;

        if ($js_template == 'default') {
            $js_template = "pages/ffpage-default.js.twig";
        }
        $this->_js_template = $js_template;

//error_log("Line 60 schema is $schema");
        if ($schema == 'default') {
            $schema = "/dbform/dbform-schema.json";
        }
        $this->_schema = $schema;       // schema
//        $cur_ff_table = Formfields::fetchAllLocal($source);
        $this->getFieldDefinitions($source);
//        $cur_ff_table = Formfields::getFieldDefinitions($source);        
//        $this->_fields = $cur_ff_table['fields'];
//        $this->_db_columns = array_keys($this->_fields);
        $this->initializePageFields();
//        Debug::debug("Line 80 Fields when initialized", $this->_fields);
//logarr($this->_db_columns,"Line 81 Columns when initialized");  
//SnDbUtil::getMigrationDataArray('sevak_formfields');        
        
    }

    public function getFields() {
        return $this->fields;
    }

    public function getMessages() {
        return $this->_messages;
    }

    public function setMessages($messages) {
        $this->_messages = $messages;
    }

    public function getRules() {
        return $this->_rules;
    }

    public function setRules($rules) {
        $this->_rules = $rules;
    }

    public function getFieldNames() {
        return $this->_db_columns;
    }

    public function getFieldDefinitions($source = '') {
        if ($source == '') {
            $source = $this->_source;
        }
        $form_fields = Formfields::getFieldDefinitions($source);
        $this->_fields = $form_fields['fields'];
        $this->_db_columns = array_keys($form_fields['fields']);
    }

    public function initializePageFields($par_tabdef = 'none') {
        if ($par_tabdef == 'none')
            $par_tabdef = $this->_fields;
        $var_colspan = 0;
        $var_datatable_cols = $var_allcols = array();
        $var_lookupcache = array();
        foreach ($par_tabdef as &$var_column) {
//logarr($var_column,"Line 117 the column is ");            
            if (isset($this->_faarray[$var_column['type']]))
                $var_column['addon'] = $this->_faarray[$var_column['type']];

            if (in_array($var_column['type'], ['select', 'checkbox', 'radio'])) {
                $var_column['addon'] = '';
                if ($var_column['lookup_category'] != '' && isset($var_lookupcache[$var_column['lookup_category']])) {
                    $var_column['options'] = $var_lookupcache[$var_column['lookup_category']];
                } else if ($var_column['lookup_category'] != '') {
                    $cur_lookup_values_full = Lookup::getLookupValues($var_column['lookup_category']);
//error_log("Line 126 lookup category is ".$var_column['lookup_category']);                    
                    $var_lookupcache[$var_column['lookup_category']] = $var_column['options'] = $cur_lookup_values_full[$var_column['lookup_category']];
                } else {
// lookup category is not set so make this an editable field                        
                    $var_column['type'] = 'text';
                    $var_column['addon'] = 'fa fa-fw fa-edit';
                }
            }
        }
        $this->_fields = $par_tabdef;

        if ($this->_schema != 'none') {
            $ffschema = new RequestSchema("schema://" . $this->_schema);
            $ffvalidator = new JqueryValidationAdapter($ffschema, $this->ci->translator);
            $var_pagerules = $ffvalidator->rules('json', false);
            $this->_rules = $var_pagerules['rules'];
            //            unset($var_pagerules['rules']);
            $this->_messages = $var_pagerules['messages'];
        }
    }

    public function getFFPageHTMLJS($pageparams = [], $htmlonly = false) {
        $this->createFormfieldPage($pageparams, $htmlonly);
SnUtil::logarr($this->_ffpage,"Line 104 returning ffpage array");        
        return $this->_ffpage;
    }

    public function getValidatorJSON($validator) {
        if (is_array($validator))
            return $var_messages = json_encode($validator, JSON_PRETTY_PRINT);
        else
            return false;
    }

    /**
     * Attempts to render the account registration page for UserFrosting.
     *
     * This allows new (non-authenticated) users to create a new account for themselves on your website.
     * Request type: GET
     * @param bool $can_register Specify whether registration is enabled.  If registration is disabled, they will be redirected to the login page. 
     */
    public function createFormfieldPage($pageparams = [], $htmlonly = false) {

SnUtil::logarr($pageparams,"Line 133 pageparams ");
SnUtil::logarr($this->_fields,"Line 116 rendernig the page now ".$this->_html_template);   
        $this->getFFHTML($pageparams);
        $this->getValidators();
        if (!$htmlonly) {
            $this->getFFJS($pageparams);
        }
//        $settings = $this->_app->site;
    }

    public function getFFHTML($params) {
SnUtil::logtxt("Line 116 rendernig the page now " . $this->_html_template);
        $params['fields']=$this->_fields;
        $this->_ffpage['html'] = $this->ci->view->fetch($this->_html_template, [
            'page' => [
                'image_path' => "/ilist",
            ],
//            'captcha_image' => $this->generateCaptcha(),
//            'fields' => $this->_fields,
            'source' => $this->_source,
            'prefix' => $this->_page_prefix,
            'formattr' => $params
        ]);
    }

    public function getValidators() {
        $var_validators = [];
        $var_validators['rules'] = $this->_rules;
        $var_validators['messages'] = $this->_messages;
        $validators = $this->getValidatorJSON($var_validators);
        $this->_ffpage['validators'] = $this->_validators = $validators;
        return $validators;
    }

    public function getFFJS($params) {
//error_log("Line 139 js page is ".$this->_js_template); 
//            $var_validators=[];
//            $var_validators['rules']=$this->_rules;
//            $var_validators['messages']=$this->_messages;
        $validators = $this->_validators;
        $this->_ffpage['js'] = $this->ci->view->fetch($this->_js_template, [
            'validators' => $validators,
            'fields' => $this->_fields,
            'source' => $this->_source,
            'captcha' => false,
            'prefix' => $this->_page_prefix,
            'params' => $params
        ]);
    }

    /**
     * create function.
     * Processes the request to create a new project.
     *
     * @access public
     * @param mixed $request
     * @param mixed $response
     * @param mixed $args
     * @return void
     */
    public function processSourceForm($request, $response, $args) {

        // Request POST data
        $post = $request->getParsedBody();

        // Load the request schema
        $schema = new RequestSchema("schema://forms/project.json");

        // Whitelist and set parameter defaults
        $transformer = new RequestDataTransformer($schema);
        $data = $transformer->transform($post);

        // Validate, and halt on validation errors.
        $validator = new ServerSideValidator($schema, $this->ci->translator);
        if (!$validator->validate($data)) {
            $ms->addValidationErrors($validator);
            return $response->withStatus(400);
        }

        // Update the project
        // This is where you would save the changes to the database...
        // Get the target object
        $this->updateSourceTable($data);

        //Success message!
        $ms->addMessageTranslated("success", "Project successfully updated (or not)");
        return $response->withStatus(200);
    }

    public function updateSourceTable($data) {
        AutoFormSource::init($this->_db_table, $this->_db_columns);
        $thistable = new AutoFormSource($data);
        if (isset($data['id']) && $data['id'] > 0) {
            $thistable->where('id', $data['id'])->update($data);
        } else {
            $thistable->save($data);
        }
    }

}
