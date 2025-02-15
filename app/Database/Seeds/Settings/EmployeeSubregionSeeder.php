<?php

namespace App\Database\Seeds\Settings;

use CodeIgniter\Database\Seeder;
use App\Models\Settings\EmployeeModel;
use App\Models\Settings\Location\SubregionModel;

class EmployeeSubregionSeeder extends Seeder
{
    public function run()
    {
        $employeeModel = new EmployeeModel();
        $subregionModel = new SubregionModel();

        $employees = $employeeModel->findAll();
        $subregions = $subregionModel->findAll();

        $data = [];

        for ($i = 0; $i < 20; $i++) {
            $employeeId = $employees[array_rand($employees)]->employee_id;
            $subregionKey = array_rand($subregions);
            $subregionId = $subregions[$subregionKey]->subregion_id;

            $data[] = [
                'employee_id' => $employeeId,
                'subregion_id' => $subregionId,
            ];

            // Remove the assigned subregion from the list
            unset($subregions[$subregionKey]);
            // Reindex the array to avoid gaps
            $subregions = array_values($subregions);
        }

        // Using Query Builder
        $this->db->table('employee_subregions')->insertBatch($data);
    }
}
