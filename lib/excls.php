<?php

class excls
{
    static function bizerr($exception)
    {
        return explode(",",$exception->getMessage())[2];
    }

    public static function bizerrV2(Throwable $exception)
    {


        if( \strcls::startsWith($exception->getMessage(),"000000") )
        {
            return   explode(",",$exception->getMessage())[2];

        }
        throw $exception;
    }
}