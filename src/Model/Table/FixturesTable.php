<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fixtures Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tournaments
 * @property \Cake\ORM\Association\BelongsTo $TeamAs
 * @property \Cake\ORM\Association\BelongsTo $TeamBs
 * @property \Cake\ORM\Association\BelongsTo $Statuses
 *
 * @method \App\Model\Entity\Fixture get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fixture newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Fixture[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fixture|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fixture patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fixture[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fixture findOrCreate($search, callable $callback = null)
 */
class FixturesTable extends Table
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

        $this->table('fixtures');
        $this->displayField('description');
        $this->primaryKey('id');

        $this->belongsTo('Tournaments', [
            'foreignKey' => 'tournament_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TeamAs', [
        	'className' => 'Teams',
        	'foreignKey' => 'team_a_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('TeamBs', [
			'className' => 'Teams',
        	'foreignKey' => 'team_b_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Statuses', [
            'foreignKey' => 'status_id',
            'joinType' => 'INNER'
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
            ->dateTime('date')
            ->requirePresence('date', 'create')
            ->notEmpty('date');

        $validator
            ->requirePresence('description', 'create')
            ->notEmpty('description');

        $validator
            ->integer('team_a_score');
//             ->requirePresence('team_a_score', 'create')
//             ->notEmpty('team_a_score');

        $validator
            ->integer('team_b_score');
//             ->requirePresence('team_b_score', 'create')
//             ->notEmpty('team_b_score');

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
        $rules->add($rules->existsIn(['team_a_id'], 'TeamAs'));
        $rules->add($rules->existsIn(['team_b_id'], 'TeamBs'));
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));

        return $rules;
    }
}
