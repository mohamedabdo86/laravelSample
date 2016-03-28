<?php

namespace Proengsoft\JsValidation;

use Illuminate\Validation\Validator as BaseValidator;
use Proengsoft\JsValidation\Traits\RemoteValidation;
use Proengsoft\JsValidation\Traits\JavascriptRules;

/**
 * Extends Laravel Validator to add Javascript Validations.
 *
 * Class Validator
 */
class Validator extends BaseValidator
{
    use JavascriptRules,RemoteValidation;

    const JSVALIDATION_DISABLE = 'NoJsValidation';

    /**
     * Determine if the data passes the validation rules.
     *
     * @return bool
     */
    public function passes()
    {
        if ($this->isRemoteValidationRequest()) {
            return $this->validateJsRemoteRequest($this->data['_jsvalidation'], [$this, 'parent::passes']);
        }

        return parent::passes();
    }

    /**
     * Disable Javascript Validations for some attribute.
     *
     * @return bool
     */
    public function validateNoJsValidation()
    {
        return true;
    }

    /**
     * Generate Javascript validations.
     *
     * @return array
     */
    protected function generateJavascriptValidations()
    {
        $jsValidations = array();

        foreach ($this->rules as $attribute=>$rules)
        {
            $newRules=$this->jsConvertRules($attribute,$rules);
            $jsValidations = array_merge($jsValidations, $newRules);
        }

        return $jsValidations;
    }

    /**
     * Make Laravel Validations compatible with JQuery Validation Plugin.
     *
     * @param $attribute
     * @param $rules
     *
     * @return array
     */
    protected function jsConvertRules($attribute, $rules)
    {
        if (!$this->jsValidationEnabled($attribute)) return array();

        $jsRules = [];
        foreach ($rules as $rawRule) {
            list($rule, $parameters) = $this->parseRule($rawRule);
            list($jsAttribute, $jsRule, $jsParams) = $this->getJsRule($attribute, $rule, $parameters);
            if ($jsRule) {
                $jsRules[$jsAttribute][$jsRule][] = array(
                    $rule,
                    $jsParams,
                    $this->getJsMessage($attribute, $rule, $parameters),
                    $this->isImplicit($rule),
                );
            }
        }
        return $jsRules;
    }

    /**
     * Return parsed Javascript Rule.
     *
     * @param string $attribute
     * @param string $rule
     * @param array  $parameters
     *
     * @return array
     */
    protected function getJsRule($attribute, $rule, $parameters)
    {
        $method = "jsRule{$rule}";
        $jsRule = false;
        $attribute = $this->getJsAttributeName($attribute);

        if ($this->isRemoteRule($rule)) {
            list($attribute, $parameters) = $this->jsRemoteRule($attribute);
            $jsRule = 'laravelValidationRemote';
        } elseif (method_exists($this, $method)) {
            list($attribute, $parameters) = $this->$method($attribute, $parameters);
            $jsRule = 'laravelValidation';
        } elseif (method_exists($this, "validate{$rule}")) {
            $jsRule = 'laravelValidation';
        }

        return [$attribute, $jsRule, $parameters];
    }

    /**
     *  Replace javascript error message place-holders with actual values.
     *
     * @param string $attribute
     * @param string $rule
     * @param array  $parameters
     *
     * @return mixed
     */
    protected function getJsMessage($attribute, $rule, $parameters)
    {
        $message = $this->getTypeMessage($attribute, $rule);

        if (isset($this->replacers[snake_case($rule)])) {
            $message = $this->doReplacements($message, $attribute, $rule, $parameters);
        } elseif (method_exists($this, $replacer = "jsReplace{$rule}")) {
            $message = str_replace(':attribute', $this->getAttribute($attribute), $message);
            $message = $this->$replacer($message, $attribute, $rule, $parameters);
        } else {
            $message = $this->doReplacements($message, $attribute, $rule, $parameters);
        }

        return $message;
    }

    /**
     * Get the message considering the data type.
     *
     * @param string $attribute
     * @param string $rule
     *
     * @return string
     */
    private function getTypeMessage($attribute, $rule)
    {
        // find more elegant solution to set the attribute file type
        $prevFiles = $this->files;
        if ($this->hasRule($attribute, array('Mimes', 'Image'))) {
            if (!array_key_exists($attribute, $this->files)) {
                $this->files[$attribute] = false;
            }
        }

        $message = $this->getMessage($attribute, $rule);
        $this->files = $prevFiles;

        return $message;
    }

    /**
     * Check if JS Validation is disabled for attribute.
     *
     * @param $attribute
     *
     * @return bool
     */
    public function jsValidationEnabled($attribute)
    {
        return !$this->hasRule($attribute, self::JSVALIDATION_DISABLE);
    }

    /**
     * Returns view data to render javascript.
     *
     * @return array
     */
    public function validationData()
    {
        $jsMessages = array();
        $jsValidations = $this->generateJavascriptValidations();

        return [
            'rules' => $jsValidations,
            'messages' => $jsMessages,
        ];
    }

    /**
     * Handles multidimensional attribute names
     *
     * @param $attribute
     * @return string
     */
    private function getJsAttributeName($attribute)
    {
        $attributeArray = explode(".", $attribute);
        if(count($attributeArray) > 1) {
            return $attributeArray[0] . "[".implode("][", array_slice($attributeArray, 1)) . "]";
        }

        return $attribute;
    }


}
