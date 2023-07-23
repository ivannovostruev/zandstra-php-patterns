<?php

namespace patterns\FactoryMethod;

class BloggsCommsManager extends CommsManager
{
    /**
     * @return string
     */
    public function getHeaderText(): string
    {
        return 'BloggsCal верхний колонтитул<br>';
    }

    /**
     * @return ApptEncoder
     */
    public function getApptEncoder(): ApptEncoder
    {
        return new BloggsApptEncoder();
    }

    /**
     * @return string
     */
    public function getFooterText(): string
    {
        return 'BloggsCal нижний колонтитул<br>';
    }
}
