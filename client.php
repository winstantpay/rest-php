<?php
return (object) array(
    "username" => "Username",
    "wpay_id" => "Wpayid",
    "first_name" => "Firstname",
    "last_name" => "Lastname",
    "password" => "A password matching ",
    "email" => "A valid emaila addess",
    "date_of_birth" => "31/12/1900",
    "gender" => "Male/Female",
    "company" => "Company name",
    "job_title" => "Title",
    "address1" => "Please enter and address here",
    "city" => "City",
    "postal_code" => "00000",
    "address2" => "",
    "address3" => "",
    "country_birth" => "245", // that is Vietnam look up in API doc
    "country_nationality" => "245",
    "country_residence" => "245",
    "telephone1" => "000000000",
    "status" => "active",
    "preferred_currency" => "CCY",
    "referral_id" => "wpay_id"
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
