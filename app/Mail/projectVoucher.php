<?php

	namespace App\Mail;

	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Contracts\Queue\ShouldQueue;

	class projectVoucher extends Mailable {
		use Queueable, SerializesModels;
		public $project;
		public $contact;
		public $event;

		/**
		 * Create a new message instance.
		 *
		 * @return void
		 */
		public function __construct( $project, $contact, $event ) {

			$this->project = $project;
			$this->contact    = $contact;
			$this->event   = $event;
		}

		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build() {

			return $this->markdown( 'emails.project-voucher' );
		}
	}
