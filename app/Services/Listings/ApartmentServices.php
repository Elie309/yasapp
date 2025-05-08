<?php 

namespace App\Services\Listings;

use App\Entities\Listings\ApartmentDetailsEntity;
use App\Entities\Listings\ApartmentPartitionsEntity;
use App\Entities\Listings\ApartmentSpecificationsEntity;
use App\Models\Listings\ApartmentDetailsModel;
use App\Models\Listings\ApartmentPartitionsModel;
use App\Models\Listings\ApartmentSpecificationsModel;
use App\Services\BaseServices;

class ApartmentServices extends BaseServices
{

    protected $apartmentDetailsModel;
    protected $apartmentPartitionsModel;
    protected $apartmentSpecsModel;

    public function __construct()
    {
        $this->apartmentDetailsModel = new ApartmentDetailsModel();
        $this->apartmentPartitionsModel = new ApartmentPartitionsModel();
        $this->apartmentSpecsModel = new ApartmentSpecificationsModel();
    }

    /**
     * Update apartment details, partitions, and specifications.
     *
     * @param int $apartment_id
     * @param array $data
     * @return bool|string
     */
    public function updateApartmentWithDetails(int $apartment_id, array $data)
    {
        // Update apartment details
        $apartmentDetailsEntity = new ApartmentDetailsEntity();
        $apartmentDetailsEntity->fill($data);
        unset($apartmentDetailsEntity->apartment_id);

        if (!$this->apartmentDetailsModel->update($apartment_id, $apartmentDetailsEntity)) {
            return $this->apartmentDetailsModel->errors();
        }

        // Update apartment partitions
        $apartmentPartitionsEntity = new ApartmentPartitionsEntity();
        $apartmentPartitionsEntity->fill($data);

        $partition = $this->apartmentPartitionsModel->where('apartment_id', $apartment_id)->first();
        if (!$this->apartmentPartitionsModel->update($partition->partition_id, $apartmentPartitionsEntity)) {
            return $this->apartmentPartitionsModel->errors();
        }

        // Update apartment specifications
        $apartmentSpecsEntity = new ApartmentSpecificationsEntity();
        $apartmentSpecsEntity->fill($data);

        $spec = $this->apartmentSpecsModel->where('apartment_id', $apartment_id)->first();
        if (!$this->apartmentSpecsModel->update($spec->spec_id, $apartmentSpecsEntity)) {
            return $this->apartmentSpecsModel->errors();
        }

        return true;
    }


}

?>
