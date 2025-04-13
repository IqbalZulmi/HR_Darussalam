<?php

namespace Tests\Feature;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;


class updateProfilePegawaiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test ini memastikan bahwa pegawai dapat mengupdate profil mereka
     * dengan data yang valid termasuk penggantian email, informasi personal,
     * dan foto profil.
     *
     * Langkah pengujian:
     * - Setup user dan pegawai
     * - Simulasi login
     * - Kirim request PUT ke route update profil
     * - Verifikasi redirect dan notifikasi
     * - Periksa apakah data di database berubah
     * - Cek apakah file foto berhasil disimpan
     *
     *
     */

    public function test_pegawai_dapat_mengupdate_profil_dengan_data_valid()
    {
        // Simulasi penyimpanan file
        Storage::fake('public');

        // Buat user dan data pegawai awal
        $user = User::factory()->create([
            'email' => 'lama@email.com',
            'roles' => 'pegawai',
        ]);
        $pegawai = Pegawai::factory()->create([
            'id_user' => $user->id,
            'nama' => 'Nama Lama',
            'alamat' => 'Alamat Lama',
            'no_telepon' => '081234567890',
            'tanggal_lahir' => '2000-01-01',
            'gender' => 'pria',
        ]);

        // Login sebagai user
        $this->actingAs($user);

        // Kirim request update profil dengan data baru dan foto
        $response = $this->put(route('pegawai.profile.update'), [
            'old_email' => 'lama@email.com',
            'email' => 'baru@email.com',
            'nama' => 'Nama Baru',
            'alamat' => 'Alamat Baru',
            'no_telepon' => '081234567891',
            'tanggal_lahir' => '2000-02-02',
            'gender' => 'wanita',
            'foto' => UploadedFile::fake()->image('foto.jpg'),
        ]);

        // Pastikan redirect (berhasil)
        $response->assertRedirect();

        // Pastikan session memiliki notifikasi sukses
        $response->assertSessionHas([
            'notifikasi' => 'Berhasil mengubah profile',
            'type' => 'success',
        ]);

        // Periksa perubahan data di tabel users
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'baru@email.com'
        ]);

        // Periksa perubahan data di tabel pegawai
        $this->assertDatabaseHas('pegawai', [
            'id_user' => $user->id,
            'nama' => 'Nama Baru',
            'alamat' => 'Alamat Baru',
            'no_telepon' => '081234567891',
            'tanggal_lahir' => '2000-02-02',
            'gender' => 'wanita',
        ]);

        // Pastikan file foto berhasil disimpan
        $this->assertTrue(
            Storage::disk('public')->exists('profile_img/' . basename($pegawai->fresh()->foto))
        );
    }

    #[Test]
    public function pegawai_tidak_dapat_mengupdate_profil_dengan_data_tidak_valid()
    {
        Storage::fake('public');

        // Buat user dan pegawai
        $user = User::factory()->create([
            'email' => 'lama@email.com',
            'roles' => 'pegawai'
        ]);

        $user2 = User::factory()->create([
            'email' => 'baru@email.com',
            'roles' => 'pegawai'
        ]);

        $pegawai = Pegawai::factory()->create([
            'id_user' => $user->id,
            'nama' => 'Nama Lama',
            'alamat' => 'Alamat Lama',
            'no_telepon' => '081234567890',
            'tanggal_lahir' => '2000-01-01',
            'gender' => 'pria',
        ]);

        // Login sebagai pegawai
        $this->actingAs($user);

        // Kirim data tidak valid (contoh: email sudah ada, nomor telepon salah format)
        $response = $this->put(route('pegawai.profile.update'), [
            'old_email' => 'lama@email.com',  // Old email yang valid
            'email' => 'baru@email.com',  // Email yang sudah ada di database
            'nama' => 'Nama Baru',
            'alamat' => 'Alamat Baru',
            'no_telepon' => '081234',  // Nomor telepon yang tidak valid (terlalu pendek)
            'tanggal_lahir' => '2000-02-02',
            'gender' => 'wanita',
            'foto' => UploadedFile::fake()->image('foto.jpg'),
        ]);

        // Pastikan response mengarah ke halaman yang benar (redirect back)
        $response->assertRedirect();

        // Periksa apakah ada error untuk email dan no_telepon
        $response->assertSessionHasErrors('email');  // Cek error untuk 'email'
        $response->assertSessionHasErrors('no_telepon');  // Cek error untuk 'no_telepon'

        // Pastikan pesan error yang tepat muncul
        $response->assertSessionHasErrors([
            'email' => 'Email sudah digunakan.',
            'no_telepon' => 'Nomor telepon minimal 10 digit.',
        ]);

        // Pastikan data di database tidak berubah (karena validasi gagal)
        $this->assertDatabaseHas('users', ['id' => $user->id, 'email' => 'lama@email.com']);
        $this->assertDatabaseHas('pegawai', [
            'id_user' => $user->id,
            'nama' => 'Nama Lama',  // Data lama tetap di database
            'alamat' => 'Alamat Lama',
            'no_telepon' => '081234567890',  // Data lama tetap
            'tanggal_lahir' => '2000-01-01',
            'gender' => 'pria',
        ]);
    }


}
