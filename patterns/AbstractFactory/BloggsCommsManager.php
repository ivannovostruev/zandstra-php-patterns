<?php

namespace patterns\AbstractFactory;

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
     * @return TtdEncoder
     */
    public function getTtdEncoder(): TtdEncoder
    {
        return new BloggsTtdEncoder();
    }

    /**
     * @return ContactEncoder
     */
    public function getContactEncoder(): ContactEncoder
    {
        return new BloggsContactEncoder();
    }

    /**
     * @return string
     */
    public function getFooterText(): string
    {
        return 'BloggsCal нижний колонтитул<br>';
    }
}
