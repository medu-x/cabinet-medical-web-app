<?php

namespace Tests\Feature;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RendezVousTest extends TestCase
{
    use RefreshDatabase;

    // Crée un patient vérifié avec son profil lié
    private function creerPatient(): array
    {
        $user    = User::factory()->patient()->create();
        $patient = Patient::factory()->create(['user_id' => $user->id]);
        return [$user, $patient];
    }

    public function test_un_patient_peut_reserver_un_creneau_valide(): void
    {
        Mail::fake();

        [$user, $patient] = $this->creerPatient();
        $medecin = Medecin::factory()->create();
        $date    = now()->next('Monday')->toDateString();

        $response = $this->actingAs($user)->post(route('rendezvous.store'), [
            'medecin_id'        => $medecin->id,
            'date_rendez_vous'  => $date,
            'heure_rendez_vous' => '09:00',
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('rendez_vous', [
            'patient_id'        => $patient->id,
            'medecin_id'        => $medecin->id,
            'date_rendez_vous'  => $date,
            'heure_rendez_vous' => '09:00:00',
            'statut'            => 'en_attente',
        ]);
    }

    public function test_reservation_le_samedi_est_refusee(): void
    {
        Mail::fake();

        [$user] = $this->creerPatient();
        $medecin  = Medecin::factory()->create();
        $samedi   = now()->next('Saturday')->toDateString();

        $this->actingAs($user)->post(route('rendezvous.store'), [
            'medecin_id'        => $medecin->id,
            'date_rendez_vous'  => $samedi,
            'heure_rendez_vous' => '09:00',
        ])->assertSessionHas('error');

        $this->assertDatabaseCount('rendez_vous', 0);
    }

    public function test_reservation_le_dimanche_est_refusee(): void
    {
        Mail::fake();

        [$user] = $this->creerPatient();
        $medecin  = Medecin::factory()->create();
        $dimanche = now()->next('Sunday')->toDateString();

        $this->actingAs($user)->post(route('rendezvous.store'), [
            'medecin_id'        => $medecin->id,
            'date_rendez_vous'  => $dimanche,
            'heure_rendez_vous' => '09:00',
        ])->assertSessionHas('error');

        $this->assertDatabaseCount('rendez_vous', 0);
    }

    public function test_reservation_en_dehors_des_horaires_est_refusee(): void
    {
        Mail::fake();

        [$user] = $this->creerPatient();
        $medecin = Medecin::factory()->create();
        $date    = now()->next('Monday')->toDateString();

        // 13h00 = pause déjeuner, hors créneaux (08-12 et 14-18)
        $this->actingAs($user)->post(route('rendezvous.store'), [
            'medecin_id'        => $medecin->id,
            'date_rendez_vous'  => $date,
            'heure_rendez_vous' => '13:00',
        ])->assertSessionHas('error');

        $this->assertDatabaseCount('rendez_vous', 0);
    }

    public function test_un_creneau_deja_reserve_ne_peut_pas_etre_repris(): void
    {
        Mail::fake();

        [$user] = $this->creerPatient();
        $medecin = Medecin::factory()->create();
        $date    = now()->next('Monday')->toDateString();

        // Premier rendez-vous existant sur ce créneau
        RendezVous::factory()->create([
            'medecin_id'        => $medecin->id,
            'date_rendez_vous'  => $date,
            'heure_rendez_vous' => '09:00:00',
        ]);

        // Un autre patient essaie le même créneau
        $this->actingAs($user)->post(route('rendezvous.store'), [
            'medecin_id'        => $medecin->id,
            'date_rendez_vous'  => $date,
            'heure_rendez_vous' => '09:00',
        ])->assertSessionHas('error');

        // Toujours un seul rendez-vous en base
        $this->assertDatabaseCount('rendez_vous', 1);
    }

    public function test_un_visiteur_non_connecte_ne_peut_pas_reserver(): void
    {
        $medecin = Medecin::factory()->create();

        $this->post(route('rendezvous.store'), [
            'medecin_id'        => $medecin->id,
            'date_rendez_vous'  => now()->next('Monday')->toDateString(),
            'heure_rendez_vous' => '09:00',
        ])->assertRedirect(route('login'));
    }

    public function test_un_patient_peut_annuler_un_rdv_plus_de_2h_avant(): void
    {
        [$user, $patient] = $this->creerPatient();

        $rdv = RendezVous::factory()->create([
            'patient_id'        => $patient->id,
            'date_rendez_vous'  => now()->addHours(3)->toDateString(),
            'heure_rendez_vous' => now()->addHours(3)->format('H:i:s'),
            'statut'            => 'confirmé',
        ]);

        $this->actingAs($user)
             ->delete(route('patient.rendezvous.cancel', $rdv->id))
             ->assertRedirect();

        $this->assertDatabaseHas('rendez_vous', [
            'id'     => $rdv->id,
            'statut' => 'annulé',
        ]);
    }

    public function test_un_patient_ne_peut_pas_annuler_un_rdv_moins_de_2h_avant(): void
    {
        [$user, $patient] = $this->creerPatient();

        $rdv = RendezVous::factory()->create([
            'patient_id'        => $patient->id,
            'date_rendez_vous'  => now()->addHour()->toDateString(),
            'heure_rendez_vous' => now()->addHour()->format('H:i:s'),
            'statut'            => 'confirmé',
        ]);

        $this->actingAs($user)
             ->delete(route('patient.rendezvous.cancel', $rdv->id))
             ->assertSessionHas('error');

        // Le statut ne doit pas avoir changé
        $this->assertDatabaseHas('rendez_vous', [
            'id'     => $rdv->id,
            'statut' => 'confirmé',
        ]);
    }

    public function test_un_patient_ne_peut_pas_annuler_le_rdv_dun_autre_patient(): void
    {
        [$user1]            = $this->creerPatient();
        [$user2, $patient2] = $this->creerPatient();

        $rdv = RendezVous::factory()->create([
            'patient_id' => $patient2->id,
            'statut'     => 'confirmé',
        ]);

        // Patient 1 tente d'annuler le rdv du Patient 2 → 404
        $this->actingAs($user1)
             ->delete(route('patient.rendezvous.cancel', $rdv->id))
             ->assertStatus(404);

        $this->assertDatabaseHas('rendez_vous', [
            'id'     => $rdv->id,
            'statut' => 'confirmé',
        ]);
    }

    public function test_un_patient_peut_voir_sa_propre_page_de_confirmation(): void
    {
        [$user, $patient] = $this->creerPatient();
        $rdv = RendezVous::factory()->create(['patient_id' => $patient->id]);

        $this->actingAs($user)
             ->get(route('rendezvous.confirmation', $rdv->id))
             ->assertStatus(200);
    }

    public function test_un_patient_ne_peut_pas_voir_la_confirmation_dun_autre(): void
    {
        [$user1]            = $this->creerPatient();
        [$user2, $patient2] = $this->creerPatient();

        $rdv = RendezVous::factory()->create(['patient_id' => $patient2->id]);

        $this->actingAs($user1)
             ->get(route('rendezvous.confirmation', $rdv->id))
             ->assertStatus(404);
    }
}
