<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Displays a view
     *
     * @return void|\Cake\Network\Response
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */

    public function home(){
        $d = date('Y-m');
        // $d ='2016-12';
        $root = 'results/'.$d.'/';
        // $root = 'results/__alltime__/';
        $data = file_get_contents($root.'agents.json');
        $agentData = json_decode($data);
        usort($agentData->agents,'cmpISK');

        $data = file_get_contents($root.'ships.json');
        $shipsData = json_decode($data);
        usort($shipsData->ships,'cmpISK');

        $data = file_get_contents($root.'stratios.json');
        $stratiosData = json_decode($data);
        usort($stratiosData->agents,'cmpShips');

        $data = file_get_contents($root.'bombers.json');
        $bombersData = json_decode($data);
        usort($bombersData->agents,'cmpShips');

        $data = file_get_contents($root.'solo_hunter.json');
        $soloData = json_decode($data);
        usort($soloData->agents,'cmpISK');
        //calculate ship stats
        $shipsChart = $shipsData->ships;
        $totalNave = 0;
        foreach ($shipsChart as $s){
            $totalNave += $s->ships_destroyed;
        }
        foreach ($shipsChart as $i => $s){
            $shipsChart[$i]->pct = round($s->ships_destroyed * 100 / $totalNave);
        }

         $data = file_get_contents($root.'general_stats.json');
        $generalData = json_decode($data);
        
        $this->set(compact('agentData','shipsData','stratiosData','bombersData','soloData','shipsChart','totalNave','generalData'));
    }

    
    public function display()
    {
        $path = func_get_args();

        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
}
