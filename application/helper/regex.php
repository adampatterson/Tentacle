<?
//All major credit cards regex
'/^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6011[0-9]{12}|622((12[6-9]|1[3-9][0-9])|([2-8][0-9][0-9])|(9(([0-1][0-9])|(2[0-5]))))[0-9]{10}|64[4-9][0-9]{13}|65[0-9]{14}|3(?:0[0-5]|[68][0-9])[0-9]{11}|3[47][0-9]{13})*$/'

//Alpha-numeric characters only
'/^[a-zA-Z0-9]*$/'

//Alpha-numeric characters with spaces only
'/^[a-zA-Z0-9 ]*$/'

//Alphabetic characters only
'/^[a-zA-Z]*$/'

//Amex credit card regex
'/^(3[47][0-9]{13})*$/'

//Australian Postal Codes
'/^((0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2}))*$/'

//Canadian Postal Codes
'/^([ABCEGHJKLMNPRSTVXY][0-9][A-Z] [0-9][A-Z][0-9])*$/'

//Canadian Province Abbreviations
'/^(?:AB|BC|MB|N[BLTSU]|ON|PE|QC|SK|YT)*$/'

//Date (MM/DD/YYYY)
'/^((0?[1-9]|1[012])[- /.](0?[1-9]|[12][0-9]|3[01])[- /.](19|20)?[0-9]{2})*$/'

//Date (YYYY/MM/DD)
'#^((19|20)?[0-9]{2}[- /.](0?[1-9]|1[012])[- /.](0?[1-9]|[12][0-9]|3[01]))*$#'

//Digits only
'/^[0-9]*$/'

//Diner's Club credit card regex
'/^(3(?:0[0-5]|[68][0-9])[0-9]{11})*$/'

//Email regex
'/^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4})*$/'

//IP address regex
'/^((?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))*$/'

//Lowercase letters only
'/^([a-z])*$/'

//MasterCard credit card numbers
'/^(5[1-5][0-9]{14})*$/'

//Password regex
'/^(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))^.*$/'

//Phone number regex
'/^((([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+)*$/'

//SSN regex
'/^([0-9]{3}[-]*[0-9]{2}[-]*[0-9]{4})*$/'

//UK Postal Codes regex
'/^([A-Z]{1,2}[0-9][A-Z0-9]? [0-9][ABD-HJLNP-UW-Z]{2})*$/'

//Uppercase letters only
'/^([A-Z])*$/'

//URL regex
'/^(((http|https|ftp):\/\/)?([[a-zA-Z0-9]\-\.])+(\.)([[a-zA-Z0-9]]){2,4}([[a-zA-Z0-9]\/+=%&_\.~?\-]*))*$/'

//US States regex
'/^(?:A[KLRZ]|C[AOT]|D[CE]|FL|GA|HI|I[ADLN]|K[SY]|LA|M[ADEINOST]|N[CDEHJMVY]|O[HKR]|PA|RI|S[CD]|T[NX]|UT|V[AT]|W[AIVY])*$/'

//US ZIP Codes regex
'/^([0-9]{5}(?:-[0-9]{4})?)*$/'

//Visa credit card numbers
'/^(4[0-9]{12}(?:[0-9]{3})?)*$/'