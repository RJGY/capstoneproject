<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Labbooking Controller
 *
 * @property \App\Model\Table\LabBookingsTable $labBookings
 * @method \App\Model\Entity\Labbooking[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LabBookingsController extends AppController
{
    public function index()
    {
        $this->Authorization->skipAuthorization();
        $this->loadModel('LabBookings');
        $labBookings = $this->paginate($this->LabBookings);
        $this->set(compact('labBookings'));
    }

    public function view($id = null)
    {
        $this->Authorization->skipAuthorization();
        $this->loadModel('LabBookings');
        $labBookings = $this->LabBookings->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('labBookings'));
    }

    public function add()
    {
        $this->Authorization->skipAuthorization();

        $this->loadModel('LabBookings');
                
        $labBookings = $this->LabBookings->newEmptyEntity();

        //$this->Authorization->authorize($labBookings);
        if ($this->request->is('post')) {
            $labBookings = $this->LabBookings->patchEntity($labBookings, $this->request->getData());
            if ($this->LabBookings->save($labBookings)) {
                $this->Flash->success(__('Your lab booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Your lab booking could not be saved. Please, try again.'));
        }
        $this->set(compact('labBookings'));
    }

    public function edit($id = null)
    {
        $this->Authorization->skipAuthorization();

        $this->loadModel('LabBookings');
        $labBookings = $this->LabBookings->get($id, [
            'contain' => [],
        ]);
        
        //$this->Authorization->authorize($labBookings);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $labBookings = $this->LabBookings->patchEntity($labBookings, $this->request->getData());
            if ($this->LabBookings->save($labBookings)) {
                $this->Flash->success(__('Your lab booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('You lab booking could not be saved. Please, try again.'));
        }
        $this->set(compact('labBookings'));
    }

    public function delete($id = null)
    {
        $this->Authorization->skipAuthorization();
        
        $this->loadModel('LabBookings');
        
        //$this->request->allowMethod(['post', 'delete']);

        $labBookings = $this->LabBookings->get($id);
        $this->Authorization->authorize($labBookings);
        if ($this->LabBookings->delete($labBookings)) {
            $this->Flash->success(__('Your lab booking has been deleted.'));
        } else {
            $this->Flash->error(__('Your lab booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
