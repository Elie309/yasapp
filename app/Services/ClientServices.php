<?php

namespace App\Services;

use App\Entities\Clients\ClientEntity;
use App\Models\Clients\ClientModel;
use App\Models\Clients\PhoneModel;
use InvalidArgumentException;

class ClientServices extends BaseServices
{

    public function updateClient(ClientEntity $clientEntity, array $phones_details)
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

            // Update client phone numbers
            $phonesAvailable = $phoneModel->where('client_id', $clientEntity->client_id)->findAll();

            foreach ($phones_details as $phone_detail) {
                $found = false;
                foreach ($phonesAvailable as $key => $phone) {
                    if ($phone->phone_id == $phone_detail['phone_id']) {

                        if (!$phoneModel->update($phone->phone_id, $phone_detail)) {
                            throw new InvalidArgumentException('Failed to update phone');
                        }
                        unset($phonesAvailable[$key]);
                        $found = true;
                        break;
                    }
                }

                if (!$found && $phone_detail['phone_id'] == 0) {
                    //Add new phone
                    $phone_detail['client_id'] = $clientEntity->client_id;
                    unset($phone_detail['phone_id']);
                    if (!$phoneModel->save($phone_detail)) {
                        throw new InvalidArgumentException('Failed to insert phone');
                    }
                }
            }

            foreach ($phonesAvailable as $phone) {
                if (!$phoneModel->delete($phone->phone_id)) {
                    throw new InvalidArgumentException('Failed to delete phone');
                }
            }


            return $clientEntity->client_id;
        } catch (\Exception $e) {
            throw new InvalidArgumentException($e->getMessage());
        }
    }
}
