<?php
return (object) array(
    "username" => "PREFIXusername",
    "wpay_id" => "CUSTOMER_PREFIX",
    "first_name" => "FirstPREFIX",
    "last_name" => "LastPREFIX",
    "password" => "PREFIXW1x@",
    "email" => "user@winstantpay.com",
    "date_of_birth" => "31/12/1990",
    "gender" => "Male",
    "company" => "PREFIXCompany",
    "job_title" => "PREFIXTitle",
    "address1" => "12/23 PREFIX address",
    "city" => "PREFIX City",
    "postal_code" => "007007",
    "address2" => "",
    "address3" => "",
    "country_birth" => "245", // that is Vietnam look up in API doc
    "country_nationality" => "245",
    "country_residence" => "245",
    "telephone1" => "010000000",
    "status" => "active",
    "preferred_currency" => "THB",
    "referral_id" => "somethingvalid"
);


//  Look at: 
//  http://doc.worldkyc.com/ for the schema and the complete API documentation
//  http://doc.worldkyc.com/public/countries/ for the currently configued countries 
//  Note: the password has to
//      1.) be at least 8 characters long
//      2.) have at least 1 (one) CAPITAL leter
//      3.) have at least 1 (one) number
//      4.) have NO spaces, blanks or HTML tags
//      5.) have at least on symbol of [!,@,#,$,%,^,&,*,?,_,~,-,(,)]
//  For other fields:    
//      None of the fields can have HTML tags inside
//  
