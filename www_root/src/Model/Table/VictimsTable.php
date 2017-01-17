<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Victims Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Characters
 *
 * @method \App\Model\Entity\Victim get($primaryKey, $options = [])
 * @method \App\Model\Entity\Victim newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Victim[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Victim|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Victim patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Victim[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Victim findOrCreate($search, callable $callback = null, $options = [])
 */
class VictimsTable extends Table
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

        $this->table('victims');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('ships_lost', 'create')
            ->notEmpty('ships_lost');

        $validator
            ->numeric('isk_lost')
            ->requirePresence('isk_lost', 'create')
            ->notEmpty('isk_lost');

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
        $rules->add($rules->existsIn(['character_id'], 'Characters'));

        return $rules;
    }
}
