<?php

	namespace App\Mail;

	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Contracts\Queue\ShouldQueue;

	class projectApproved extends Mailable {
		use Queueable, SerializesModels;

		public $project;
		public $owner;
		public $social;

		public function __construct( $project, $owner, $social ) {
			$this->project = $project;
			$this->owner   = $owner;
			$this->social  = $social;
		}

		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build() {

			return $this->markdown( 'emails.project-approved' );

		}
	}
