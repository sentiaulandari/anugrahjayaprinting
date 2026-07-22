<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'username'     => 'admin',
                'password'     => password_hash('admin123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Administrator',
                'email'        => 'admin@ajdp.com',
                'no_hp'        => '081234567890',
                'level'        => 'admin',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'pimpinan',
                'password'     => password_hash('pimpinan123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Pimpinan AJDP',
                'email'        => 'pimpinan@ajdp.com',
                'no_hp'        => '081234567891',
                'level'        => 'pimpinan',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'username'     => 'pelanggan1',
                'password'     => password_hash('pelanggan123', PASSWORD_DEFAULT),
                'nama_lengkap' => 'Budi Santoso',
                'email'        => 'budi@email.com',
                'no_hp'        => '081234567892',
                'level'        => 'pelanggan',
                'created_at'   => date('Y-m-d H:i:s'),
            ],
        ];

        foreach ($users as $user) {
            $exists = $this->db->table('users')->where('username', $user['username'])->get()->getRow();
            if (!$exists) {
                $this->db->table('users')->insert($user);
            }
        }
    }
}
