<?php

namespace App\Util;

use App\Model\{
    User\UserContactAdapter as UserContact
};

class WhatsAppNumberProcessor
{
    private $number;
    private $formattedNumber;
    private $foundExistingNumbers = false;

    public function __construct(String $number)
    {
        $this->number = $number;
    }

    public function sanitizeNumber()
    {
        $this->formattedNumber = StringUtil::cleanPhone($this->number);

        return $this;
    }

    public function searchExistingNumbers()
    {
        $numbers = UserContact::where([
            'whatsapp' => $this->formattedNumber,
        ])->get();

        $this->foundExistingNumbers = !$numbers->isEmpty();

        return $this;
    }

    public function foundExistingNumbers()
    {
        return $this->foundExistingNumbers;
    }

    public function getUserContactModel(): UserContact
    {
        return UserContact::where([
            'whatsapp' => $this->formattedNumber,
        ])->first();
    }
}
