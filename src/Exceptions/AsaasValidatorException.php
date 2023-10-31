<?php

namespace Asaas\Exceptions;

class AsaasValidatorException extends \Exception
{
    private array $fields = [];
    protected $message = 'Dados inválidos. Revise todos os parâmetros fornecidos!';

    public function addField(string $field, ?string $message=null)
    {
        $this->fields[$field] = $message;
        return $this;
    }
}