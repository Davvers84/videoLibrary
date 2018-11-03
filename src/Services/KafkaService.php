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
     * @var
     */
    protected $adapter;

    /**
     * KafkaService constructor.
     */
    function __construct()
    {
        $this->setup();
    }


    /**
     *
     */
    function setup()
    {
        $broker = getenv('KAFKA_BROKER');

        // create consumer
        $topicConf = new \RdKafka\TopicConf();
        $topicConf->set('auto.offset.reset', 'largest');
        $conf = new \RdKafka\Conf();
        $conf->set('group.id', getenv('KAFKA_GROUP_ID'));
        $conf->set('metadata.broker.list', $broker);
        $conf->set('enable.auto.commit', 'false');
        $conf->set('offset.store.method', 'broker');
        $conf->set('socket.blocking.max.ms', 50);
        $conf->setDefaultTopicConf($topicConf);
        $consumer = new \RdKafka\KafkaConsumer($conf);

        // create producer
        $conf = new \RdKafka\Conf();
        $conf->set('socket.blocking.max.ms', 50);
        $conf->set('queue.buffering.max.ms', 20);
        $producer = new \RdKafka\Producer($conf);
        $producer->addBrokers($broker);

        $this->adapter = new \Superbalist\PubSub\Kafka\KafkaPubSubAdapter($producer, $consumer);
    }

    /**
     * @param $topic
     * @param $message
     */
    function publish($topic, $message)
    {
        $this->adapter->publish($topic, $message);
    }
}
