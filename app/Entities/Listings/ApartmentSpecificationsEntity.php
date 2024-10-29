<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class ApartmentSpecificationsEntity extends Entity
{
    protected $datamap = [];
    
    protected $casts = [
        'spec_id' => 'int',
        'apartment_id' => 'int',
        'spec_extra_features' => 'string'
    ];

    public function setSpecHeatingSystem(string $value)
    {
        $this->attributes['spec_heating_system'] = $value == 'on' ? true : false;
    }

    public function setSpecHeatingSystemOnProvisions(string $value)
    {
        $this->attributes['spec_heating_system_on_provisions'] = $value == 'on' ? true : false;
    }

    public function setSpecAcSystem(string $value)
    {
        $this->attributes['spec_ac_system'] = $value == 'on' ? true : false;
    }

    public function setSpecAcSystemOnProvisions(string $value)
    {
        $this->attributes['spec_ac_system_on_provisions'] = $value == 'on' ? true : false;
    }

    public function setSpecDoubleWall(string $value)
    {
        $this->attributes['spec_double_wall'] = $value == 'on' ? true : false;
    }

    public function setSpecDoubleGlazing(string $value)
    {
        $this->attributes['spec_double_glazing'] = $value == 'on' ? true : false;
    }

    public function setSpecShuttersElectrical(string $value)
    {
        $this->attributes['spec_shutters_electrical'] = $value == 'on' ? true : false;
    }

    public function setSpecOakDoors(string $value)
    {
        $this->attributes['spec_oak_doors'] = $value == 'on' ? true : false;
    }

    public function setSpecChimney(string $value)
    {
        $this->attributes['spec_chimney'] = $value == 'on' ? true : false;
    }

    public function setSpecIndirectLight(string $value)
    {
        $this->attributes['spec_indirect_light'] = $value == 'on' ? true : false;
    }

    public function setSpecWoodPanelDecoration(string $value)
    {
        $this->attributes['spec_wood_panel_decoration'] = $value == 'on' ? true : false;
    }

    public function setSpecStonePanelDecoration(string $value)
    {
        $this->attributes['spec_stone_panel_decoration'] = $value == 'on' ? true : false;
    }

    public function setSpecSecurityDoor(string $value)
    {
        $this->attributes['spec_security_door'] = $value == 'on' ? true : false;
    }

    public function setSpecAlarmSystem(string $value)
    {
        $this->attributes['spec_alarm_system'] = $value == 'on' ? true : false;
    }

    public function setSpecSolarHeater(string $value)
    {
        $this->attributes['spec_solar_heater'] = $value == 'on' ? true : false;
    }

    public function setSpecIntercom(string $value)
    {
        $this->attributes['spec_intercom'] = $value == 'on' ? true : false;
    }

    public function setSpecGarage(string $value)
    {
        $this->attributes['spec_garage'] = $value == 'on' ? true : false;
    }


}
