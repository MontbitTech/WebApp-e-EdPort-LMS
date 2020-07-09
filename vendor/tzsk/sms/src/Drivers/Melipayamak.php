<?php

namespace Tzsk\Sms\Drivers;

use Tzsk\Sms\Abstracts\Driver;
use Melipayamak\MelipayamakApi;

class Melipayamak extends Driver
{
    /**
     * Melipayamak Settings.
     *
     * @var object
     */
    protected $settings;

    /**
     * Melipayamak Client.
     *
     * @var MelipayamakApi
     */
    protected $client;

    /**
     * Construct the class with the relevant settings.
     *
     * SendSmsInterface constructor.
     * @param $settings object
     */
    public function __construct($settings)
    {
        $this->settings = (object) $settings;
        $this->client = new MelipayamakApi($this->settings->username, $this->settings->password);
    }

    /**
     * Determine if the sms must be a flash message or not.
     *
     * @param bool $flash
     * @return $this
     */
    public function asFlash($flash = true)
    {
        $this->settings->flash = $flash;

        return $this;
    }

    /**
     * Send text message and return response.
     *
     * @return object
     */
    public function send()
    {
        $response = collect();
        foreach ($this->recipients as $recipient) {
            $response->put($recipient, $this->client->sms()->send(
                $recipient,
                $this->settings->from,
                $this->body,
                $this->settings->flash
            ));
        }

        return (count($this->recipients) == 1) ? $response->first() : $response;
    }
}
