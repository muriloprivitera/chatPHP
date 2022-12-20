<?php
namespace src;

use Ds\Set;
use Ratchet\ConnectionInterface;
use Ratchet\WebSocket\MessageComponentInterface;
// use Ratchet\RFC6455\Messaging\MessageInterface;
use Ratchet\RFC6455\Messaging\MessageInterface;

class ChatComponent implements MessageComponentInterface{

    protected  $connectionSet;

    public function __construct()
    {
        $this->connectionSet = new \SplObjectStorage();
    }

    public function onOpen(ConnectionInterface $conn)
    {
        echo 'nova Conexao aberta';
        $this->connectionSet->attach($conn);
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->connectionSet->detach($conn);
    }

    public function onError(ConnectionInterface $conn,\Exception $e)
    {
        echo "Ocorreu um erro {$e->getMessage()}";
        $conn->close();
    }

    public function onMessage(ConnectionInterface $conn, MessageInterface $msg)
    {
        foreach ($this->connectionSet as $connection) {
            if($connection === $conn)continue;
            $connection->send((string) $msg);
        }
    }
}
?>