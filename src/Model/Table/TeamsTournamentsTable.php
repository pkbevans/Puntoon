<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TeamsTournaments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Tournaments
 * @property \Cake\ORM\Association\BelongsTo $Teams
 *
 * @method \App\Model\Entity\TeamsTournament get($primaryKey, $options = [])
 * @method \App\Model\Entity\TeamsTournament newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TeamsTournament[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TeamsTournament|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TeamsTournament patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TeamsTournament[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TeamsTournament findOrCreate($search, callable $callback = null)
 */
class TeamsTournamentsTable extends Table
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

        $this->table('teams_tournaments');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Tournaments', [
            'foreignKey' => 'tournament_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
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
            ->integer('goals')
            ->allowEmpty('goals');

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
        $rules->add($rules->existsIn(['team_id'], 'Teams'));

        return $rules;
    }
    
    public function findXXX(Query $query, array $options)
    {
    	$tournament_id = $options['tournament_id'];
    	$team_id = $options['team_id'];
    	return $query->where(['tournament_id' => $tournament_id,'team_id'=>$team_id] );
    }
}
