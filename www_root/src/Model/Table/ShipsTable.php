<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ships Model
 *
 * @property \Cake\ORM\Association\BelongsTo $ShipTypes
 *
 * @method \App\Model\Entity\Ship get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ship newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ship[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ship|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ship patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ship[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ship findOrCreate($search, callable $callback = null, $options = [])
 */
class ShipsTable extends Table
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

        $this->table('ships');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('ShipTypes', [
            'foreignKey' => 'ship_type_id',
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
            ->integer('ships_destroyed')
            ->requirePresence('ships_destroyed', 'create')
            ->notEmpty('ships_destroyed');

        $validator
            ->numeric('isk_destroyed')
            ->requirePresence('isk_destroyed', 'create')
            ->notEmpty('isk_destroyed');

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
        $rules->add($rules->existsIn(['ship_type_id'], 'ShipTypes'));

        return $rules;
    }
}
