<?php

namespace App\Form\Front;

use EBM\Form\AbstractBaseForm;
use EBM\Field\Field;

use App\Model\{
    User\UserAddressAdapter as UserAddress,
    Order\OrderAdapter as Order
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
        $userAddress = new UserAddress;
        $userAddress->user_id = $this->order->user->id;

        $this->addField('user_id')
            ->setLabel('user_id')
            ->setModel($userAddress)
            ->setType(Field::TYPE_HIDDEN)
            ->required();

        $this->addField('country_id')
            ->setLabel(__('Country'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Country'))
            ->setType(Field::TYPE_SELECT)
            ->setOptions([
                [
                    'key' => 1,
                    'value' => 'Guatemala'
                ]
            ])
            ->required();

        $this->addField('state_id')
            ->setLabel(__('State'))
            ->setModel($userAddress)
            ->setPlaceholder(__('State'))
            ->setType(Field::TYPE_SELECT)
            ->required();

        $this->addField('city')
            ->setLabel(__('City'))
            ->setModel($userAddress)
            ->setPlaceholder(__('City'))
            ->setType(Field::TYPE_TEXT)
            ->required();

        $this->addField('street')
            ->setLabel(__('Street'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Street'))
            ->setType(Field::TYPE_TEXT)
            ->required();

        $this->addField('references')
            ->setLabel(__('References'))
            ->setModel($userAddress)
            ->setPlaceholder(__('References'))
            ->setType(Field::TYPE_TEXTAREA)
            ->required();

        $this->addField('interior_number')
            ->setLabel(__('Interior number'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Interior number'))
            ->setType(Field::TYPE_TEXT)
            ->required();

        $this->addField('neighborhood')
            ->setLabel(__('Neighborhood'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Neighborhood'))
            ->setType(Field::TYPE_TEXT)
            ->required();

        $this->addField('zip_code')
            ->setLabel(__('Zip code'))
            ->setModel($userAddress)
            ->setPlaceholder(__('Zip code'))
            ->setType(Field::TYPE_TEXT)
            ->required();

        return $this;
    }
}
