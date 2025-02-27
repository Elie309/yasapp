<?php

namespace App\Controllers\Charts;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Listings\PropertyModel;

class ListingsChartsController extends BaseController
{
    public function propertyStatusDistribution()
    {
        $model = new PropertyModel();
        $data = $model->select('ps.property_status_name, COUNT(properties.property_id) AS total')
                      ->join('property_status ps', 'properties.property_status_id = ps.property_status_id')
                      ->groupBy('ps.property_status_name')
                      ->findAll();

        return $this->response->setJSON($data);
    }

    public function propertyListingsByCity()
    {
        $model = new PropertyModel();
        $data = $model->select('ci.city_name, COUNT(properties.property_id) AS total_properties')
                      ->join('cities ci', 'properties.city_id = ci.city_id')
                      ->groupBy('ci.city_name')
                      ->orderBy('total_properties', 'DESC')
                      ->findAll();

        return $this->response->setJSON($data);
    }

    public function propertyTypeBreakdown()
    {
        $model = new PropertyModel();
        $data = $model->select('
                        SUM(CASE WHEN land_id IS NOT NULL THEN 1 ELSE 0 END) AS land_count,
                        SUM(CASE WHEN apartment_id IS NOT NULL THEN 1 ELSE 0 END) AS apartment_count
                    ')
                    ->findAll();

        return $this->response->setJSON($data);
    }

    public function saleVsRentProperties()
    {
        $model = new PropertyModel();
        $data = $model->select('
                        SUM(CASE WHEN property_sale = TRUE THEN 1 ELSE 0 END) AS for_sale,
                        SUM(CASE WHEN property_rent = TRUE THEN 1 ELSE 0 END) AS for_rent
                    ')
                    ->findAll();

        return $this->response->setJSON($data);
    }

    public function averagePropertyPriceByCity()
    {
        $model = new PropertyModel();
        $data = $model->select('ci.city_name, AVG(properties.property_price) AS avg_price')
                      ->join('cities ci', 'properties.city_id = ci.city_id')
                      ->groupBy('ci.city_name')
                      ->orderBy('avg_price', 'DESC')
                      ->findAll();

        return $this->response->setJSON($data);
    }

    public function propertySizeDistribution()
    {
        $model = new PropertyModel();
        $data = $model->select('property_size, COUNT(*) AS total_properties')
                      ->groupBy('property_size')
                      ->orderBy('property_size')
                      ->findAll();

        return $this->response->setJSON($data);
    }
}
