<?php

namespace Tests\Feature;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Vérifie que chaque rôle accède uniquement aux routes qui lui sont autorisées.
 */
class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_un_visiteur_est_redirige_vers_login_depuis_le_dashboard_patient(): void
    {
        $this->get(route('patient.dashboard'))
             ->assertRedirect(route('login'));
    }

    public function test_un_visiteur_est_redirige_vers_login_depuis_le_dashboard_admin(): void
    {
        $this->get(route('admin.dashboard'))
             ->assertRedirect(route('login'));
    }

    public function test_un_visiteur_est_redirige_vers_login_depuis_le_dashboard_medecin(): void
    {
        $this->get(route('doctor.dashboard'))
             ->assertRedirect(route('login'));
    }

    public function test_un_visiteur_est_redirige_vers_login_depuis_le_dashboard_secretaire(): void
    {
        $this->get(route('secretary.dashboard'))
             ->assertRedirect(route('login'));
    }

    public function test_un_patient_verifie_peut_acceder_a_son_dashboard(): void
    {
        $user = User::factory()->patient()->create();
        Patient::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
             ->get(route('patient.dashboard'))
             ->assertStatus(200);
    }

    public function test_un_patient_non_verifie_ne_peut_pas_acceder_au_dashboard_patient(): void
    {
        $user = User::factory()->patient()->unverified()->create();
        Patient::factory()->create(['user_id' => $user->id]);

        // Le middleware 'verified' bloque l'accès et redirige
        $this->actingAs($user)
             ->get(route('patient.dashboard'))
             ->assertRedirect();
    }

    public function test_un_patient_ne_peut_pas_acceder_au_dashboard_admin(): void
    {
        $user = User::factory()->patient()->create();

        $this->actingAs($user)
             ->get(route('admin.dashboard'))
             ->assertStatus(403);
    }

    public function test_un_patient_ne_peut_pas_acceder_au_dashboard_medecin(): void
    {
        $user = User::factory()->patient()->create();

        $this->actingAs($user)
             ->get(route('doctor.dashboard'))
             ->assertStatus(403);
    }

    public function test_un_patient_ne_peut_pas_acceder_au_dashboard_secretaire(): void
    {
        $user = User::factory()->patient()->create();

        $this->actingAs($user)
             ->get(route('secretary.dashboard'))
             ->assertStatus(403);
    }

    public function test_un_admin_peut_acceder_au_dashboard_admin(): void
    {
        $user = User::factory()->admin()->create();

        $this->actingAs($user)
             ->get(route('admin.dashboard'))
             ->assertStatus(200);
    }

    public function test_un_admin_ne_peut_pas_acceder_au_dashboard_patient(): void
    {
        $user = User::factory()->admin()->create();

        $this->actingAs($user)
             ->get(route('patient.dashboard'))
             ->assertStatus(403);
    }

    public function test_un_medecin_peut_acceder_a_son_dashboard(): void
    {
        $user = User::factory()->doctor()->create();
        Medecin::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
             ->get(route('doctor.dashboard'))
             ->assertStatus(200);
    }

    public function test_un_medecin_ne_peut_pas_acceder_au_dashboard_admin(): void
    {
        $user = User::factory()->doctor()->create();

        $this->actingAs($user)
             ->get(route('admin.dashboard'))
             ->assertStatus(403);
    }

    public function test_une_secretaire_peut_acceder_a_son_dashboard(): void
    {
        $user = User::factory()->secretary()->create();

        $this->actingAs($user)
             ->get(route('secretary.dashboard'))
             ->assertStatus(200);
    }

    public function test_une_secretaire_ne_peut_pas_acceder_au_dashboard_admin(): void
    {
        $user = User::factory()->secretary()->create();

        $this->actingAs($user)
             ->get(route('admin.dashboard'))
             ->assertStatus(403);
    }
}
