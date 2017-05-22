<?php

namespace App\Http\Controllers\Common;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            $rooms = '';
            if(isset($input['class_room_id']) && $input['class_room_id']){
                $rooms = Room::with(['classRooms', 'beds'])
                    ->whereHas('classRooms', function ($q)use($input){
                        $q->where('class_rooms_id', $input['class_room_id']);
                    })->get();
            }else{
                $rooms = Room::with(['classRooms', 'beds'])->get();
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['rooms' => $rooms], 'recordsTotal' => count($rooms)];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = [];
        try {
            $input = $request->all();
            $room = '';
            if (isset($input['room_id']) && $input['room_id']) {
                $room = $room->find($input['room_id']);
                $room->update($input);
            } else {
                $room = Room::create($input);
            }
            $room->classRooms()->sync($input['class_room_ids']);

            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['room' => $room]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = [];
        try {
            $room = Room::with(['classRooms', 'beds'])->find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['room' => $room]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = [];
        try {
            $room = Room::with(['classRooms'])->find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['room' => $room]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = [];
        try {
            $room = Room::find($id);
            $room->delete();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
