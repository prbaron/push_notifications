<?php
namespace App\Http\Controllers;

use app\Models\Message;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version1X;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    protected $client;
    protected $logger;

    function __construct()
    {
        $this->client = new Client(new Version1X("http://10.10.2.2:5000"));
        $this->logger = app('Psr\Log\LoggerInterface');
    }

    public function index()
    {
        $messages = Message::all();

        return response()->json($messages->toArray(), 200, []);
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $createdMessage = Message::create($inputs);
        if ($createdMessage) {

            $this->emit('php.message.created', $createdMessage->toArray());

            return response()->json($createdMessage->toArray(), 201, []);
        }

        return response()->json("error", 400, []);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $updated = Message::find($id)->update($inputs);
        if ($updated) {
            $updatedMessage = Message::find($id);

            emit('php.message.updated', $updatedMessage->toArray());

            return response()->json($updatedMessage->toArray(), 201, []);
        }


        return response()->json("error", 400, []);
    }

    public function destroy($id)
    {
        $deletedMessage = Message::find($id);
        if ($deletedMessage->delete()) {
            $this->emit('php.message.deleted', $deletedMessage->toArray());

            return response()->json("", 204, []);
        }
    }

    /**
     * @param       $channel
     * @param array $data
     */
    function emit($channel, Array $data)
    {
        $this->logger->info("emit", [$channel, $data]);
        try {
            $this->client->initialize();
            $this->client->emit($channel, $data);
            $this->client->close();
        }
        catch (\RuntimeException $e) {
            $this->logger->error("catch", [$e]);
        }
    }
}
