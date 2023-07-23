<?php

namespace patterns\AbstractFactory;

class MegaCommsManager extends CommsManager
{

    /**
     * @return string
     */
    public function getHeaderText(): string
    {
        return 'MegaCal верхний колонтитул<br>';
    }

    /**
     * @return ApptEncoder
     */
    public function getApptEncoder(): ApptEncoder
    {
        return new MegaApptEncoder();
    }

    /**
     * @return TtdEncoder
     */
    public function getTtdEncoder(): TtdEncoder
    {
        return new MegaTtdEncoder();
    }

    /**
     * @return ContactEncoder
     */
    public function getContactEncoder(): ContactEncoder
    {
        return new MegaContactEncoder();
    }

    /**
     * @return string
     */
    public function getFooterText(): string
    {
        return 'MegaCal нижний колонтитул<br>';
    }
}
