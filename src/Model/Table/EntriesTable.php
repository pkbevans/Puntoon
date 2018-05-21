<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Entries Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Competitions
 * @property \Cake\ORM\Association\BelongsTo $Users
 * @property \Cake\ORM\Association\BelongsTo $Team1s
 * @property \Cake\ORM\Association\BelongsTo $Team2s
 * @property \Cake\ORM\Association\BelongsTo $Team3s
 * @property \Cake\ORM\Association\BelongsTo $Team4s
 * @property \Cake\ORM\Association\BelongsTo $Team5s
 * @property \Cake\ORM\Association\BelongsTo $Statuses
 *
 * @method \App\Model\Entity\Entry get($primaryKey, $options = [])
 * @method \App\Model\Entity\Entry newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Entry[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Entry|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Entry patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Entry[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Entry findOrCreate($search, callable $callback = null)
 */
class EntriesTable extends Table
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

        $this->table('entries');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->belongsTo('Competitions', [
            'foreignKey' => 'competition_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Team1s', [
			'className' => 'Teams',
        	'foreignKey' => 'team_1_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Team2s', [
			'className' => 'Teams',
        	'foreignKey' => 'team_2_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Team3s', [
			'className' => 'Teams',
        	'foreignKey' => 'team_3_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Team4s', [
			'className' => 'Teams',
        	'foreignKey' => 'team_4_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Team5s', [
			'className' => 'Teams',
        	'foreignKey' => 'team_5_id',
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
            ->add('id', 'unique', ['rule' => 'validateUnique', 'provider' => 'table'])
        	->notEmpty('name','Please give your punt a name');

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
        $rules->add($rules->existsIn(['competition_id'], 'Competitions'));
        $rules->add($rules->existsIn(['user_id'], 'Users'));
        $rules->add($rules->existsIn(['team_1_id'], 'Team1s'));
        $rules->add($rules->existsIn(['team_2_id'], 'Team2s'));
        $rules->add($rules->existsIn(['team_3_id'], 'Team3s'));
        $rules->add($rules->existsIn(['team_4_id'], 'Team4s'));
        $rules->add($rules->existsIn(['team_5_id'], 'Team5s'));
        $rules->add($rules->existsIn(['status_id'], 'Statuses'));

        return $rules;
    }
}
