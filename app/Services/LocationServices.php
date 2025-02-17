<?php

namespace App\Services;

use App\Models\Settings\EmployeeSubregionModel;
use App\Models\Settings\Location\RegionModel;
use App\Models\Settings\Location\SubregionModel;

class LocationServices
{
    public function getRegionsByEmployeeId($employee_id, $country_id = null, $role = null)
    {
        if ($role !== 'manager' && $role !== 'admin') {
            $employeeSubregionModel = new EmployeeSubregionModel();
            $employeeSubregions = $employeeSubregionModel->where('employee_id', $employee_id)->findAll();
            $subregionIds = array_column($employeeSubregions, 'subregion_id');


            $subregionModel = new SubregionModel();
            $subregions = $subregionModel->select('region_id')->whereIn('subregion_id', $subregionIds)->findAll();
            $regionIds = array_column($subregions, 'region_id');

            $regionModel = new RegionModel();
            $query = $regionModel->select('regions.region_id as id, regions.region_name as name')
                ->whereIn('regions.region_id', $regionIds);

            if ($country_id !== null) {
                $query->where('regions.country_id', $country_id);
            }

            return $query->findAll();
        } else {
            $regionModel = new RegionModel();
            $query = $regionModel->select('regions.region_id as id, regions.region_name as name');

            if ($country_id !== null) {
                $query->where('regions.country_id', $country_id);
            }

            return $query->findAll();
        }
    }

    public function getSubregionsByEmployeeId($employee_id, $region_id = null, $role = null)
    {
        log_message('debug', 'LocationServices getSubregionsByEmployeeId employee_id: ' . $employee_id . ' region_id: ' . $region_id . ' role: ' . json_encode($role));
        if ($role !== 'manager' && $role !== 'admin') {
            $employeeSubregionModel = new EmployeeSubregionModel();
            $employeeSubregions = $employeeSubregionModel->where('employee_id', $employee_id)->findAll();
            $subregionIds = array_column($employeeSubregions, 'subregion_id');

            $subregionModel = new SubregionModel();
            $query = $subregionModel->select('subregions.subregion_id as id, subregions.subregion_name as name')
                ->whereIn('subregions.subregion_id', $subregionIds);

            if ($region_id !== null) {
                $query->where('subregions.region_id', $region_id);
            }

            return $query->findAll();
        } else {
            $subregionModel = new SubregionModel();
            $query = $subregionModel->select('subregions.subregion_id as id, subregions.subregion_name as name');

            if ($region_id !== null) {
                $query->where('subregions.region_id', $region_id);
            }

            return $query->findAll();
        }
    }
}
