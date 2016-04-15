<?php
return array(
    // set your paypal credential
    'client_id' => 'Ae5ETbb70m3UwSnBQWQT6E7Rg46RrKQmDQrnGd9LfU4r6U_iBIAiGfPH4olipqSnNVnkRH2vfVGPxKQj',
    'secret' => 'EIjzFmnwynJqNgDgH3JrzqxI4eP3l5Dr1uur--9ghoIs1y5MAkGA5e9B3ic-cIZHM0YziaaRAGcsOkI6',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);