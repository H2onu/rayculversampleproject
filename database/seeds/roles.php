<?php

	use Illuminate\Database\Seeder;
	use Spatie\Permission\Models\Role;
	use Spatie\Permission\Models\Permission;
	use Spatie\Permission\Traits\HasRole;

	use App\User;


	class roles extends Seeder {
		/**
		 * Run the database seeds.
		 *
		 * @return void
		 */

		public function run() {
			// Reset cached roles and permissions
			app()['cache']->forget( 'spatie.permission.cache' );

			// create permissions
			Permission::create( [ 'name' => 'Administer roles & permissions' ] );
			Permission::create( [ 'name' => 'View Event Dashboard' ] );
			Permission::create( [ 'name' => 'Edit Event' ] );
			Permission::create( [ 'name' => 'Print Event Reports' ] );
			Permission::create( [ 'name' => 'Submit Project' ] );
			Permission::create( [ 'name' => 'Edit Project' ] );
			Permission::create( [ 'name' => 'Volunteer For Project' ] );
			Permission::create( [ 'name' => 'View Roles' ] );
			Permission::create( [ 'name' => 'View Permissions' ] );
			Permission::create( [ 'name' => 'View Users' ] );
			Permission::create( [ 'name' => 'Add Event' ] );

			// create roles and assign existing permissions
			$role = Role::create( [ 'name' => 'Admin' ] );
			$role->givePermissionTo( 'Administer roles & permissions' );
			$role->givePermissionTo( 'View Event Dashboard' );
			$role->givePermissionTo( 'Edit Event' );
			$role->givePermissionTo( 'Print Event Reports' );
			$role->givePermissionTo( 'Submit Project' );
			$role->givePermissionTo( 'Edit Project' );
			$role->givePermissionTo( 'Volunteer For Project' );
			$role->givePermissionTo( 'View Roles' );
			$role->givePermissionTo( 'View Permissions' );
			$role->givePermissionTo( 'View Users' );
			$role->givePermissionTo( 'Add Event' );


			$role = Role::create( [ 'name' => 'Project Owner' ] );
			$role->givePermissionTo( 'Submit Project' );
			$role->givePermissionTo( 'Volunteer For Project' );

			$role = Role::create( [ 'name' => 'City Admin' ] );
			$role->givePermissionTo( 'View Event Dashboard' );
			$role->givePermissionTo( 'Edit Event' );
			$role->givePermissionTo( 'Print Event Reports' );
			$role->givePermissionTo( 'Submit Project' );
			$role->givePermissionTo( 'Edit Project' );
			$role->givePermissionTo( 'Volunteer For Project' );

			$role = Role::create( [ 'name' => 'Volunteers' ] );
			$role->givePermissionTo( 'Volunteer For Project' );


		}

	}
