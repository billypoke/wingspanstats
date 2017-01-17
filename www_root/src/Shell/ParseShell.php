<?php
namespace App\Shell;
use Cake\Console\Shell;
use Cake\Core\Exception\Exception;
use Cake\Core\Configure;

// DON'T IF I NEED IT
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Cake\ORM\Table;
use Cake\Datasource\EntityInterface;

class ParseShell extends Shell{

	public function initialize(){
		parent::initialize();
		$this->loadModel('Characters');
		$this->loadModel('SolarSystems');
		$this->loadModel('ShipTypes');
		$this->loadModel('Kills');
	}

	
	public function checkIfAgentExists($character_id){
		$character = false;
		try{
			$character = $this->Characters->find('all')->where(['Characters.character_id = ' => $character_id]);
			
			$result = $character->all()->toArray();
			
			
			if (empty($result)) throw new Exception(__('_noUserFound'));
		}
		catch(Exception $e){
			$this->out($e->getMessage());
			return false;
		}
		return true;
		
	}

	public function checkIfKillExists($kill_id){
		$ss = false;
		try{
			$ss = $this->Kills->find('all')->where(['Kills.kill_id = ' => $kill_id]);
			$result = $ss->all()->toArray();
			if (empty($result)) throw new Exception(__('_noKillFound'));
		}
		catch(Exception $e){
			$this->out($e->getMessage());
			return false;
		}
		return true;
		
	}

	public function checkIfShipExists($ship_type_id){
		$ss = false;
		try{
			$ss = $this->ShipTypes->find('all')->where(['ShipTypes.ship_type_id = ' => $ship_type_id]);
			$result = $ss->all()->toArray();
			if (empty($result)) throw new Exception(__('_noShipTypeFound'));
		}
		catch(Exception $e){
			$this->out($e->getMessage());
			return false;
		}
		return true;
		
	}

	public function checkIfSolarSystemExists($solarsystem_id){
		$ss = false;
		try{
			$ss = $this->SolarSystems->find('all')->where(['SolarSystems.solar_system_id = ' => $solarsystem_id]);
			$result = $ss->all()->toArray();
			if (empty($result)) throw new Exception(__('_noSolarSystem'));
		}
		catch(Exception $e){
			$this->out($e->getMessage());
			return false;
		}
		return true;
		
	}
	public function addCharacter($c){
		try{
			if ($this->checkIfAgentExists((int)$c['character_id'])) throw new Exception('Character exists');
			$character = $this->Characters->newEntity();
			$character = $this->Characters->patchEntity($character,$c);
			if ($this->Characters->save($character)){

				// $this->out("Salvat");
				return true;
			}else{
				$this->out("NOT Salvat");
				return false;
			}	
		}catch (Exception $e){
			// $this->Log($e->getMessage());
			return false;
		}
		return true;
		
	}
	public function addSystems($s){
		try{
			if ($this->checkIfSolarSystemExists((int)$s['solar_system_id'])) throw new Exception('SolarSystems exists');
			$SolarSystems = $this->SolarSystems->newEntity();
			$SolarSystems = $this->SolarSystems->patchEntity($SolarSystems,$s);
			if ($this->SolarSystems->save($SolarSystems)){

				// $this->out("Salvat");
				return true;
			}else{
				$this->out("NOT Salvat");
				return false;
			}	
		}catch (Exception $e){
			// $this->Log($e->getMessage());
			return false;
		}
		return true;
		
	}

	public function addShips($s){
		try{
			if ($this->checkIfShipExists((int)$s['ship_type_id'])) throw new Exception('ship_type_id exists');
			$ship = $this->ShipTypes->newEntity();
			$ship = $this->ShipTypes->patchEntity($ship,$s);
			if ($this->ShipTypes->save($ship)){

				// $this->out("Salvat");
				return true;
			}else{
				$this->out("NOT Salvat");
				return false;
			}	
		}catch (Exception $e){
			// $this->Log($e->getMessage());
			return false;
		}
		return true;
		
	}

