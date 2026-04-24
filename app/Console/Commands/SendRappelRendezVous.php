<?php

namespace App\Console\Commands;

use App\Mail\RappelRendezVousMail;
use App\Models\RendezVous;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendRappelRendezVous extends Command
{
    protected $signature   = 'rappel:rendezvous';
    protected $description = 'Send a reminder email to patients with an appointment tomorrow';

    public function handle(): void
    {
        $tomorrow = Carbon::tomorrow()->toDateString();

        $rendezVous = RendezVous::with(['patient.user', 'medecin.user', 'medecin.specialite'])
            ->whereDate('date_rendez_vous', $tomorrow)
            ->whereIn('statut', ['en_attente', 'confirmé'])
            ->get();

        foreach ($rendezVous as $rdv) {
            $email = $rdv->patient->user->email ?? null;
            if (!$email) continue;

            Mail::to($email)->send(new RappelRendezVousMail($rdv));
            $this->info("Rappel envoyé à {$email} pour le RDV #{$rdv->id}");
        }

        $this->info("Total : {$rendezVous->count()} rappel(s) envoyé(s).");
    }
}
