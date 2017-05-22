<?php

namespace App\Http\Controllers\Common;

use App\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = [];
        try {
            $class_rooms = ClassRoom::with(['rooms', 'rooms.beds'])->get();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['class_rooms' => $class_rooms, 'recordsTotal' => count($class_rooms)]];
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
            $class_room = '';
            if (isset($input['class_room_id']) && $input['class_room_id']) {
                $class_room = ClassRoom::find($input['class_room_id']);
                $class_room->update($input);
            } else {
                $class_room = ClassRoom::create($input);
            }
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['class_room' => $class_room]];
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
            $class_room = ClassRoom::with(['rooms', 'rooms.beds'])->find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['class_room' => $class_room]];
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
            $class_room = ClassRoom::with(['rooms', 'rooms.beds'])->find($id);
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => ['class_room' => $class_room]];
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
            $class_room = ClassRoom::with(['rooms', 'rooms.beds'])->find($id);
            $class_room->delete();
            $response = ['isSuccess' => true, 'message' => 'Success / Berhasil', 'datas' => []];
        } catch (\Exception $e) {
            $response = ['isSuccess' => false, 'message' => $e->getMessage(), 'datas' => null, 'code' => $e->getCode()];
        }
        return response()->json($response);
    }
}
