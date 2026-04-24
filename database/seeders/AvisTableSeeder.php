<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvisTableSeeder extends Seeder
{
    public function run(): void
    {
        $rdvId = function (string $patientEmail, string $doctorEmail, string $date) {
            $patientId = DB::table('patients')
                ->where('user_id', DB::table('users')->where('email', $patientEmail)->value('id'))
                ->value('id');

            $medecinId = DB::table('medecins')
                ->where('user_id', DB::table('users')->where('email', $doctorEmail)->value('id'))
                ->value('id');

            return DB::table('rendez_vous')
                ->where('patient_id', $patientId)
                ->where('medecin_id', $medecinId)
                ->where('date_rendez_vous', $date)
                ->value('id');
        };

        $avis = [
            [
                'rdv'         => $rdvId('MOHAMED@CABINET.COM',       'claire.vallet@example.com',  '2026-04-08'),
                'note'        => 5,
                'commentaire' => 'Consultation très sérieuse, médecin compétent et à l\'écoute. Je reviendrai certainement.',
            ],
            [
                'rdv'         => $rdvId('sara.benali@example.com',   'marc.antoine@example.com',   '2026-04-09'),
                'note'        => 4,
                'commentaire' => 'Bon diagnostic et explications claires. Attente un peu longue mais ça vaut le déplacement.',
            ],
            [
                'rdv'         => $rdvId('hamid.ouchane@gmail.com',   'omar.elfassi@cabinet.ma',    '2026-04-10'),
                'note'        => 5,
                'commentaire' => 'Dr. El Fassi est excellent! Très professionnel, il a pris le temps d\'écouter tous mes symptômes. Je recommande vivement.',
            ],
            [
                'rdv'         => $rdvId('amina.bouchikhi@gmail.com', 'ahmed.rhazoui@cabinet.ma',   '2026-04-12'),
                'note'        => 5,
                'commentaire' => 'Très bon pédiatre, mon fils était rassuré dès le début. Explications claires et traitement efficace. Mille mercis Dr. Rhazoui!',
            ],
            [
                'rdv'         => $rdvId('tariq.senhaji@gmail.com',   'meryem.tazi@cabinet.ma',     '2026-04-15'),
                'note'        => 4,
                'commentaire' => 'Docteure Tazi est compétente et rassurante. Suivi de qualité. Le cabinet est propre et bien organisé.',
            ],
        ];

        foreach ($avis as $item) {
            if ($item['rdv']) {
                DB::table('avis')->insert([
                    'rendez_vous_id' => $item['rdv'],
                    'note'           => $item['note'],
                    'commentaire'    => $item['commentaire'],
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }
        }
    }
}
