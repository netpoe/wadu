<?php

namespace App\Form\Front;

use EBM\Form\AbstractBaseForm;
use EBM\Field\Field;

use App\Model\{
    User\UserAddressAdapter as UserAddress,
    Order\OrderAdapter as Order,
    Address\AddressCountryAdapter as AddressCountry,
    Address\AddressStateAdapter as AddressState
};

class OrderShippingForm extends AbstractBaseForm
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;

        parent::__construct();
    }

    public function setOnPostActionString()
    {
        $this->onPostActionString = route('front.shipping.store', [
            'order' => $this->order->id
        ]);

        return $this;
    }

    public function setFields()
    {
        $userId = $this->order->user->id;

        $userAddress = new UserAddress;
        $userAddress->user_id = $userId;

        $addressCountry = new AddressCountry;

        $this->addField('user_id')
            ->setLabel('user_id')
            ->setModel($userAddress)
            ->setType(Field::TYPE_HIDDEN)
            ->setValue($userId)
            ->required();

        $this->addField('country_id')
            ->setLabel(__('Country'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Country'))
            ->setType(Field::TYPE_HIDDEN)
            ->setOptions($addressCountry->asSelectInputOptions('id', 'name'))
            ->setClass('form-control')
            ->setValue(AddressCountry::GUATEMALA)
            ->required();

        $this->addField('state_id')
            ->setLabel(__('State'))
            ->setModel($userAddress)
            ->setPlaceholder(__('State'))
            ->setOptions([['key' => null, 'value' => __('Select an option')]])
            ->setType(Field::TYPE_HIDDEN)
            ->setClass('form-control')
            ->setValue(AddressState::where('name', 'Guatemala City')->value('id'))
            ->required();

        $this->addField('city')
            ->setLabel(__('City'))
            ->setModel($userAddress)
            ->setPlaceholder(__('City'))
            ->setType(Field::TYPE_HIDDEN)
            ->setClass('form-control')
            ->setValue('Guatemala City')
            ->required();

        $this->addField('street')
            ->setLabel(__('Street'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Street'))
            ->setType(Field::TYPE_TEXT)
            ->setClass('form-control');
            // ->required();

        $this->addField('references')
            ->setLabel(__('References'))
            ->setModel($userAddress)
            ->setPlaceholder(__('References'))
            ->setType(Field::TYPE_TEXTAREA)
            ->setClass('form-control');

        $this->addField('interior_number')
            ->setLabel(__('Interior number'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Interior number'))
            ->setType(Field::TYPE_TEXT)
            ->setClass('form-control');

        $this->addField('neighborhood')
            ->setLabel(__('Neighborhood'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Neighborhood'))
            ->setType(Field::TYPE_TEXT)
            ->setClass('form-control')
            ->required();

        $this->addField('zip_code')
            ->setLabel(__('Zip code'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Zip code'))
            ->setType(Field::TYPE_TEXT)
            ->setClass('form-control')
            ->required();

        return $this;
    }

    public function getValidationRules()
    {
        return [
            'user_id' => 'bail|required|integer',
            'country_id' => 'bail|required|integer',
            'state_id' => 'bail|required|integer',
            'city' => 'bail|required|string',
            'street' => 'bail|required|string',
            'references' => 'nullable|string',
            'interior_number' => 'nullable|alpha_dash',
            'neighborhood' => 'bail|required|string',
            'zip_code' => 'bail|required|alpha_dash',
        ];
    }

    public function getValidationMessages()
    {
        return [];
    }
}
