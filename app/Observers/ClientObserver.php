<?php

namespace App\Observers;

use App\Handlers\ProducerHandler;
use App\Client as Client;
use Exception;
use Illuminate\Support\Facades\Log;

class ClientObserver
{
    /**
     * Topic name
     */
    const KAFKA_TOPIC = 'nama_client';

    /**
     * Publish error message
     */
    const PUBLISH_ERROR_MESSAGE = 'Publish message to kafka failed';

    /**
     * Kafka producer
     *
     * @var \App\Handlers\Kafka\ProducerHandler
     */
    protected $producerHandler;

    /**
     * InventoryObserver's constructor
     *
     * @param \App\Handlers\Kafka\ProducerHandler $producerHandler
     */
    public function __construct(ProducerHandler $producerHandler)
    {
        $this->producerHandler = $producerHandler;
    }

    /**
     * Handle the inventory "created" event.
     *
     * @param  \App\Client $data
     * @return void
     */
    public function created(Client $data)
    {
        $this->pushToKafka($data);
    }

    /**
     * Handle the inventory "updated" event.
     *
     * @param  \App\Client $data
     * @return void
    
    
    public function updated(Client $client)
    {
        $this->pushToKafka($client);
    }
    */ 

    /**
     * Handle the inventory "deleted" event.
     *
     * @param  \App\Client $data
     * @return void
     */
    public function deleted(Client $data)
    {
        $this->pushToKafka($data);
    }

    /**
     * Push inventory to kafka
     *
     * @param  \App\Client $data
     * @return void
     */
    protected function pushToKafka(Client $data)
    {
        try {
            $this->producerHandler->setTopic(self::KAFKA_TOPIC)
                ->send($data->toJson(), $data->name);
        } catch (Exception $e) {
            Log::critical(self::PUBLISH_ERROR_MESSAGE, [
                'error' => $e->getMessage(),
                'code' => $e->getCode()
            ]);
        }
    }
}