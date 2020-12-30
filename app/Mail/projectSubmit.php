<?php

	namespace App\Mail;

	use Illuminate\Bus\Queueable;
	use Illuminate\Mail\Mailable;
	use Illuminate\Queue\SerializesModels;
	use Illuminate\Contracts\Queue\ShouldQueue;

	class projectSubmit extends Mailable {
		use Queueable, SerializesModels;

		public $project;
		public $user;

		/**
		 * Create a new message instance.
		 *
		 * @return void
		 */
		public function __construct( $project , $user ) {

			$this->project = $project;
			$this->user = $user;
		}

		/**
		 * Build the message.
		 *
		 * @return $this
		 */
		public function build() {

			return $this->markdown( 'emails.project-submitted' );
		}
	}
