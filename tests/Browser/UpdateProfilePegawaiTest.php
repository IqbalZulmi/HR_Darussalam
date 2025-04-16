<?php

namespace Tests\Browser;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use function Laravel\Prompts\pause;

class UpdateProfilePegawaiTest extends DuskTestCase
{


    /**
     * A Dusk test example.
     */
    public function test_pegawai_dapat_mengupdate_profil_dengan_data_valid()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('email', 'bryanaditya67lol@gmail.com') // ganti dengan email yang valid
                ->type('password', 'password')// ganti dengan password yang valid
                ->press('Login')
                ->waitForLocation('/pegawai/dashboard')
                ->assertPathIs('/pegawai/dashboard') // asumsi route dashboard seperti ini
                // ->screenshot('email-field')

                ->pause(3000)
                ->waitFor('a.nav-link.nav-profile')  // Tunggu agar elemen profil terlihat
                ->click('a.nav-link.nav-profile')  // Klik pada elemen dropdown profil
                ->screenshot('check-current-page')

                ->pause(3000)

                ->click('a.dropdown-item.d-flex.align-items-center')
                ->pause(3000)
                ->screenshot('check-current-page2')
                ->assertSee('Profile')

                // // Klik tab "Edit Profile"
                ->click('button[data-bs-target="#profile-edit"]')// menggunakan selector

                // Isi form edit
                // ->attach('foto', __DIR__.'/foto.jpg')
                ->type('nama', 'Nama Baru')
                ->type('email', 'farhanlubis1245@gmail.com')
                ->type('alamat', 'Alamat Baru')
                ->type('no_telepon', '08123456789')
                ->type('tanggal_lahir', '11-11-1992')
                ->select('gender', 'pria')

                // Submit
                ->press('Simpan Perubahan')
                ->pause(1000) // tunggu redirect atau proses selesai
                ->assertPathIs('/pegawai/profile') // atau path setelah update
                ->assertSee('Nama Baru') // pastikan ada perubahan
                ->visit('/logout');
        });
    }
    public function test_pegawai_dapat_mengupdate_profil_dengan_data_tidak_valid()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type('email', 'farhanlubis1245@gmail.com') // ganti dengan email yang valid
                ->type('password', 'password')// ganti dengan password yang valid
                ->press('Login')
                ->waitForLocation('/pegawai/dashboard')
                ->assertPathIs('/pegawai/dashboard') // asumsi route dashboard seperti ini

                ->pause(3000)
                ->waitFor('a.nav-link.nav-profile')  // Tunggu agar elemen profil terlihat
                ->click('a.nav-link.nav-profile')  // Klik pada elemen dropdown profil
                ->screenshot('check-current-page')

                ->pause(3000)

                ->click('a.dropdown-item.d-flex.align-items-center')
                ->pause(3000)
                ->screenshot('check-current-page2')
                ->assertSee('Profile')

                // // Klik tab "Edit Profile"
                ->click('button[data-bs-target="#profile-edit"]')// menggunakan selector

                // Isi form edit
                // ->attach('foto', __DIR__.'/foto.jpg')
                ->type('nama', 'Nama Baru')
                ->type('email', 'bryanaditya67lol@gmail.com')
                ->type('alamat', 'Alamat Baru')
                ->type('no_telepon', '08-123456789')
                ->type('tanggal_lahir', '11-11-1992')
                ->select('gender', 'pria')

                // Submit
                ->press('Simpan Perubahan')
                ->click('button[data-bs-target="#profile-edit"]')// menggunakan selector
                ->pause(2000)
                ->assertSee('Nomor telepon hanya boleh berisi angka.')
                ->pause(1000) // tunggu redirect atau proses selesai
                ->assertPathIs('/pegawai/profile') // atau path setelah update
                ->assertSee('Nama Baru'); // pastikan ada perubahan
        });
    }
}
