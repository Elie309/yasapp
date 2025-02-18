<?php

namespace App\Entities\Listings;

use CodeIgniter\Entity\Entity;

class ApartmentSpecificationsEntity extends Entity
{
    protected $datamap = [];

    protected $casts = [
        'spec_id' => 'int',
        'apartment_id' => 'int',
    ];

    protected $defaultBooleans = [
        'spec_heating_system',
        'spec_heating_system_provision',
        'spec_ac_system',
        'spec_ac_system_provision',
        'spec_double_wall',
        'spec_double_glazing',
        'spec_shutters_electrical',
        'spec_oak_doors',
        'spec_chimney',
        'spec_indirect_light',
        'spec_wood_panel_decoration',
        'spec_stone_panel_decoration',
        'spec_security_door',
        'spec_alarm_system',
        'spec_solar_heater',
        'spec_intercom',
        'spec_garage',
        'specs_jacuzzi',
        'spec_swimming_pool',
        'spec_gym',
        'spec_kitchenette',
        'spec_driver_room',
    ];

    public function fill(array $data = null)
    {
        parent::fill($data);

        foreach ($this->defaultBooleans as $attribute) {

            //Check if the attribute is not set - if not set, set it to false -- Checkbox values are not sent when unchecked
            if (!isset($this->attributes[$attribute])) {
                $this->attributes[$attribute] = false;
            }
        }

        return $this;
    }

    public function setSpecHeatingSystem(string $value)
    {
        $this->attributes['spec_heating_system'] = $value == 'on' ? true : false;
    }

    public function setSpecHeatingSystemProvision(string $value)
    {
        $this->attributes['spec_heating_system_provision'] = $value == 'on' ? true : false;
    }

    public function setSpecAcSystem(string $value)
    {
        $this->attributes['spec_ac_system'] = $value == 'on' ? true : false;
    }

    public function setSpecAcSystemProvision(string $value)
    {
        $this->attributes['spec_ac_system_provision'] = $value == 'on' ? true : false;
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

    public function setSpecsJacuzzi(string $value)
    {
        $this->attributes['specs_jacuzzi'] = $value == 'on' ? true : false;
    }

    public function setSpecSwimmingPool(string $value)
    {
        $this->attributes['spec_swimming_pool'] = $value == 'on' ? true : false;
    }

    public function setSpecGym(string $value)
    {
        $this->attributes['spec_gym'] = $value == 'on' ? true : false;
    }

    public function setSpecKitchenette(string $value)
    {
        $this->attributes['spec_kitchenette'] = $value == 'on' ? true : false;
    }

    public function setSpecDriverRoom(string $value)
    {
        $this->attributes['spec_driver_room'] = $value == 'on' ? true : false;
    }

    //Getters return ONLY TRUE or FALSE

    public function getSpecHeatingSystem()
    {
        return $this->attributes['spec_heating_system'] ? true : false;
    }

    public function getSpecHeatingSystemProvision()
    {
        return $this->attributes['spec_heating_system_provision'] ? true : false;
    }

    public function getSpecAcSystem()
    {
        return $this->attributes['spec_ac_system'] ? true : false;
    }

    public function getSpecAcSystemProvision()
    {
        return $this->attributes['spec_ac_system_provision'] ? true : false;
    }

    public function getSpecDoubleWall()
    {
        return $this->attributes['spec_double_wall'] ? true : false;
    }

    public function getSpecDoubleGlazing()
    {
        return $this->attributes['spec_double_glazing'] ? true : false;
    }

    public function getSpecShuttersElectrical()
    {
        return $this->attributes['spec_shutters_electrical'] ? true : false;
    }

    public function getSpecOakDoors()
    {
        return $this->attributes['spec_oak_doors'] ? true : false;
    }

    public function getSpecChimney()
    {
        return $this->attributes['spec_chimney'] ? true : false;
    }

    public function getSpecIndirectLight()
    {
        return $this->attributes['spec_indirect_light'] ? true : false;
    }

    public function getSpecWoodPanelDecoration()
    {
        return $this->attributes['spec_wood_panel_decoration'] ? true : false;
    }

    public function getSpecStonePanelDecoration()
    {
        return $this->attributes['spec_stone_panel_decoration'] ? true : false;
    }

    public function getSpecSecurityDoor()
    {
        return $this->attributes['spec_security_door'] ? true : false;
    }

    public function getSpecAlarmSystem()
    {
        return $this->attributes['spec_alarm_system'] ? true : false;
    }

    public function getSpecSolarHeater()
    {
        return $this->attributes['spec_solar_heater'] ? true : false;
    }

    public function getSpecIntercom()
    {
        return $this->attributes['spec_intercom'] ? true : false;
    }

    public function getSpecGarage()
    {
        return $this->attributes['spec_garage'] ? true : false;
    }

    public function getSpecsJacuzzi()
    {
        return $this->attributes['specs_jacuzzi'] ? true : false;
    }

    public function getSpecSwimmingPool()
    {
        return $this->attributes['spec_swimming_pool'] ? true : false;
    }

    public function getSpecGym()
    {
        return $this->attributes['spec_gym'] ? true : false;
    }

    public function getSpecKitchenette()
    {
        return $this->attributes['spec_kitchenette'] ? true : false;
    }

    public function getSpecDriverRoom()
    {
        return $this->attributes['spec_driver_room'] ? true : false;
    }
    
}
