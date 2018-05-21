<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Competitions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tournaments
 * @property \Cake\ORM\Association\BelongsTo $Organisers
 * @property \Cake\ORM\Association\BelongsTo $Winners
 * @property \Cake\ORM\Association\HasMany $Entries
 *
 * @method \App\Model\Entity\Competition get($primaryKey, $options = [])
 * @method \App\Model\Entity\Competition newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Competition[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Competition|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Competition patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Competition[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Competition findOrCreate($search, callable $callback = null)
 */
class CompetitionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('competitions');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Tournaments', [
            'foreignKey' => 'tournament_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Organisers', [
			'className' => 'Users',
        	'foreignKey' => 'organiser_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Winners', [
			'className' => 'Users',
        	'foreignKey' => 'winner_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Entries', [
            'foreignKey' => 'competition_id'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create')
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->boolean('invite_only')
            ->requirePresence('invite_only', 'create')
            ->notEmpty('invite_only');

        $validator
            ->integer('prize_percent')
            ->requirePresence('prize_percent', 'create')
            ->notEmpty('prize_percent');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['id']));
        $rules->add($rules->existsIn(['tournament_id'], 'Tournaments'));
        $rules->add($rules->existsIn(['organiser_id'], 'Organisers'));
        $rules->add($rules->existsIn(['winner_id'], 'Winners'));

        return $rules;
    }
}
