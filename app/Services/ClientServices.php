<?php 
namespace App\Services;

use App\Entities\Clients\ClientEntity;
use App\Models\Clients\ClientModel;
use App\Models\Clients\PhoneModel;
use InvalidArgumentException;

class ClientServices extends BaseServices
{

    public function updateClient(ClientEntity $clientEntity, array $phones, array $countries)
    {
        $clientModel = new ClientModel();
        $phoneModel = new PhoneModel();

        try {

            // Find existing client
            $client = $clientModel->find($clientEntity->client_id);

            if (!$client) {
                throw new InvalidArgumentException('Client not found');
            }

            // Update client information
            if (!$clientModel->update($clientEntity->client_id, $clientEntity)) {
                throw new InvalidArgumentException('Failed to update client');
            }

            // Get current phone numbers and countries
            $currentPhones = $phoneModel->where('client_id', $clientEntity->client_id)->findAll();
            $currentPhoneData = [];
            foreach ($currentPhones as $currentPhone) {
                $currentPhoneData[] = [
                    'phone_number' => $currentPhone->phone_number,
                    'country_id' => $currentPhone->country_id
                ];
            }

            // Update phone numbers if they have changed
            if (is_array($phones) && is_array($countries) && count($phones) == count($countries)) {
                foreach ($phones as $key => $phone) {
                    $phoneData = [
                        'phone_number' => $phone,
                        'country_id' => $countries[$key]
                    ];

                    if (!in_array($phoneData, $currentPhoneData)) {
                        $phoneData['client_id'] = $clientEntity->client_id;
                        if (!$phoneModel->save($phoneData)) {
                            throw new InvalidArgumentException('Failed to update phone numbers');
                        }
                    }
                }
              
            }

            for($i = 0; $i < count($currentPhoneData); $i++) {
                
                if (!in_array($currentPhoneData[$i]["phone_number"], $phones)) {
                    if (!$phoneModel->delete($currentPhones[$i]->phone_id)) {
                        throw new InvalidArgumentException('Failed to update phone numbers');
                    }
                }
            }

            return $clientEntity->client_id;
        } catch (\Exception $e) {
            $this->db->transRollback();
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}