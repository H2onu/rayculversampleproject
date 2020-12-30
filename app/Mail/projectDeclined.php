<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class projectDeclined extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
	public $project;
	public $owner;

	public function __construct( $project, $owner ) {
		$this->project = $project;
		$this->owner    = $owner;
	}


	/**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
	    return $this->markdown( 'emails.project-declined' );
    }
}
