<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_page_inscription_saffiche_correctement(): void
    {
        $this->get('/register')->assertStatus(200);
    }

    public function test_un_patient_peut_sinscrire(): void
    {
        Mail::fake();

        $response = $this->post('/register', [
            'name'                  => 'Hamid Ouchane',
            'email'                 => 'hamid@test.ma',
            'password'              => 'password',
            'password_confirmation' => 'password',
            'cin'                   => 'AB123456',
            'telephone'             => '0661234567',
            'adresse'               => 'Marrakech',
            'date_naissance'        => '1990-01-01',
        ]);

        // Redirigé vers la page de vérification d'email
        $response->assertRedirect(route('email.verify.form'));

        // Le compte utilisateur est créé en base
        $this->assertDatabaseHas('users', [
            'email' => 'hamid@test.ma',
            'role'  => 'patient',
        ]);

        // Le profil patient est aussi créé
        $user = User::where('email', 'hamid@test.ma')->first();
        $this->assertDatabaseHas('patients', ['user_id' => $user->id, 'cin' => 'AB123456']);

        // Un dossier médical vide est créé automatiquement
        $this->assertDatabaseHas('dossier_medical', ['patient_id' => $user->patient->id]);
    }

    public function test_linscription_echoue_avec_un_email_deja_utilise(): void
    {
        Mail::fake();

        User::factory()->patient()->create(['email' => 'existant@test.ma']);

        $response = $this->post('/register', [
            'name'                  => 'Autre Personne',
            'email'                 => 'existant@test.ma',
            'password'              => 'password',
            'password_confirmation' => 'password',
            'cin'                   => 'ZZ999999',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_linscription_echoue_avec_un_mot_de_passe_trop_court(): void
    {
        Mail::fake();

        $this->post('/register', [
            'name'                  => 'Test User',
            'email'                 => 'test@test.ma',
            'password'              => '123',
            'password_confirmation' => '123',
            'cin'                   => 'AB999001',
        ])->assertSessionHasErrors('password');
    }

    public function test_la_page_connexion_saffiche_correctement(): void
    {
        $this->get('/login')->assertStatus(200);
    }

    public function test_un_patient_peut_se_connecter_avec_les_bons_identifiants(): void
    {
        $user = User::factory()->patient()->create([
            'email'    => 'connexion@test.ma',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'email'    => 'connexion@test.ma',
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_la_connexion_echoue_avec_un_mauvais_mot_de_passe(): void
    {
        User::factory()->patient()->create([
            'email'    => 'mauvais@test.ma',
            'password' => bcrypt('bon-mot-de-passe'),
        ]);

        $this->post('/login', [
            'email'    => 'mauvais@test.ma',
            'password' => 'mauvais-mot-de-passe',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_la_connexion_echoue_avec_un_email_inexistant(): void
    {
        $this->post('/login', [
            'email'    => 'inconnu@test.ma',
            'password' => 'password',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_un_utilisateur_connecte_peut_se_deconnecter(): void
    {
        $user = User::factory()->patient()->create();

        $this->actingAs($user)
             ->get(route('logout'))
             ->assertRedirect(route('login'));

        $this->assertGuest();
    }

    public function test_le_formulaire_de_verification_redirige_sans_session(): void
    {
        $this->get(route('email.verify.form'))
             ->assertRedirect(route('register'));
    }

    public function test_un_code_correct_verifie_lemail_et_connecte_lutilisateur(): void
    {
        $code   = '123456';
        $expiry = now()->addMinutes(10)->format('Y-m-d H:i:s');

        $user = User::factory()->patient()->unverified()->create([
            'email_verification_token' => $code . '|' . $expiry,
        ]);

        $this->withSession(['verify_email' => $user->email])
             ->post(route('email.verify.submit'), ['code' => $code])
             ->assertRedirect(route('dashboard'));

        $this->assertNotNull($user->fresh()->email_verified_at);
        $this->assertNull($user->fresh()->email_verification_token);
    }

    public function test_un_code_incorrect_est_refuse(): void
    {
        $expiry = now()->addMinutes(10)->format('Y-m-d H:i:s');

        $user = User::factory()->patient()->unverified()->create([
            'email_verification_token' => '999999|' . $expiry,
        ]);

        $this->withSession(['verify_email' => $user->email])
             ->post(route('email.verify.submit'), ['code' => '000000'])
             ->assertSessionHasErrors('code');

        $this->assertNull($user->fresh()->email_verified_at);
    }

    public function test_un_code_expire_est_refuse(): void
    {
        $expiry = now()->subMinutes(1)->format('Y-m-d H:i:s');

        $user = User::factory()->patient()->unverified()->create([
            'email_verification_token' => '123456|' . $expiry,
        ]);

        $this->withSession(['verify_email' => $user->email])
             ->post(route('email.verify.submit'), ['code' => '123456'])
             ->assertSessionHasErrors('code');
    }
}
