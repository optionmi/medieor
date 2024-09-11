<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $superadmin_role = Role::where('name', 'superadmin')->first();
        $admin_role = Role::where('name', 'admin')->first();
        $user_role = Role::where('name', 'user')->first();

        $all_permissions = [
            // User
            ['can_post', 'can_comment', 'can_reply'],
            // Admin
            [
                'can_manage_categories',
                'can_manage_events',
                'can_manage_articles',
                'can_manage_donations',
                'can_manage_infopages',
                'can_manage_users',
                'can_manage_category_topics',
                'can_manage_category_posts',
                'can_manage_category_comments',
                'can_manage_groups',
                'can_manage_group_join_requests',
                'can_manage_group_posts',
                'can_manage_group_comments',
            ]
        ];

        Schema::disableForeignKeyConstraints();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();
        foreach ($all_permissions as $i => $permissions) {
            foreach ($permissions as $permission) {
                $permission_model = Permission::create(['name' => $permission]);
                if ($i === 0) {
                    $user_role->permissions()->attach($permission_model->id);
                } else {
                    $admin_role->permissions()->attach($permission_model->id);
                }
            }
        }
    }
}
