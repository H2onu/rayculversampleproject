<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use Share;

	class adminEvent extends Model {
		public $table = 'events';

		protected $fillable = [

			'active',
			'event_name',
			'event_start_date',
			'event_end_date',
			'projRegFormOnDate',
			'projRegFormOffDate',
			'volRegFormOnDate',
			'volRegFormOffDate',
			'projRegFormOverride',
			'volRegFormOverride',
			'supplyPickupLocation',
			'supplyPickupLocationDates',
			'redemptionDetails',
			'projRegAdminEmail',
			'emailPrimaryContact',
			'emailProjectOwner',
			'emailProjectOwnerSubmittal',
			'voucherOnDate',
			'voucherOffDate',
			'voucherOverride',
			'event_description',
			'allowlogoupload',
			'bags',
			'brooms',
			'gloves',
			'rakes',
			'shovels',
			'paint'

		];

	}
