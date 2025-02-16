<?php

namespace App\Services;

use App\Models\Settings\EmployeeSubregionModel;
use App\Models\Settings\Location\RegionModel;
use App\Models\Settings\Location\SubregionModel;

class LocationServices
{
    public function getRegionsByEmployeeId($employee_id)
    {
        $employeeSubregionModel = new EmployeeSubregionModel();
        $employeeSubregions = $employeeSubregionModel->where('employee_id', $employee_id)->findAll();
        $subregionIds = array_column($employeeSubregions, 'subregion_id');

        $subregionModel = new SubregionModel();
        $subregions = $subregionModel->select('region_id')->whereIn('subregion_id', $subregionIds)->findAll();
        $regionIds = array_column($subregions, 'region_id');

        $regionModel = new RegionModel();
        return $regionModel->select('regions.region_id as id, regions.region_name as name')
            ->whereIn('regions.region_id', $regionIds)
            ->findAll();
    }

    public function getSubregionsByEmployeeId($employee_id)
    {
        $employeeSubregionModel = new EmployeeSubregionModel();
        $employeeSubregions = $employeeSubregionModel->where('employee_id', $employee_id)->findAll();
        $subregionIds = array_column($employeeSubregions, 'subregion_id');

        $subregionModel = new SubregionModel();
        return $subregionModel->select('subregions.subregion_id as id, subregions.subregion_name as name')
            ->whereIn('subregions.subregion_id', $subregionIds)
            ->findAll();
    }
}
