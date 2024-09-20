<?php

namespace Jscorptech;


interface ClientInterface
{
    /**
     * Send single SMS to Playmobile.
     *
     * @param SMS $sms
     * @param Timing|null $timing
     */
    public function send_sms(SMS $sms, Timing $timing = null): void;

    /**
     * Send batch of SMS to Playmobile.
     *
     * @param SMS[] $sms_batch
     * @param Timing|null $timing
     */
    public function send_sms_batch(array $sms_batch, Timing $timing = null): void;
}