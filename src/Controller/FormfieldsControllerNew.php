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
use UserFrosting\Fortress\RequestSchema;
use UserFrosting\Fortress\Adapter\JqueryValidationAdapter;
use UserFrosting\Sprinkle\AutoForms\Model\Formfields;
use UserFrosting\Sprinkle\AutoForms\Model\Lookup;

/**
 * CDFormfieldsController
 *
 * An abstract controller class for connecting to iList2 providers.
 *
 * @package UserFrosting-OpenAuthentication
 * @author Srinivas Nukala
 * @link http://srinivasnukala.com
 */
class FormfieldsControllerNew extends SimpleController {

    protected $_properties=["source"=>"not_set","columns"=>[],"dbtable"=>"not_set",
            "prefix" => 'dbf_', "page_type" => 'form', 'secure' => false, "html_template" => 'default', 
            "js_template" => 'default', 'schema' => "/dbform/dbform-schema.json","fields"=>[],"ffpage"=>[],
            "messages"=>[],"validators"=>[],"rules"=>[],"notification"=>['save' => false]];
    protected $_faarray = ['text' => 'fa fa-fw fa-edit', 'email' => 'fa fa-fw fa-envelope',
            'password' => 'fa fa-fw fa-key', 'captcha' => 'fa fa-fw fa-eye',
            'date' => 'fa fa-fw fa-calendar', 'datetime' => 'fa fa-fw fa-calendar',
            'number' => 'fa fa-fw fa-hashtag', 'phone' => 'fa fa-fw fa-hashtag'];
    /**
     * constructor
     *
     * @param object $app app object.
     * @return none.
     */
    public function initializeFFController($properties) {
        $this->setProperties($properties);        
        $this->getFieldDefinitions();        
        $this->initializePageFields();
    }
    
    public function setProperties($properties)
    {
        foreach($properties as $key=>$value)
        {
            $this->_properties[$key]=$value;
        }
    }
    
    public function getProperty($property){
        return $this->_properties[$property];
    }
    
    public function setProperty($property,$value){
        $this->_properties[$property]= $value;
    }
    
    public function getFieldDefinitions($source='') {
        if($source==''){
            $source=$this->getProperty('source');
        }
        $form_fields = Formfields::getFieldDefinitions($source);        
        $this->setProperty('fields',$form_fields['fields']);
        $this->setProperty('db_columns',array_keys($form_fields['fields']));
    }

    public function getFieldNames() {
        return $this->getProperty('db_columns');
    }

    public function initializePageFields($par_tabdef = 'none') {
        if ($par_tabdef == 'none')
            $par_tabdef = $this->getProperty('fields');
        $var_colspan = 0;
        $var_datatable_cols = $var_allcols = array();
        $var_lookupcache = array();
        foreach ($par_tabdef as &$var_column) {
//logarr($var_column,"Line 117 the column is ");            
            if (isset($this->_faarray[$var_column['type']]))
                $var_column['addon'] = $this->_faarray[$var_column['type']];

            if (in_array($var_column['type'], ['select', 'checkbox', 'radio'])) {
                $var_column['addon'] = '';
                if ($var_column['lookup_cat'] != '' && isset($var_lookupcache[$var_column['lookup_cat']])) {
                    $var_column['options'] = $var_lookupcache[$var_column['lookup_cat']];
                } else if ($var_column['lookup_cat'] != '') {
                    $cur_lookup_values_full = Lookup::getLookupValues($var_column['lookup_cat']);
//error_log("Line 126 lookup category is ".$var_column['lookup_cat']);                    
                    $var_lookupcache[$var_column['lookup_cat']] = $var_column['options'] = $cur_lookup_values_full[$var_column['lookup_cat']];
                } else {
// lookup category is not set so make this an editable field                        
                    $var_column['type'] = 'text';
                    $var_column['addon'] = $this->_faarray['text'];
                }
            }
        }
        $this->_fields = $par_tabdef;

        if ($this->getProperty('schema') != 'none') {
            $ffschema = new RequestSchema("schema://" . $this->getProperty('schema'));
            $ffvalidator = new JqueryValidationAdapter($ffschema, $this->ci->translator);
            $var_pagerules = $ffvalidator->rules('json', false);
            $this->setProperty('rules',$var_pagerules['rules']);
            //            unset($var_pagerules['rules']);
            $this->setProperty('messages',$var_pagerules['messages']);
        }
    }

    public function getFFPageHTMLJS($pageparams = [], $htmlonly = false) {
        $this->createFormfieldPage($pageparams, $htmlonly);
//logarr($this->_ffpage,"Line 104 returning ffpage array");        
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

        $this->getFFHTML($pageparams);
        $this->getValidators();
        if (!$htmlonly) {
            $this->getFFJS($pageparams);
        }
//        $settings = $this->_app->site;
//logarr($pageparams,"Line 133 pageparams ");
//logarr($this->_fields,"Line 116 rendernig the page now ".$this->_html_template);   
    }

