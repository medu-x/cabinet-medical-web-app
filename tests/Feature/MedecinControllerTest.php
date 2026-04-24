<?php

namespace Tests\Feature;

use App\Models\Consultation;
use App\Models\DossierMedical;
use App\Models\Medecin;
use App\Models\Patient;
use App\Models\RendezVous;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MedecinControllerTest extends TestCase
{
    use RefreshDatabase;

    private function creerMedecin(): array
    {
        $user    = User::factory()->doctor()->create();
        $medecin = Medecin::factory()->create(['user_id' => $user->id]);
        return [$user, $medecin];
    }

    private function creerPatient(): array
    {
        $user    = User::factory()->patient()->create();
        $patient = Patient::factory()->create(['user_id' => $user->id]);
        DossierMedical::create(['patient_id' => $patient->id]);
        return [$user, $patient];
    }

    public function test_un_medecin_peut_acceder_a_son_dashboard(): void
    {
        [$user] = $this->creerMedecin();

        $this->actingAs($user)
             ->get(route('doctor.dashboard'))
             ->assertStatus(200);
    }

    public function test_un_visiteur_non_connecte_est_redirige_vers_login(): void
    {
        $this->get(route('doctor.dashboard'))
             ->assertRedirect(route('login'));
    }

    public function test_un_patient_ne_peut_pas_acceder_au_dashboard_medecin(): void
    {
        $user = User::factory()->patient()->create();

        $this->actingAs($user)
             ->get(route('doctor.dashboard'))
             ->assertStatus(403);
    }

    public function test_un_medecin_peut_mettre_a_jour_le_dossier_medical(): void
    {
        [$userMedecin]   = $this->creerMedecin();
        [$userPatient, $patient] = $this->creerPatient();

        $this->actingAs($userMedecin)
             ->patch(route('doctor.dossier.update', $patient->id), [
                 'groupe_sanguin' => 'A+',
                 'allergies'      => 'Pénicilline, Aspirine',
                 'antecedents'    => 'Hypertension artérielle',
             ])
             ->assertRedirect();

        $this->assertDatabaseHas('dossier_medical', [
            'patient_id'     => $patient->id,
            'groupe_sanguin' => 'A+',
            'allergies'      => 'Pénicilline, Aspirine',
            'antecedents'    => 'Hypertension artérielle',
        ]);
    }

    public function test_un_medecin_peut_vider_les_champs_du_dossier_medical(): void
    {
        [$userMedecin]           = $this->creerMedecin();
        [$userPatient, $patient] = $this->creerPatient();

        // Données initiales
        DossierMedical::where('patient_id', $patient->id)
            ->update(['groupe_sanguin' => 'B+', 'allergies' => 'Latex']);

        $this->actingAs($userMedecin)
             ->patch(route('doctor.dossier.update', $patient->id), [
                 'groupe_sanguin' => null,
                 'allergies'      => null,
                 'antecedents'    => null,
             ])
             ->assertRedirect();

        $this->assertDatabaseHas('dossier_medical', [
            'patient_id'     => $patient->id,
            'groupe_sanguin' => null,
            'allergies'      => null,
        ]);
    }

    public function test_un_patient_ne_peut_pas_modifier_un_dossier_medical(): void
    {
        $userPatient             = User::factory()->patient()->create();
        [$userP2, $patient2]     = $this->creerPatient();

        $this->actingAs($userPatient)
             ->patch(route('doctor.dossier.update', $patient2->id), [
                 'groupe_sanguin' => 'O+',
             ])
             ->assertStatus(403);
    }

    public function test_un_medecin_peut_enregistrer_une_consultation_sans_ordonnance(): void
    {
        [$userMedecin, $medecin] = $this->creerMedecin();
        [$userPatient, $patient] = $this->creerPatient();

        $rdv = RendezVous::factory()->confirme()->create([
            'medecin_id' => $medecin->id,
            'patient_id' => $patient->id,
        ]);

        $this->actingAs($userMedecin)
             ->post(route('doctor.consultation.store'), [
                 'rendez_vous_id'  => $rdv->id,
                 'motif'           => 'Douleurs thoraciques',
                 'diagnostic'      => 'Angine de poitrine',
                 'rapport_medical' => 'Patient suivi, ECG normal.',
                 'notes'           => 'Repos conseillé',
             ])
             ->assertRedirect(); // redirige vers le dashboard sans ordonnance

        // La consultation est bien enregistrée
        $this->assertDatabaseHas('consultations', [
            'rendez_vous_id' => $rdv->id,
            'patient_id'     => $patient->id,
            'medecin_id'     => $medecin->id,
            'motif'          => 'Douleurs thoraciques',
            'statut'         => 'termine',
        ]);

        // Le statut du rendez-vous est passé à "termine"
        $this->assertDatabaseHas('rendez_vous', [
            'id'     => $rdv->id,
            'statut' => 'termine',
        ]);
    }

    public function test_un_medecin_peut_enregistrer_une_consultation_avec_ordonnance(): void
    {
        [$userMedecin, $medecin] = $this->creerMedecin();
        [$userPatient, $patient] = $this->creerPatient();

        $rdv = RendezVous::factory()->confirme()->create([
            'medecin_id' => $medecin->id,
            'patient_id' => $patient->id,
        ]);

        $this->actingAs($userMedecin)
             ->post(route('doctor.consultation.store'), [
                 'rendez_vous_id'  => $rdv->id,
                 'motif'           => 'Infection respiratoire',
                 'diagnostic'      => 'Bronchite aiguë',
                 'rapport_medical' => 'Traitement antibiotique prescrit.',
                 'medicaments'     => [
                     [
                         'medicament'   => 'Amoxicilline 500mg',
                         'dosage'       => '1 comprimé',
                         'frequence'    => '3 fois par jour',
                         'instructions' => 'Prendre pendant les repas',
                     ],
                     [
                         'medicament'   => 'Ibuprofène 400mg',
                         'dosage'       => '1 comprimé',
                         'frequence'    => '2 fois par jour',
                         'instructions' => null,
                     ],
                 ],
             ]);

        // L'ordonnance est créée
        $this->assertDatabaseCount('ordonnances', 1);

        // Les 2 prescriptions sont créées
        $this->assertDatabaseCount('prescriptions', 2);

        $this->assertDatabaseHas('prescriptions', [
            'medicament' => 'Amoxicilline 500mg',
            'dosage'     => '1 comprimé',
            'frequence'  => '3 fois par jour',
        ]);
    }

    public function test_impossible_de_creer_deux_consultations_pour_le_meme_rdv(): void
    {
        [$userMedecin, $medecin] = $this->creerMedecin();
        [$userPatient, $patient] = $this->creerPatient();

        $rdv = RendezVous::factory()->confirme()->create([
            'medecin_id' => $medecin->id,
            'patient_id' => $patient->id,
        ]);

        // Première consultation déjà enregistrée
        Consultation::create([
            'rendez_vous_id'  => $rdv->id,
            'patient_id'      => $patient->id,
            'medecin_id'      => $medecin->id,
            'motif'           => 'Visite de contrôle',
            'diagnostic'      => 'RAS',
            'rapport_medical' => 'Rien à signaler.',
            'statut'          => 'termine',
        ]);

        // Deuxième tentative sur le même rdv
        $this->actingAs($userMedecin)
             ->post(route('doctor.consultation.store'), [
                 'rendez_vous_id'  => $rdv->id,
                 'motif'           => 'Deuxième tentative',
                 'diagnostic'      => 'Test',
                 'rapport_medical' => 'Test.',
             ])
             ->assertSessionHas('error');

        // Toujours une seule consultation
        $this->assertDatabaseCount('consultations', 1);
    }

    public function test_les_champs_obligatoires_de_la_consultation_sont_valides(): void
    {
        [$userMedecin] = $this->creerMedecin();

        // Envoi sans aucun champ
        $this->actingAs($userMedecin)
             ->post(route('doctor.consultation.store'), [])
             ->assertSessionHasErrors(['rendez_vous_id', 'motif', 'diagnostic', 'rapport_medical']);
    }

    public function test_un_patient_ne_peut_pas_enregistrer_une_consultation(): void
    {
        $user = User::factory()->patient()->create();

        $this->actingAs($user)
             ->post(route('doctor.consultation.store'), [
                 'rendez_vous_id'  => 1,
                 'motif'           => 'Test',
                 'diagnostic'      => 'Test',
                 'rapport_medical' => 'Test',
             ])
             ->assertStatus(403);
    }
}
