<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\Survey;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendSurveyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contact, $survey;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $contact, Survey $survey)
    {
        $this->contact = $contact;
        $this->survey = $survey;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->from('survey@cnxretail.com')
            ->subject(config('app.name').' Survey')
            ->markdown('mails.survey');
    }
}
