<?php 

/**
|--
|- Validation Class
|-
|- Content
|- Validation Class
|-
|- Properties
|- private \System\Application $app
|- private array $errors
|-
|- Methods
|- public \System\Validation required(string $inputName, string $customErrorMessage = null ) : The given input must be not empty
|- public \System\Validation float(string $inputName, string $customErrorMessage = null ) : The given input must be float
|- public \System\Validation email(string $inputName, string $customErrorMessage = null ) : Determine if the given input is valid email
|- public \System\Validation minLen(string $inputName, int $length, string $customErrorMessage = null ) : The given input must be at  least $length of length
|- public \System\Validation maxLen(string $inputName, int $length, string $customErrorMessage = null ) : The given input must be at  most $length of length
|- public \System\Validation match(string $firstInput, string $secondInput, string $customErrorMessage = null ) : The first input value must match the second input value
|- public \System\Validation unique(string $inputName, array $databaseData, string $customErrorMessage = null ) : The input must be valid image
|- public \System\Validation requiredFile(string $inputName, string $customErrorMessage = null ) : The given input must be uploaded
|- public \System\Validation image(string $inputName, string $customErrorMessage = null ) : The input must be valid image
|- public \System\Validation message(string $customErrorMessage ) : Add Custom Message
|- public \System\Validation validate() : Validate all the given inputs
|- public bool fails() : Determine if there are any invalid inputs in the validation
| public bool passes() : Determine if all inputs are valid
|- public array getMessages() : Get an array contains all error messages for 
--|