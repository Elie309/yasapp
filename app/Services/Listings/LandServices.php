<?php 

namespace App\Services\Listings;

use App\Entities\Listings\LandDetailsEntity;
use App\Models\Listings\LandDetailsModel;
use CodeIgniter\Config\BaseService;

class LandServices extends BaseService
{

    protected $landDetailsModel;

    public function __construct()
    {
        $this->landDetailsModel = new LandDetailsModel();
    }

    /**
     * Update land details by land_id.
     *
     * @param int $land_id
     * @param array $data
     * @return bool|string
     */
    public function updateLandDetails(int $land_id, array $data)
    {
        $landDetailsEntity = new LandDetailsEntity();
        $landDetailsEntity->fill($data);
        unset($landDetailsEntity->land_id);
        unset($landDetailsEntity->property_id);

        // Update land details
        if (!$this->landDetailsModel->update($land_id, $landDetailsEntity)) {
            return $this->landDetailsModel->errors();
        }

        return true;
    }
}