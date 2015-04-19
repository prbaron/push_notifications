<?php
namespace App\Http\Controllers;

use app\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
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
            return response()->json($createdMessage->toArray(), 201, []);
        }

        return response()->json("error", 400, []);
    }

    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $updated = Message::find($id)->update($inputs);
        if ($updated) {
            $updateMessage = Message::find($id);

            return response()->json($updateMessage->toArray(), 201, []);
        }

        return response()->json("error", 400, []);
    }

    public function destroy($id)
    {
        if (Message::find($id)->delete()) {
            return response()->json("", 204, []);
        }
    }
}
