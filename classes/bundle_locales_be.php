<?php

namespace adapt\locales\be{
    
    /* Prevent Direct Access */
    defined('ADAPT_STARTED') or die;
    
    class bundle_locales_be extends \adapt\bundle{
        
        public function __construct($data){
            parent::__construct('locales_be', $data);
        }
        
        public function boot(){
            if (parent::boot()){
                
                /* Add the validators */
                $this->sanitize->add_validator('be_phone', "^(\+32)?[0-9]{9,10}$");
                
                $this->sanitize->add_validator('be_postcode', "^[0-9]{4,4}$");
                
                /* Add formatters */
                
                $this->sanitize->add_format('be_time',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        return \adapt\date::convert_date('H:i:s', 'H:i', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('H:i:s', 'H:i', value);
                    }"
                );
                
                $this->sanitize->add_format('be_datetime',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        return \adapt\date::convert_date('Y-m-d H:i:s', 'Y-m-d H:i', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('Y-m-d H:i:s', 'Y-m-d H:i', value);
                    }"
                );
                
                
                /* Add unformatters */
                
                $this->sanitize->add_unformat('be_time',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('Hi', 'H:i:s', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('Hi', 'H:i:s', value);
                    }"
                );
                
                $this->sanitize->add_unformat('be_datetime',
                    function($value){
                        if ($value === null  || $value == '') return null;
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('dmYHi', 'Y-m-d H:i:s', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('YmdHi', 'Y-m-d H:i:s', value);
                    }"
                );

                
                return true;
            }
            
            return false;
        }
        
    }
    
    
}

?>