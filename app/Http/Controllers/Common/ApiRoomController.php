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
                $rooms = Room::with(['classRoom', 'beds'])->where('class_room_id', $input['class_room_id'])->get();
            }else{
                $rooms = Room::with(['classRoom', 'beds'])->get();
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
                $room = Room::find($input['room_id']);
                $room->update($input);
            } else {
                $room = Room::create($input);
            }

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
            $room = Room::with(['classRoom', 'beds'])->find($id);
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
            $room = Room::with(['classRoom', 'beds'])->find($id);
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

    public function available(Request $request){
        $response = [];
        try {
            $rooms = Room::get();
            foreach ($rooms as $index => $room){
                $rooms[$index]['class_room_name'] = $room->classRoom->name;
                $available_bed = 0;
                $filled_bed = 0;
                foreach ($room->beds as $bed){
                    if($bed['status'] == 0){
                        $available_bed += 1;
                    }

                    if($bed['status'] == 1){
                        $filled_bed += 1;
                    }
                }

                $rooms[$index]['available_bed'] = $available_bed;
                $rooms[$index]['filled_bed'] = $filled_bed;
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['rooms' => $rooms]];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
