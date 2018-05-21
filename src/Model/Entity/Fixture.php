<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fixture Entity
 *
 * @property int $id
 * @property int $tournament_id
 * @property \Cake\I18n\Time $date
 * @property string $description
 * @property int $team_a_id
 * @property int $team_a_score
 * @property int $team_b_score
 * @property int $team_b_id
 * @property int $status_id
 *
 * @property \App\Model\Entity\Tournament $tournament
 * @property \App\Model\Entity\TeamA $team_a
 * @property \App\Model\Entity\TeamB $team_b
 * @property \App\Model\Entity\Status $status
 */
class Fixture extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
