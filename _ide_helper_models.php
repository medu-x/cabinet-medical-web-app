<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $rendez_vous_id
 * @property int $note
 * @property string|null $commentaire
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\RendezVous $rendezVous
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereCommentaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereRendezVousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Avis whereUpdatedAt($value)
 */
	class Avis extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $telephone
 * @property string $bio
 * @property string $experience
 * @property string|null $photo_path
 * @property int $specialite_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $level
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RendezVous> $rendezVous
 * @property-read int|null $rendez_vous_count
 * @property-read \App\Models\Specialite $specialite
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereExperience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin wherePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereSpecialiteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereUserId($value)
 */
	class Medecin extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $date_naissance
 * @property string|null $telephone
 * @property string|null $adresse
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereDateNaissance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereUserId($value)
 */
	class Patient extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property int $medecin_id
 * @property string $date_rendez_vous
 * @property string $heure_rendez_vous
 * @property string $statut
 * @property string|null $notes
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Avis|null $avis
 * @property-read \App\Models\Medecin $medecin
 * @property-read \App\Models\Patient $patient
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereDateRendezVous($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereHeureRendezVous($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereMedecinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereUpdatedAt($value)
 */
	class RendezVous extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property string $description
 * @property int $prix_consultation
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialite query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialite whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialite whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialite wherePrixConsultation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialite whereUpdatedAt($value)
 */
	class Specialite extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Patient|null $patient
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

