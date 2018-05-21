<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Entry Entity
 *
 * @property int $id
 * @property int $competition_id
 * @property int $user_id
 * @property string $name
 * @property int $team_1_id
 * @property int $team_2_id
 * @property int $team_3_id
 * @property int $team_4_id
 * @property int $team_5_id
 * @property int $status_id
 *
 * @property \App\Model\Entity\Competition $competition
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Team1 $team1
 * @property \App\Model\Entity\Team2 $team2
 * @property \App\Model\Entity\Team3 $team3
 * @property \App\Model\Entity\Team4 $team4
 * @property \App\Model\Entity\Team5 $team5
 * @property \App\Model\Entity\Status $status
 */
class Entry extends Entity
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
