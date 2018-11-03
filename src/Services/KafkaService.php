<?php
namespace Vibrary\Services;

require ROOTPATH . '/vendor/autoload.php';

/**
 * Class KafkaService
 * @package Vibrary\Services
 */
class KafkaService
{

    /**
     * @param $topic
     * @param $message
     */
    public function produce($topic, $message)
    {
        $rk = new \RdKafka\Producer();
        $rk->addBrokers(getenv('KAFKA_BROKER'));
        $topic = $rk->newTopic($topic);
        $topic->produce(RD_KAFKA_PARTITION_UA, 0, $message);
    }

    /**
     * @param $topic
     * @return mixed
     */
    public function consume($topic)
    {
        $conf = new \RdKafka\Conf();
        $conf->set('group.id', getenv('KAFKA_GROUP_ID'));
        $rk = new \RdKafka\Consumer($conf);
        $rk->addBrokers($this->broker);
        $topic = $rk->newTopic($topic);
        $topic->consumeStart(0, RD_KAFKA_OFFSET_STORED);
        return $topic->consume(0, 1000);
    }
}
