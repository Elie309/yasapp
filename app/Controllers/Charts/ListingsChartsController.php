<?php

namespace App\Controllers\Charts;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Listings\PropertyModel;

class ListingsChartsController extends BaseController
{
    private $employee_id;

    public function __construct()
    {
        $this->employee_id = session()->get('id');
    }

    public function propertyStatusDistribution()
    {
        try {
            $model = new PropertyModel();
            $data = $model->select('ps.property_status_name, COUNT(properties.property_id) AS total')
                          ->join('property_status ps', 'properties.property_status_id = ps.property_status_id')
                          ->where('properties.employee_id', $this->employee_id)
                          ->groupBy('ps.property_status_name')
                          ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function propertyListingsByCity()
    {
        try {
            $model = new PropertyModel();
            $data = $model->select('ci.city_name, COUNT(properties.property_id) AS total_properties')
                          ->join('cities ci', 'properties.city_id = ci.city_id')
                          ->where('properties.employee_id', $this->employee_id)
                          ->groupBy('ci.city_name')
                          ->orderBy('total_properties', 'DESC')
                          ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function propertyTypeBreakdown()
    {
        try {
            $model = new PropertyModel();
            $data = $model->select('
                            SUM(CASE WHEN land_id IS NOT NULL THEN 1 ELSE 0 END) AS land_count,
                            SUM(CASE WHEN apartment_id IS NOT NULL THEN 1 ELSE 0 END) AS apartment_count
                        ')
                        ->where('employee_id', $this->employee_id)
                        ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function saleVsRentProperties()
    {
        try {
            $model = new PropertyModel();
            $data = $model->select('
                            SUM(CASE WHEN property_sale = TRUE THEN 1 ELSE 0 END) AS for_sale,
                            SUM(CASE WHEN property_rent = TRUE THEN 1 ELSE 0 END) AS for_rent
                        ')
                        ->where('employee_id', $this->employee_id)
                        ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function averagePropertyPriceByCity()
    {
        try {
            $model = new PropertyModel();
            $data = $model->select('ci.city_name, AVG(properties.property_price) AS avg_price')
                          ->join('cities ci', 'properties.city_id = ci.city_id')
                          ->where('properties.employee_id', $this->employee_id)
                          ->groupBy('ci.city_name')
                          ->orderBy('avg_price', 'DESC')
                          ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }

    public function propertySizeDistribution()
    {
        try {
            $model = new PropertyModel();
            $data = $model->select('property_size, COUNT(*) AS total_properties')
                          ->where('employee_id', $this->employee_id)
                          ->groupBy('property_size')
                          ->orderBy('property_size')
                          ->findAll();

            return $this->response->setStatusCode(200)->setJSON($data);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON(['error' => $e->getMessage()]);
        }
    }
}
