## 1.1.4 (2015-09-10)

Bugfixes:

 - Issues resolved:
    -  String validation fails on length. #71
    -  Default validation messages can't be changed. #27



## 1.1.3 (2015-09-07)

Bugfixes:

 - Issues resolved:
    - DateFormat generate javascript error if date is not valid


## 1.1.2 (2015-09-05)

Features:

 - Automatic update for public Javascript assets
 - Minor Javascript improvements.
 - Support multidimensional array validation

Bugfixes:

 - Issues resolved:
    - Wrong password confirmed rule conversion. #52
    - Fix numeric check for min/max validation #54
	- Validate PUT/PATCH methods on remote #69
	- Hidden input raising an error #58
	- Non radio-list show error messages from other radio-list #57 
	- date_format:m rule always return not valid #66 
	

## 1.1.1 (2015-08-15)

Bugfixes: 

 - Issues resolved:
     - Rules that depends from other rules they are not validated in some cases. #47
     - Route Model Binding Form Request Validation Error. #44


## 1.1.0 (2015-08-11)

Features:

 - ActiveURL, Unique and Exists rules support
 - Support for Custom Validation Rules
 - Multiple forms support improved

Bugfixes:

 - Issues resolved:
   -  Some bugs resolved: #14, #17, #26, #29, #38, #39


## 1.0.5 (2015-06-13)

Features:

 - Laravel 5.1 support


## 1.0.4 (2015-05-09)

Refactoring:

 - Renamed JsValidation class name to avoid problems with IDE's code completion

## 1.0.3 (2015-04-11)

Bugfixes:

 - Input custom attributes from Requests are not applied.


## 1.0.2 (2015-03-27)

Features:

 - Allow disable validations for certain attributes
 - Unit testing

Bugfixes:

 - The config key form_selector is not loaded when package boots


## 1.0.1 (2015-03-17)

Bufixes:

 - jQuery Validation Plugin debug doesn't work. disabled
 
 
## 1.0.0 (2015-03-17)

Features:
 
 - Automatic creation of javascript validation based on your Validation Rules, Messages, FormRequest and Validators.
 - The package uses Jquery Validation Plugin bundled in provided script.
 - Unobtrusive integration, you can use independently of Laravel Form Builder. and no Javascript coding required.
 - Uses Laravel Localization to translate messages
 - Can be configured in controllers or views.
 
