<?php

namespace EmizorIpx\ManyContacts\Response;

/**
 * Class ResponseMessage
 *
 * Represents a response message from WhatsApp Cloud API.
 */
class ResponseMessage {

    protected $message;

    protected $delta;

    protected $event;

    protected $contact;

    protected $profile;

    protected $from;

    protected $id;

    protected $timestamp;

    protected $text;

    protected $type;

    protected $wa_id;

    public function __construct( $delta, $contact, $event) {

        $this->event = $event;

        $this->delta = $delta;

        $this->contact = $contact;

        $this->decodeMessage();

    }

    /**
     * Get Profile of Author Message
     *
     * @return array|null An associative array representing the profile information.
     *                    The array structure is ['profile' => ['name' => 'ProfileName']].
     */
    public function getProfile() {

        return $this->profile;
    }

    public function getWaId() {

        return $this->wa_id;
    }

    /**
     * Get from number send Message
     *
     * @return string|null
     */
    public function getFrom(){

        return $this->from;
    }

    /**
     * Get WamId - Id Message
     *
     * @return string|null
     */
    public function getId() {

        return $this->id;
    }

    /**
     * Get Timestamp mnessage sent
     *
     * @return string|null
     */
    public function getTimestamp() {

        return $this->timestamp;
    }

    /**
     * Get text body of message
     *
     * @return array|null ['body' => 'Text Body']
     */
    public function getText() {

        return $this->text;
    }

    /**
     * Get Type Message
     *
     * @return string|null
     */
    public function getType() {

        return $this->type;
    }

    public function decodeMessage() {

        $this->profile = isset( $this->contact ) ? $this->contact : [];

        $this->wa_id = isset($this->contact['number']) ? $this->contact['number'] : null;

        \Log::debug('Profile: ' . json_encode( $this->profile ));

        $this->from = isset($this->contact['number']) ? $this->contact['number'] : null;

        $this->id = isset( $this->delta["message"]['id'] ) ? $this->delta["message"]['id'] : null;

        $this->timestamp = isset( $this->delta["message"]['metadata']["time"] ) ? $this->delta["message"]['metadata']["time"] : null;
        $this->text = [];
        $this->text["body"] = isset( $this->delta["message"]["text"] ) ? $this->delta["message"]["text"] : null;

        $this->type = isset( $this->delta["message"]['type'] ) ? $this->delta["message"]['type'] : null;

    }
}

