<?php

namespace Increment\Marketplace\Paddock\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\APIController;
use Increment\Marketplace\Paddock\Models\Batch;
use Increment\Marketplace\Paddock\Models\Machine;
use Increment\Marketplace\Paddock\Models\SprayMix;
use Carbon\Carbon;

class BatchController extends APIController
{
    public $sprayMixClass = 'Increment\Marketplace\Paddock\Http\SprayMixController';
    public $machineClass = 'Increment\Marketplace\Paddock\Http\MachineController';

    function __construct(){
        $this->model = new Batch();
        $this->notRequired = array(
            'spray_mix_id','machine_id','notes'
        );
    }

    public function retrieveApplyTasksRecents(Request $request){
      $data = $request->all();

      $this->response['data'] = array(
        'spray_mixes' => app($this->sprayMixClass)->getByMerchantId($data['merchant_id']),
        'machines'    => app($this->machineClass)->getByMerchantId($data['merchant_id']),
        'recent_spray_mixes' => app($this->sprayMixClass)->getByMerchantId($data['merchant_id']),
        'recent_machines'    => app($this->machineClass)->getByMerchantId($data['merchant_id'])
      );

      return $this->response();
    }
}