    public function getFFHTML($params) {
        error_log("Line 116 rendernig the page now " . $this->getProperty('html_template'));
        $this->_ffpage['html'] = $this->ci->view->fetch($this->getProperty('html_template'), [
            'page' => [
                'image_path' => "/ilist",
            ],
//            'captcha_image' => $this->generateCaptcha(),
            'fields' => $this->_fields,
            'source' => $this->_source,
            'prefix' => $this->_page_prefix,
            'params' => $params
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
     * Processes a form request.
     * Request type: POST     
     */
    public function processSourceForm() {
        // POST: user_name, display_name, email, title, password, passwordc, captcha, spiderbro, csrf_token
        $post = $this->_app->request->post();
        $var_multirec = false;
        if (isset($post[0]['id']))  // these are multiple records
            $var_multirec = true;

        logarr($post, "Line 195 post array");
        // Get the alert message stream
        $ms = $this->_app->alerts;

        // Check the honeypot. 'spiderbro' is not a real field, it is hidden on the main page and must be submitted with its default value for this to be processed.
        if (!$post['spiderbro'] || $post['spiderbro'] != "http://") {
            error_log("Possible spam received:" . print_r($this->_app->request->post(), true));
            $ms->addMessage("danger", "Aww hellllls no!");
            $this->_app->halt(500);     // Don't let on about why the request failed ;-)
        }

        // Load the request schema
        if (file_exists($this->_schema)) {
            $requestSchema = new \Fortress\RequestSchema($this->_schema);

            $requestSchema->getSchema();
//        $this->_app->jsValidator->setSchema($requestSchema);       
            // Set up Fortress to process the request
            $rf = new \Fortress\HTTPRequestFortress($ms, $requestSchema, $post);

            // Sanitize data
            $rf->sanitize();

            // Validate, and halt on validation errors.
            $error = !$rf->validate(true);

            // Get the filtered data
            $data = $rf->data();
        } else {
            $data = $post;
        }
//logarr($data,"Line 222 data from form and error is ($error)");
        // Check captcha, if required
//        if ($this->_app->site->enable_captcha == "1") {
        if (isset($data['captcha']) && (md5($data['captcha']) != $_SESSION['userfrosting']['captcha'])) {
            $ms->addMessageTranslated("danger", "CAPTCHA_FAIL");
            $error = true;
        }
//        }
        // Remove captcha, password confirmation from object data
//        $rf->removeFields(['captcha', 'passwordc']);
        // Halt on any validation errors
        if ($error) {
            error_log("Line 235 stoping because of errors");
            $this->_app->halt(400);
        }

        $table_dtsource = new \UserFrosting\DatabaseTable($this->_db_table, $this->_db_columns);
        \UserFrosting\Database::setSchemaTable($this->_db_table, $table_dtsource);
//        \UserFrosting\FormFields\cdFFSourceLoader::init($this->_db_table);
// if we find a record with the UID then, update the record 
        if (!$var_multirec)
            $fulldata[] = $data;
        else  // these are multiple records
            $fulldata = $data;

        if ($fulldata === false) {
            $ms->addMessage("warning", "Can not understand data posted !!");
            $this->_app->halt(400);
        }

        logarr($fulldata, "Line 258 full data, table is " . $this->_db_table);
        foreach ($fulldata as &$var_datarec) {
            Ffsource::init($this->_db_table);
            $var_thisid = isset($var_datarec['id']) ? $var_datarec['id'] : null;
            $var_updobj = new Ffsource($var_datarec, $var_thisid);
//            $var_updobj->init($this->_db_table); 
            if ($var_thisid != null && $var_datarec['id'] > 0)
                $var_updobj->exists = true;
            //        $result_obj = $var_updobj->where('id', $var_post['erec']['id'])->get();
            //logarr($result_obj,"line 158");
            // Save to database
            $var_datarec['id'] = $var_updobj->store();
            //        return "Save successful";
        }

        if ($this->_notification['save']) {
            // Create and send verification email
            $var_email = 'srinivas@capabledata.com';
            $twig = $this->_app->view()->getEnvironment();
            $template = $twig->loadTemplate("mail/account/ilist-register-activate-new.twig");
            $notification = new Notification($template);
            $notification->fromWebsite();      // Automatically sets sender and reply-to
            $notification->addEmailRecipient($var_email, 'iListNotification', [
                "user" => $user
            ]);

            try {
                $notification->send();
            } catch (\Exception\phpmailerException $e) {
                $ms->addMessageTranslated("danger", "MAIL_ERROR");
                error_log('Mailer Error: ' . $e->errorMessage());
                $this->_app->halt(500);
            }

            $ms->addMessageTranslated("success", "ACCOUNT_REGISTRATION_COMPLETE_TYPE2");
        } else
        // No activation required
            $ms->addMessageTranslated("success", "ACCOUNT_REGISTRATION_COMPLETE_TYPE1");

        return $fulldata;
    }

}
