<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'seller']);
        $role3 = Role::create(['name' => 'buyer']);

        //Permisos
        //Acceder al dahsboard de administrador
        $permission = Permission::create(['name' => 'admin.dahs'])->syncRoles([$role1, $role2]);
        //Acceder al modulo Productos
        $permission = Permission::create(['name' => 'admin.products.index'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.products.create'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.products.show'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.products.edit'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.products.destroy'])->syncRoles([$role1, $role2]);
        //Acceder al modulo Usuarios
        $permission = Permission::create(['name' => 'admin.users.index'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.users.create'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.users.show'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.users.edit'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.users.destroy'])->syncRoles([$role1]);
        //Acceder al modulo Categorias 
        $permission = Permission::create(['name' => 'admin.category.index'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.category.create'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.category.edit'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.category.destroy'])->syncRoles([$role1]);
        //Acceder al modulo Empresas 
        $permission = Permission::create(['name' => 'admin.business.index'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.business.create'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.business.show'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.business.edit'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.business.destroy'])->syncRoles([$role1]);
        //Acceder al modulo Promociones
        $permission = Permission::create(['name' => 'admin.promotions.index'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.promotions.create'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.promotions.show'])->syncRoles([$role1, $role2]);
        $permission = Permission::create(['name' => 'admin.promotions.edit'])->syncRoles([$role1]);
        $permission = Permission::create(['name' => 'admin.promotions.destroy'])->syncRoles([$role1]);
    }
}