	public function addKill($s){
		try{
			if ($this->checkIfKillExists((int)$s['kill_id'])) throw new Exception('kill_id exists');
			$ship = $this->Kills->newEntity();
			$ship = $this->Kills->patchEntity($ship,$s);
			// debug($ship);die();
			if ($this->Kills->save($ship)){

				// $this->out("Salvat");
				return true;
			}else{
				$this->out($ship);die();
				$this->out("NOT Salvat");
				return false;
			}	
		}catch (Exception $e){
			// $this->Log($e->getMessage());
			return false;
		}
		return true;
		
	}

	public function parseJsonAgents($date = '2017-01'){
		 $root = WWW_ROOT.'results/'.$date.'/';
		 $data = file_get_contents($root.'agents.json');
         $agentData = json_decode($data);
         foreach ($agentData->agents as $a){
         	$c = array(
         		'character_name' => $a->character_name,
         		'character_id' =>(int)$a->character_id
         		);
         	// debug($c);die();
         	$this->addCharacter($c);
         }
         $root = WWW_ROOT.'results/'.$date.'/';
		 $data = file_get_contents($root.'kills.json');
         $agentData = json_decode($data);
         foreach ($agentData->kills as $a){
         	$c = array(
         		'character_name' => ($a->character_id == 0 ? 'Unknown':$a->character_name),
         		'character_id' =>(int)$a->character_id
         		);
         	// debug($c);die();
         	$this->addCharacter($c);
         }
         $root = WWW_ROOT.'results/'.$date.'/';
		 $data = file_get_contents($root.'victims.json');
         $agentData = json_decode($data);
         foreach ($agentData->victims as $a){
         	$c = array(
         		'character_name' => ($a->character_id == 0 ? 'Unknown':$a->character_name),
         		'character_id' =>(int)$a->character_id
         		);
         	// debug($c);die();
         	$this->addCharacter($c);
         }
        // usort($agentData->agents,'cmpISK');
	}
	public function parseJsonSystems(){
		$root = WWW_ROOT.'results/inputdata/';
		$data = file_get_contents($root.'systems.json');
        $agentData = json_decode($data);

	     foreach ($agentData->systems as $id => $data){
	     	$this->addSystems(['solar_system_id'=>$id,'name'=>$data->name]);
	     	// $this->out("System $id is " . $data->name);
	     }
	}

	public function parseShipTypes($date = '2017-01'){
		 $root = WWW_ROOT.'results/'.$date.'/';
		 $data = file_get_contents($root.'ships.json');
         $agentData = json_decode($data);
         foreach ($agentData->ships as $a){
         	$c = array(
         		'name' => ($a->ship_type_id == 0 ? 'Unknown':$a->ship_name),
         		'ship_type_id' =>(int)$a->ship_type_id
         		);
         	// debug($c);die();
         	$this->addShips($c);
         }
	}

	//
	//should modify tfor item id and value to update with real name as there seems to be a bit of a debate upon what 
	//the fuck the item type id really is
	public function parseKills($date = '2017-01'){
		 $root = WWW_ROOT.'results/'.$date.'/';
		 $data = file_get_contents($root.'kills.json');
         $agentData = json_decode($data);
         $this->out("File is $root/kills.json");
         foreach ($agentData->kills as $a){
         	$c = array(
         		'solar_system_id' => (int) $a->solar_system_id,
         		'character_id' =>(int)$a->character_id,
         		'value' => (float) $a->value,
         		'kill_id'=>$a->kill_id,
         		'date' => $a->date,
         		'ship_type_id'=>$a->ship_type_id
         		);
         	// debug($c);die();
         	$this->addKill($c);
         }
	}



	// public function parseAgents()
	// public function parseAKills()
	// public function parseShips()
	// public function parsevictims
	
	public function main(){
		for ($i = 2015; $i<2018; $i++){
			for ($j = 1; $j <13;$j++){

				if ($j < 10) $str = "$i-0$j"; else $file= "$i-$j";
				$this->Log("Parsing file " . $str);
				$this->parseJsonAgents($str);
				$this->parseKills($str);		
			}
		}
		$this->parseKills();
		// $this->parseShipTypes();
		// $this->checkIfAgentExists(1);
		// $c = ['character_name' =>"Test",
 	// 				'character_id'=>1
 	// 				];
		// $this->addCharacter($c);
		
	}
}
?>