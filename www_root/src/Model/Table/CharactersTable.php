<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Characters Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Characters
 * @property \Cake\ORM\Association\HasMany $Agents
 * @property \Cake\ORM\Association\HasMany $Characters
 * @property \Cake\ORM\Association\HasMany $Kills
 * @property \Cake\ORM\Association\HasMany $Victims
 *
 * @method \App\Model\Entity\Character get($primaryKey, $options = [])
 * @method \App\Model\Entity\Character newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Character[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Character|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Character patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Character[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Character findOrCreate($search, callable $callback = null, $options = [])
 */
class CharactersTable extends Table
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

        $this->table('characters');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Characters', [
            'foreignKey' => 'character_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Agents', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('Characters', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('Kills', [
            'foreignKey' => 'character_id'
        ]);
        $this->hasMany('Victims', [
            'foreignKey' => 'character_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('character_name', 'create')
            ->notEmpty('character_name');
        $validator
            ->requirePresence('character_id', 'create')
            ->notEmpty('character_name');
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
        // $rules->add($rules->existsIn(['character_id'], 'Characters'));

        return $rules;
    }
}
