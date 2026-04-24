<?php

namespace Tests\Feature;

use App\Models\Avis;
use App\Models\Patient;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AvisTest extends TestCase
{
    use RefreshDatabase;

    private function creerPatient(): array
    {
        $user    = User::factory()->patient()->create();
        $patient = Patient::factory()->create(['user_id' => $user->id]);
        return [$user, $patient];
    }

    public function test_un_patient_peut_laisser_un_avis_sur_sa_consultation(): void
    {
        [$user, $patient] = $this->creerPatient();

        $rdv = RendezVous::factory()->termine()->create([
            'patient_id' => $patient->id,
        ]);

        $response = $this->actingAs($user)->post(route('patient.avis.store'), [
            'rendez_vous_id' => $rdv->id,
            'note'           => 5,
            'commentaire'    => 'Excellent médecin, très professionnel et à l\'écoute.',
        ]);

        $response->assertSessionHas('success_avis');

        $this->assertDatabaseHas('avis', [
            'rendez_vous_id' => $rdv->id,
            'note'           => 5,
            'commentaire'    => 'Excellent médecin, très professionnel et à l\'écoute.',
        ]);
    }

    public function test_un_patient_ne_peut_pas_laisser_deux_avis_sur_le_meme_rdv(): void
    {
        [$user, $patient] = $this->creerPatient();

        $rdv = RendezVous::factory()->termine()->create([
            'patient_id' => $patient->id,
        ]);

        // Premier avis déjà enregistré
        Avis::create([
            'rendez_vous_id' => $rdv->id,
            'note'           => 4,
            'commentaire'    => 'Très bien.',
        ]);

        // Deuxième tentative sur le même rendez-vous
        $this->actingAs($user)->post(route('patient.avis.store'), [
            'rendez_vous_id' => $rdv->id,
            'note'           => 2,
            'commentaire'    => 'Je change d\'avis.',
        ])->assertSessionHas('error');

        // Toujours un seul avis en base
        $this->assertDatabaseCount('avis', 1);
    }

    public function test_un_patient_ne_peut_pas_noter_le_rdv_dun_autre_patient(): void
    {
        [$user1]            = $this->creerPatient();
        [$user2, $patient2] = $this->creerPatient();

        // Le rendez-vous appartient au patient 2
        $rdv = RendezVous::factory()->termine()->create([
            'patient_id' => $patient2->id,
        ]);

        // Le patient 1 essaie de noter → 404
        $this->actingAs($user1)->post(route('patient.avis.store'), [
            'rendez_vous_id' => $rdv->id,
            'note'           => 5,
        ])->assertStatus(404);

        $this->assertDatabaseCount('avis', 0);
    }

    public function test_la_note_doit_etre_entre_1_et_5(): void
    {
        [$user, $patient] = $this->creerPatient();

        $rdv = RendezVous::factory()->termine()->create([
            'patient_id' => $patient->id,
        ]);

        // Note = 6 → invalide
        $this->actingAs($user)->post(route('patient.avis.store'), [
            'rendez_vous_id' => $rdv->id,
            'note'           => 6,
        ])->assertSessionHasErrors('note');

        // Note = 0 → invalide
        $this->actingAs($user)->post(route('patient.avis.store'), [
            'rendez_vous_id' => $rdv->id,
            'note'           => 0,
        ])->assertSessionHasErrors('note');

        $this->assertDatabaseCount('avis', 0);
    }

    public function test_un_visiteur_non_connecte_ne_peut_pas_soumettre_un_avis(): void
    {
        $rdv = RendezVous::factory()->termine()->create();

        $this->post(route('patient.avis.store'), [
            'rendez_vous_id' => $rdv->id,
            'note'           => 5,
        ])->assertRedirect(route('login'));
    }
}
