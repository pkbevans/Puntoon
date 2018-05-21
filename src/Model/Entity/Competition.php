<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Competition Entity
 *
 * @property int $id
 * @property int $tournament_id
 * @property string $name
 * @property int $organiser_id
 * @property int $winner_id
 * @property bool $invite_only
 * @property int $prize_percent
 *
 * @property \App\Model\Entity\Tournament $tournament
 * @property \App\Model\Entity\Organiser $organiser
 * @property \App\Model\Entity\Winner $winner
 * @property \App\Model\Entity\Entry[] $entries
 */
class Competition extends Entity
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
