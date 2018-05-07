<?php

namespace App\Form\Admin;

use EBM\Form\AbstractBaseForm;
use EBM\Field\Field;

use App\Model\{
    User\UserContactAdapter as UserContact
};

class NewOrderForm extends AbstractBaseForm
{
    public function setOnPostActionString()
    {
        $this->onPostActionString = route('admin.orders.create');

        return $this;
    }

    public function setFields()
    {
        $this->addField('whatsapp')
            ->setLabel('Número de whatsapp')
            ->setPlaceholder('whatsapp: 502 123 45 67')
            ->setLabelClass('sr-only')
            ->setType(Field::TYPE_TEXT)
            ->required();

        return $this;
    }

    public function getValidationRules()
    {
        return [
            'whatsapp' => 'required|string|regex:/^\+?[\d ]{8,20}+$/i'
        ];
    }

    public function getValidationMessages()
    {
        return [
            'whatsapp.regex' => 'Whatsapp must be a number between 6 and 14 digits with an optional "+" leading sign'
        ];
    }
}
